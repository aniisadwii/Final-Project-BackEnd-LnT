<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategoryPage()
    {
        return view('admin.create-category', ['title' => 'Create Category']);
    }

    public function createCategory(Request $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/items');
    }
}
