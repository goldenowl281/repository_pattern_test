<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{

    private ProductRepositoryInterface $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    // TO SHOW ALL DATA
    public function index()
    {
        $products = $this->product->getAllProducts();
        return view('products.index', ['products' => $products]);
    }

    //THIS FUNCTION WILL TAKE YOU CREATE TEMPLATE
    public function create()
    {
        return view('products.create');
    }

    // DATA STORE AFTER CREATE
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'price' => 'required',
            'title' => 'required',
        ]);
        $data = [
            'title'         => $request->title,
            'price'         => $request->price,
            'description'   => $request->description,
            'image'         => $request->image
        ];

        if ($image = $request->file('image')) {

            $name = time() . "." . $image->getClientOriginalName();
            $image->move(public_path('images'), $name);

            $data['image'] = $image;
        }

        $this->product->createProduct($data);

        return redirect()->route('product.index');
    }

    //THIS IS DETAIL
    public function detail(Request $request)
    {
        $data = $request->route('id');
        $product = $this->product->getProductById($data);

        if (empty($product)) {
            return back();
        }

        return view('product.detail', ['product' => $product]);
    }

    //THIS WILL SHOW EDIT TEMPLATE
    public function edit(Request $request)
    {
        $id = $request->route('id');
        $data = $this->product->getProductById($id);

        if(empty($data)) {
            return back();
        }

        return view('product.edit', ['data' => $data ]);
    }

    //UPDATE DATA AFTER EDIT
    public function update(Request $request)
    {
        $id = $request->route('id');

        $data = [
            'title'         => $request->title,
            'price'         => $request->price,
            'description'   => $request->description,
            'image'         => $request->image
        ];

        $this->product->updateProduct($id, $data);
        return redirect()->route('product.index');
    }

    //ALL DATA DESTORY
    public function destory(Request $request)
    {
        $id = $request->route('id');
        $this->product->deleteProduct($id);
        return back();
    }





}
