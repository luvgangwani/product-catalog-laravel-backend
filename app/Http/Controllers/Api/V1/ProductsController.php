<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Products;
use App\Http\Resources\Products as ProductsResource;

class ProductsController extends Controller
{
    //

    public function index()
    {

        $returnProducts = [];
        try {

            foreach (Products::all() as $product) {
                array_push($returnProducts, new ProductsResource($product));
            }

            return response()->json(array(
                'success' => true,
                'data' => $returnProducts
            ), 200);
        }
        catch(QueryException $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'Error loading all products! Error: '.$e->getMessage()
            ), 400);
        }

    }

    public function getProductById(Request $request)
    {
        return response()->json(array(
            'success' => true,
            'data' => new ProductsResource(Products::find($request->id))
        ), 200);
    }

    public function getProductsByCategoryId(Request $request)
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

        $validProduct = $request->validate(
            [
                'product_name' => 'required',
                'product_description' => 'required',
                'category_id' => 'required',
                'product_price' => 'required'
            ]

        );

        $newProduct->admin_id = auth()->user()->id; // the admin who added the new product
        $newProduct->product_name = $validProduct['product_name'];
        $newProduct->product_description = $validProduct['product_description'];
        $newProduct->category_id = $validProduct['category_id'];
        $newProduct->product_price = $validProduct['product_price'];

        try {
            if ($newProduct->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'New product added successfully!',
                    'data' => $newProduct
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

        $validProduct = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'category_id' => 'required',
            'product_price' => 'required'
        ]);

        $product->product_name = $validProduct['product_name'];
        $product->product_description = $validProduct['product_description'];
        $product->category_id = $validProduct['category_id'];
        $product->product_price = $validProduct['product_price'];

        try {
            if ($product->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'Product details updated successfully!',
                    'data' => $product
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
