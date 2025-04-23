<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Lọc theo tên (A-Z hoặc Z-A)
        $query = Category::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort') && $request->sort == 'asc') {
            $query->orderBy('name', 'asc'); // Lọc từ A-Z
        } else {
            $query->orderBy('name', 'desc'); // Lọc từ Z-A
        }

        // Lấy danh sách danh mục với phân trang
        $categoryList = $query->paginate(10); // Phân trang 10 mục một trang

        // Tính toán các thông số tổng quan
        $totalCategories = $categoryList->total();
        $activeCategories = Category::has('products')->count(); // dùng quan hệ 'products'

        return view('admin.category.list', compact('categoryList', 'totalCategories', 'activeCategories'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'image.required' => 'Vui lòng chọn hình ảnh danh mục.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $fileName);
            $category->image = $fileName; // ✅ Sửa ở đây
        }

        $category->save();

        return redirect('/admin/category')->with('success', 'Thêm danh mục thành công!');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.update', compact('category'));
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
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $fileName);
            $category->image = $fileName;
        }

        $category->save();
        return redirect('/admin/category')->with('success', 'Cập nhật danh mục thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
         $category = Category::find($id);

         if ($category) {
             $category->delete();

             // Cập nhật lại số lượng danh mục đã xóa trong cache
             $deletedCategories = Cache::get('deleted_category_count', 0) + 1;
             Cache::put('deleted_category_count', $deletedCategories);

             return redirect()->back()->with('success', 'Xóa danh mục thành công');
         }

         return redirect()->back()->with('error', 'Danh mục không tồn tại');
     }


     private function increaseDeletedCount()
     {
         // Tăng số lượng danh mục đã xóa
         $deletedCount = Cache::get('deleted_category_count', 0);
         Cache::put('deleted_category_count', $deletedCount + 1, now()->addMinutes(60)); // Giữ lại số liệu tạm thời
     }

}
