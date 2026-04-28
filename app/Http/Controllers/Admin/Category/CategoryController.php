<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->sort ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;

        $categories = Category::withCount('posts')->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })
            ->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return view('admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:0,1',
        ]);
        $category = Category::create($request->except('_token'));
        if(!$category) {
            return redirect()->back()->with('error', 'Failed to Create Category');
        }
        return redirect()->back()->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:0,1',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->except(['_token', '_method']));
        if(!$category) {
            return redirect()->back()->with('error', 'Failed to Update Category');
        }
        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category Deleted Successfully');
    }
    public function changeStatus(string $id)
    {
        $category = Category::findOrFail($id);
        $category->status = !$category->status;
        $category->save();
        return redirect()->back()->with('success', 'Category Status Changed Successfully');
    }
}
