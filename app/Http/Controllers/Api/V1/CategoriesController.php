<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Categories;
use App\Http\Resources\Categories as CategoriesResource;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CategoriesController extends Controller
{
    //

    public function index() {

        try {
            $returnCategories = [];

            foreach (Categories::all() as $category) {
                array_push($returnCategories, new CategoriesResource($category));
            }
            return response()->json(array(
                'success' => true,
                'data' => $returnCategories
            ), 200);
        }
        catch (QueryException $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'Error loading all categories! Error: '.$e->getMessage()
            ), 400);
        }

        
    }

    public function getCategoryById(Request $request) {
        return response()->json(array(
            'success' => true,
            'data' => Categories::find($request->id)
        ), 200);
    }

    public function store(Request $request) {

        $returnResponse = null;

        $validCategory = $request->validate([
            'category_name' => 'required|unique:categories',
            'category_url' => 'required|unique:categories',
            'parent_id' => 'required'
        ]);

        $newCategory = new Categories();

        $newCategory->parent_id = $validCategory["parent_id"];
        $newCategory->category_name = $validCategory["category_name"];
        $newCategory->category_url = $validCategory["category_url"];

        try {

            if ($newCategory->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' =>'New category added successfully!',
                    'data' => new CategoriesResource($newCategory)
                ), 201); // 201, since we create a new resource
            }
            else {
                $returnResponse = response()->json(array(
                    'success' => false,
                    'message' =>'Error adding a new category!'
                ), 400);
            }

            return $returnResponse;

        } catch (QueryException $e) {
            return response()->json(array('success' => false,
            'message' =>'Error adding a new category! Error: '.$e->getMessage()
        ), 400);
        }
    }

    public function update(Request $request, Categories $category) {

        $returnResponse = null;

        $validCategory = $request->validate([
            'category_name' => 'required|unique:categories',
            'category_url' => 'required|unique:categories',
            'parent_id' => 'required'
        ]);

        $category->parent_id = $validCategory["parent_id"];
        $category->category_name = $validCategory["category_name"];
        $category->category_url = $validCategory["category_url"];

        try {

            if ($category->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'Category details updated successfully!',
                    'data' => new CategoriesResource($category)
                ), 200);
            }
            else {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'Error updating category details!'
                ), 400);
            }

            return $returnResponse;

        } catch(QueryException $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'Error updating category details! Error: '.$e->getMessage()
            ), 400);
        }

    }
}
