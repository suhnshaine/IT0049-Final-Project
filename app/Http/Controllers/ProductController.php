<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.form', [
            'title' => 'Add Product',
            'product' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')
                ->store('products', 'public');
        }

        Product::create([
            'name' => trim($request->name),
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $image
        ]);

        return redirect()
            ->route('products.index')
            ->with('message', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.form', [
            'title' => 'Edit Product',
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = [
            'name' => trim($request->name),
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity
        ];

        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('message', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('message', 'Product deleted successfully.');
    }
}