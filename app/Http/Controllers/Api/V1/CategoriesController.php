<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Categories;
use App\Http\Resources\Categories as CategoriesResources;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CategoriesController extends Controller
{
    //

    public function index() {
        return response()->json(array(
            'success' => true,
            'data' => Categories::all()
        ), 200);
    }

    public function getCategoryById(Request $request) {
        return response()->json(array(
            'success' => true,
            'data' => Categories::find($request->id)
        ), 200);
    }

    public function store(Request $request) {

        $returnResponse = null;

        $newCategory = new Categories();

        $newCategory->parent_id = $request->parent_id;
        $newCategory->category_name = $request->category_name;
        $newCategory->category_url = $request->category_url;
        try {

            if ($newCategory->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' =>'New category added successfully!',
                    'data' => $newCategory
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

        $category->parent_id = $request->parent_id;
        $category->category_name = $request->category_name;
        $category->category_url = $request->category_url;

        try {

            if ($category->save()) {
                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'Category details updated successfully!',
                    'data' => $category
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
