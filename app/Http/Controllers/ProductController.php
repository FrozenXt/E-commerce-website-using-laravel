<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // -----------------------------
    // PUBLIC (User side)
    // -----------------------------
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'name' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    // -----------------------------
    // ADMIN SIDE
    // -----------------------------
    public function adminIndex()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'slug'           => 'nullable|string|unique:products,slug',
            'category_id'    => 'nullable|exists:categories,id',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'brand'          => 'nullable|string|max:100',
            'stock'          => 'nullable|integer|min:0',
            'is_featured'    => 'boolean',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = true; // ✅ Always active

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('images')) {
            $validated['images'] = collect($request->file('images'))
                ->map(fn($file) => $file->store('products', 'public'))
                ->toArray();
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', '✅ Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'category_id'    => 'required|exists:categories,id',
        'name'           => 'required|string|max:255',
        'slug'           => 'nullable|string|max:255',
        'description'    => 'nullable|string',
        'price'          => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'brand'          => 'nullable|string|max:255',
        'stock'          => 'nullable|integer|min:0',
        'is_featured'    => 'nullable|boolean',
        'is_active'      => 'nullable|boolean',
        'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // ✅ Discount logic — prevent invalid discounts
    if (!empty($validated['discount_price'])) {
        if ($validated['discount_price'] >= $validated['price']) {
            // Ignore discount if it's not actually lower
            $validated['discount_price'] = null;
        }
    } else {
        $validated['discount_price'] = null;
    }

    // ✅ Image upload handling (optional)
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $validated['image'] = $imagePath;
    }

    // ✅ Update the product
    $product->update($validated);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product updated successfully!');
}

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->images) {
            foreach ($product->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $product->delete();
// ✅ Ensure it’s truly deleted

        return redirect()->route('admin.products.index')->with('success', '🗑️ Product deleted successfully!');
    }
}
