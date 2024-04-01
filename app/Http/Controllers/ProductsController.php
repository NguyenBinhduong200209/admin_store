<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve all products
        $keyword = $request->input('keyword', '');
        $products = Products::where('name', 'LIKE', "%{$keyword}%")->paginate(10);

        // Return view with products data
        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        // Return view for creating new product
        return view('admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'details' => 'required',
            'category' => 'required',
            'status' => 'required',

            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm validation cho image
        ]);

        // Lưu ảnh vào thư mục public/images
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        // Create new product
        $product = Products::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'details' => $request->details,
            'category' => $request->category,
            'status' => $request->status,
            'status1' => $request->status1,
            'image' => $imageName, // Lưu tên ảnh vào cơ sở dữ liệu
        ]);

        // Kiểm tra xem có lỗi không trước khi redirect
        if ($product) {
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } else {
            return back()->with('error', 'Failed to create product');
        }
    }
    public function destroy($id)
    {
        $product = Products::find($id);

        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Sản phẩm đã được xóa thành công'], 200);
    }
    public function edit($id)
    {
        $product = Products::find($id);
        // Trả về view với dữ liệu sản phẩm cần sửa
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'details' => 'required',
            'category' => 'required',
            'status' => 'required',

            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm validation cho image
        ]);

        // Tìm sản phẩm cần cập nhật
        $product = Products::findOrFail($id);

        // Lưu ảnh vào thư mục public/images
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Cập nhật dữ liệu sản phẩm
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'details' => $request->details,
            'category' => $request->category,
            'status' => $request->status,
            'status1' => $request->status1,
        ]);

        // Kiểm tra xem có lỗi không trước khi redirect
        if ($product) {
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } else {
            return back()->with('error', 'Failed to update product');
        }
    }


    // Add other CRUD methods as needed...
}
