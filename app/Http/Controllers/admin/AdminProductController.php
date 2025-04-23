<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $categories = Category::all();

    // Lọc sản phẩm theo danh mục
    $productList = Product::query();

    if ($request->filled('category_id')) {
        $productList = $productList->where('category_id', $request->category_id);
    }

    // Tìm kiếm theo tên sản phẩm
    if ($request->filled('search')) {
        $productList = $productList->where('name', 'like', '%' . $request->search . '%');
    }

    // Lọc theo A-Z (hoặc Z-A)
    if ($request->filled('sort')) {
        $productList = $productList->orderBy('name', $request->sort);
    }

    // Phân trang 10 sản phẩm trên mỗi trang
    $productList = $productList->paginate(10); // Bạn có thể thay đổi số sản phẩm mỗi trang tùy thích

    // Tính toán các thông số tổng quan
    $totalProducts = $productList->total();
    $inStock = $productList->where('quantity', '<', 10)->count();
    $outOfStock = $productList->where('quantity', '=', 0)->count();
    $onSale = $productList->where('sale_price', '!=', null)->count();

    $data = [
        'productList' => $productList,
        'totalProducts' => $totalProducts,
        'inStock' => $inStock,
        'outOfStock' => $outOfStock,
        'onSale' => $onSale,
        'categories' => $categories // Gửi danh sách danh mục vào view
    ];

    return view('admin.product.list', $data);
}





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', ['category' => $category]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0|max:999999999',
            'sale_price' => 'nullable|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'slug.required' => 'Vui lòng nhập slug.',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng ít nhất là 1.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá phải là số.',
            'price.max' => 'Giá quá lớn. Vui lòng nhập giá nhỏ hơn 10 tỷ.',
            'sale_price.numeric' => 'Giá khuyến mãi phải là số.',
            'sale_price.min' => 'Giá khuyến mãi không được âm.',
            'image.required' => 'Vui lòng chọn hình ảnh sản phẩm.',
            'image.image' => 'Tập tin phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif, hoặc svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
            'price.max' => 'Giá quá lớn. Vui lòng nhập giá nhỏ hơn 1 tỷ.',
'sale_price.max' => 'Giá khuyến mãi quá lớn. Vui lòng nhập giá nhỏ hơn 1 tỷ.',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $fileName);
            $product->image = $fileName;
        }

        $product->save();

        return redirect('/admin/product')->with('success', 'Thêm sản phẩm thành công!');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $data = ['product' => $product, 'category' => $category];
        return view('admin.product.update', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validate dữ liệu
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug,' . $id, // Kiểm tra trùng slug nhưng bỏ qua id hiện tại
        'description' => 'required|string',
        'quantity' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0|max:9999999999',
        'sale_price' => 'nullable|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Không bắt buộc phải có ảnh khi cập nhật
    ], [
        'name.required' => 'Vui lòng nhập tên sản phẩm.',
        'slug.required' => 'Vui lòng nhập slug.',
        'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác.',
        'description.required' => 'Vui lòng nhập mô tả sản phẩm.',
        'quantity.required' => 'Vui lòng nhập số lượng.',
        'quantity.integer' => 'Số lượng phải là số nguyên.',
        'quantity.min' => 'Số lượng ít nhất là 0.',
        'category_id.required' => 'Vui lòng chọn danh mục.',
        'category_id.exists' => 'Danh mục không tồn tại.',
        'price.required' => 'Vui lòng nhập giá sản phẩm.',
        'price.numeric' => 'Giá phải là số.',
        'price.max' => 'Giá quá lớn. Vui lòng nhập giá nhỏ hơn 10 tỷ.',
        'sale_price.numeric' => 'Giá khuyến mãi phải là số.',
        'sale_price.min' => 'Giá khuyến mãi không được âm.',
        'image.image' => 'Tập tin phải là hình ảnh.',
        'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif, hoặc svg.',
        'image.max' => 'Hình ảnh không được vượt quá 2MB.',
    ]);

    // Tìm sản phẩm theo ID
    $product = Product::find($id);

    // Cập nhật các trường
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->sale_price = $request->sale_price;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id;

    // Kiểm tra và cập nhật ảnh nếu có
    if($request->file('image')) {
        $fileName = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img'), $fileName);
        $product->image = $fileName;
    }

    // Lưu thông tin sản phẩm
    $product->save();

    // Chuyển hướng và thông báo thành công
    return redirect("/admin/product/$id")->with('success', 'Cập nhật sản phẩm thành công');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete(); // Xóa sản phẩm mềm
        return redirect()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công',
        ]);
    }

}
