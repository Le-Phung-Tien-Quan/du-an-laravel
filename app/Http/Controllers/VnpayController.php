<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;




class VnpayController extends Controller
{
    protected $vnp_TmnCode;
    protected $vnp_HashSecret;
    protected $vnp_Url;
    protected $vnp_Returnurl;
    protected $vnp_apiUrl;
    protected $apiUrl;
    public function __construct(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
$this->vnp_TmnCode = "EWXQU47M"; //Mã định danh merchant kết nối (Terminal Id)
$this->vnp_HashSecret = "LR7ZWIMRCJ9AWPXAXV3WLFKP2R85TJ41"; //Secret key
$this->vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$this->vnp_Returnurl = "http://127.0.0.1:8000/payment/result";
$this->vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$this->apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
    }
    public function create() {
        // Create order
        $order = new Order();
        $order->user_id = 1;

        // Calculate the total price
        $totalPrice = 0;
        $cart = Session::get('cart', []);

        // Calculate total price and prepare order details
        foreach ($cart as $item) {
            $totalPrice += ($item['sale_price'] ? $item['sale_price'] : $item['price']) * $item['quantity'];
        }

        // Set the total price for the order before saving
        $order->total_price = $totalPrice;

        // Save the order first to generate an ID
        $order->save();

        // Now, insert the order details
        foreach ($cart as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;  // Now that order has been saved, it has an ID
            $orderDetail->product_id = $item['id'];
            $orderDetail->price = ($item['sale_price']) ? $item['sale_price'] : $item['price'];
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->save();
        }

        // Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
        $vnp_TxnRef = $order->id; // Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $_POST['amount']; // Số tiền thanh toán
        $vnp_Locale = $_POST['language']; // Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $_POST['bankCode']; // Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $this->vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url . "?" . $query;
        if (isset($this->vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }

    public function result() {
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();

        // Collect all vnp_ parameters
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";

        // Prepare the hash data string
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        // Compare the secure hash
        $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            // Check the response code
            if ($_GET['vnp_ResponseCode'] == '00') {
                // Payment successful
                $orderID = $_GET['vnp_TxnRef'];
                $order = Order::find($orderID);

                // Update the order status to 'cancelled'
                if ($order) {
                    $order->status = 'pending'; // Or any other appropriate status
                    $order->save();  // Save the updated status
                }

                return view('payment.success');
            } else {
                // Payment failed
                return view('payment.fail');
            }
        } else {
            // Invalid hash
            return view('payment.error');
        }
    }

}
