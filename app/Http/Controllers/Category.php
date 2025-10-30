<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Category extends Controller
{
    public function adminIndex()
{
    $categories = \App\Models\Category::with('products')->latest()->get();
    return view('admin.categories.index', compact('categories'));
}

}
