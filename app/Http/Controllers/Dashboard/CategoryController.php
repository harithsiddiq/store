<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Dashboard\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {

        try {

            Category::create([
               'name' => $request->name,
               'slug' => $request->slug,
               'parent_id' => $request->parent_id,
               'is_active' => $request->status?1:0
            ]);

            return redirect()->route('category.index');
        }catch (\Exception $e) {
            return $e;
        }
    }
}
