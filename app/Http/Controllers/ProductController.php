<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index()
    {
        $products = Product::All();
        $mf = Manufacturer::All();
        // dd($products);
        return view("CRUDproduct", compact('products', 'mf'));
    }
    function search(Request $request)
    {
        $products = Product::All();
        $mf = Manufacturer::All();
        $key = $request->input('search');
        $listSearch = Product::where('product_name', 'like', '%' . $key . '%')->get();
        // dd($listSearch);
        return view("CRUDproduct", compact('products', 'mf','listSearch','key'));
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

        // echo("Chạy hàm store");
        //Kiểm tra giá trị make, model, produced_on
        $this->validate(
            $request,
            [
                //Kiểm tra giá trị rỗng
                'product_name' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'select_Mf' => 'required',
                'image_file' => 'required',
            ],
            [
                //Tùy chỉnh hiển thị thông báo
                'product_name.required' => 'Bạn chưa nhập tên của sản phẩm',
                'price.required' => 'Bạn chưa nhập giá của sản phẩm',
                'quantity.required' => 'Bạn chưa nhập số lượng!',
                'select_Mf.required' => 'Bạn chưa chọn hãng xe!',
                'description.required' => 'Bạn chưa nhập mô tả!',
                'image_file.required' => 'Vui lòng chọn ảnh!',
            ]
        );
        //kiểm tra file tồn tại
        $name = '';

        if ($request->hasfile('image_file')) {
            //Hàm kiểm tra dữ liệu
            $this->validate(
                $request,
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'image_file' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image_file.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );
            $file = $request->file('image_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
        }
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->mf_id = $request->input('select_Mf');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        if ($request->input('description') != null)
            $product->description = $request->input('description');
        else {
            $product->description = "No description!";
        }
        $product->image = $name;
        $product->save();
        return redirect('/CRUD')->with('success', 'Bạn đã thêm thành công sản phẩm' . $product->product_name . '!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $mf = Manufacturer::All();
        return view('updateProduct', compact('product', 'mf'));
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
        $product = Product::find($id);
        $this->validate(
            $request,
            [
                //Kiểm tra giá trị rỗng
                'product_name' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'select_Mf' => 'required',
                'description' => 'required',
            ],
            [
                //Tùy chỉnh hiển thị thông báo
                'product_name.required' => 'Bạn chưa nhập tên của sản phẩm',
                'price.required' => 'Bạn chưa nhập giá của sản phẩm',
                'quantity.required' => 'Bạn chưa nhập số lượng!',
                'select_Mf.required' => 'Bạn chưa chọn hãng xe!',
                'description.required' => 'Bạn chưa nhập mô tả!',
            ]
        );
        //kiểm tra file tồn tại
        $name = '';

        if ($request->hasfile('image_file')) {
            //Hàm kiểm tra dữ liệu
            $this->validate(
                $request,
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'image_file' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image_file.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );
            $file = $request->file('image_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/'); //project\public\images\cars, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
        } else {
            $name = $product->image;
        }

        $product->product_name = $request->input('product_name');
        $product->mf_id = $request->input('select_Mf');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->image = $name;
        $product->save();
        return redirect('CRUD')->with('success', 'Bạn đã cập nhật thành công sản phẩm ' . $product->product_name . '!');
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
        $product->delete();
        return redirect('CRUD')->with('success', 'Bạn đã xóa thành công sản phẩm ' . $product->product_name . '!');
    }
}
