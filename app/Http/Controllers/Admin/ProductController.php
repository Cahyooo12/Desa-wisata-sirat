<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['image', 'image_file']);

        // Use URL if provided
        if ($request->filled('image')) {
            $data['image'] = $request->image;
        }

        // Override with uploaded file if present
        if ($request->hasFile('image_file')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image_file')->getRealPath())->getSecurePath();
            $data['image'] = $uploadedFileUrl;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
                        ->with('success','Product created successfully.');
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
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->except(['image', 'image_file']);

        // Use URL if provided
        if ($request->filled('image')) {
            $data['image'] = $request->image;
        }

        // Override with uploaded file if present
        if ($request->hasFile('image_file')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image_file')->getRealPath())->getSecurePath();
            $data['image'] = $uploadedFileUrl;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success','Product deleted successfully');
    }
}
