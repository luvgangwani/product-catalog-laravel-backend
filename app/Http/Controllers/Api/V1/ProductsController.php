<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Products;

class ProductsController extends Controller
{
    //

    public function index()
    {
        return response()->json(array(
            'success' => true,
            'data' => Products::all()
        ), 200);
    }

    public function getProductById(Request $request)
    {
        return response()->json(array(
            'success' => true,
            'data' => Products::find($request->id)
        ), 200);
    }

    public function getProductByCategoryId(Request $request)
    {
        return response()->json(array(
            'success' => true,
            'data' => Products::where('category_id', $request->category_id)->get()
        ), 200);
    }

    public function store(Request $request)
    {
        $newProduct = new Products();

        $returnResponse = null;

        $newProduct->admin_id = $request->admin_id;
        $newProduct->product_name = $request->product_name;
        $newProduct->product_description = $request->product_description;
        $newProduct->category_id = $request->category_id;
        $newProduct->product_price = $request->product_price;

        try {
            if ($newProduct->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'New product added successfully!'
                ), 201);
            }
            else {
                $returnResponse = response()->json(array(
                    'success' => false,
                    'message' => 'Error adding a new product!'
                ), 500);
            }

            return $returnResponse;

        } catch(QueryException $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'Error adding a new product! Error: '.$e->getMessage()
            ), 500);
        }
    }

    public function update(Request $request, Products $product)
    {
        $returnResponse = null;

        $product->admin_id = $request->admin_id;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->product_price = $request->product_price;

        try {
            if ($product->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'Product details updated successfully!'
                ), 201);
            }
            else {
                $returnResponse = response()->json(array(
                    'success' => false,
                    'message' => 'Error updating product details!'
                ), 500);
            }

            return $returnResponse;

        } catch(QueryException $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'Error updating product details! Error: '.$e->getMessage()
            ), 500);
        }
    }
}
