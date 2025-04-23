<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function detail($slug)
{
    // Lấy sản phẩm hiện tại theo slug
    $product = Product::where('slug', $slug)
                      ->select('id', 'name', 'price', 'sale_price', 'slug', 'category_id', 'image', 'description', 'views')
                      ->first();

    // Kiểm tra nếu sản phẩm tồn tại
    if ($product) {
        // Tăng lượt xem lên 1
        $product->increment('views');
    }

    // Lấy các sản phẩm liên quan có cùng category_id, loại trừ sản phẩm hiện tại
    $relatedProducts = Product::where('category_id', $product->category_id)
                              ->where('id', '!=', $product->id)
                              ->select('name', 'price', 'sale_price', 'slug', 'image')
                              ->limit(4) // Số lượng sản phẩm liên quan
                              ->get();

    // Trả về view với thông tin sản phẩm và sản phẩm liên quan
    return view('product.detail', [
        'product' => $product,
        'relatedProducts' => $relatedProducts
    ]);
}

    public function shop(Request $request)
    {
        $query = Product::select('id', 'name', 'price', 'sale_price', 'slug', 'category_id', 'image');

        // Lọc theo sắp xếp
        $sort = $request->input('sort', 'id_desc');
        $sortOptions = [
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
            'id_desc' => ['id', 'desc'],
        ];
        if (isset($sortOptions[$sort])) {
            $query->orderBy(...$sortOptions[$sort]);
        }

        $priceRanges = [
            'under_1m' => ['price', '<', 1000000],
            '1m_2m' => [1000000, 2000000],
            '2m_3m' => [2000000, 3000000],
            '3m_5m' => [3000000, 5000000],
            'above_5m' => ['price', '>', 5000000],
        ];

        $priceRange = $request->input('price');

        if (isset($priceRanges[$priceRange])) {
            if (count($priceRanges[$priceRange]) == 3) {
                $query->where($priceRanges[$priceRange][0], $priceRanges[$priceRange][1], $priceRanges[$priceRange][2]);
            } else {
                $query->whereBetween('price', $priceRanges[$priceRange]); // Dùng whereBetween cho khoảng giá
            }
        }


        // Phân trang
        $products = $query->paginate(6);

        return view('product.shop', compact('products'));
    }





    function categoryProducts($categoryId)
{
    // Lấy danh mục theo id
    $category = Category::findOrFail($categoryId);

    // Lấy sản phẩm thuộc danh mục này
    $products = Product::where('category_id', $category->id)
                        ->select('id', 'name', 'price', 'sale_price', 'slug', 'category_id', 'image')
                        ->paginate(6);

    // Trả về view với thông tin sản phẩm theo danh mục
    return view('product.category', [
        'category' => $category,
        'products' => $products
    ]);
}
public function search(Request $request)
{
    $search = $request->input('search');  // Lấy từ khóa tìm kiếm
    $products = Product::where('name', 'like', "%{$search}%")->paginate(10);  // Tìm kiếm sản phẩm

    if ($products->isEmpty()) {
        $message = 'Không có sản phẩm cho từ khóa: ' . $search;
    } else {
        $message = null;
    }

    return view('product.search', compact('products', 'message'));  // Truyền thông báo vào view
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lấy tất cả sản phẩm
        $products = Product::all();

        // Trả về danh sách sản phẩm dưới dạng JSON
        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'required|string|max:255',
        ]);

        // Tạo sản phẩm mới
        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Lấy sản phẩm theo id
        $product = Product::find($id);

        // Nếu không tìm thấy sản phẩm, trả về lỗi 404
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Nếu tìm thấy, trả về sản phẩm
        return response()->json($product, 200);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Kiểm tra quyền admin trước khi tiếp tục
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Bạn không có quyền chỉnh sửa'], 403);
        }

        // Tìm sản phẩm theo ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $isPatch = $request->isMethod('patch');

        // Validation rules
        $rules = [
            'name' => $isPatch ? 'sometimes|string|max:255' : 'required|string|max:255',
            'slug' => ($isPatch ? 'sometimes|' : 'required|') . 'string|max:255|unique:products,slug,' . $product->id,
            'price' => $isPatch ? 'sometimes|numeric' : 'required|numeric',
            'quantity' => $isPatch ? 'sometimes|integer' : 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'image' => $isPatch ? 'sometimes|string|max:255' : 'required|string|max:255',
        ];

        // Validate request
        $request->validate($rules);

        // Cập nhật sản phẩm với dữ liệu đã xác thực
        $product->update($request->only([
            'name', 'slug', 'description', 'price', 'quantity', 'category_id', 'image'
        ]));

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
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

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Xóa sản phẩm
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

}
