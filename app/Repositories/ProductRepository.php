<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    //    TO GET ALL PRODUCT DATA AND RETURN
    public function getAllProducts()
    {
        return Product::all();
    }

    // SEARCH ONE PRODUCT BY ID AND RETURN
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    // SEARCH PRODUCT  BY ID AND DELETE
    public function deleteProduct($id)
    {
        Product::destroy($id);
    }

    // CREATE NEW PRODUCT AND SAVE DATA IN DATABASE
    public function createProduct(array $data)
    {
        // Product::insert([
        //     'title'         => $data['title'],
        //     'price'         => $data['price'],
        //     'description'   => $data['description'],
        //     'image'         => $data['image'] ,

        // ]);
        return Product::create($data);
    }

    //SEARCH PRODUCT ID AND UPDATE DATA
    public function updateProduct($id, array $data)
    {
        return Product::whereId($id)->update($data);

    }
}

?>
