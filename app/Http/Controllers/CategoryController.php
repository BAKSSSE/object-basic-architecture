<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index() {
        $category = Category::all();

        return response()->json([
            $category
        ], 200);
    }
    
    public function create(Request $request) {
        $params = $request->only([
            'name'
        ]);

        $category = Category::create($params);

        return $category;
    }

    public function update(Request $request, $id) {
        
        $catrgory = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        return $category;
    }

    public function delete($id) {
        
        Category::where('id', $id)->delete();
        return ['message'=>'삭제'];
    }
}
