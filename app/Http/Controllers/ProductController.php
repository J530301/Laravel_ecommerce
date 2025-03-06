<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch phone and computer products separately
        $phoneProducts = Product::where('category', 'Phones')->get();
        $computerProducts = Product::where('category', 'Computers')->get();
        $laptopProducts = Product::where('category', 'Laptops')->get();

        return view('index', compact('phoneProducts', 'computerProducts', 'laptopProducts'));
    }

    public function showPhones()
    {
        $phoneProducts = Product::where('category', 'Phones')->get();
        return view('phone', compact('phoneProducts'));
    }

    public function showComputers()
    {
        $computerProducts = Product::where('category', 'Computers')->get();
        return view('computer', compact('computerProducts'));
    }

    public function showLaptops()
    {
        $laptopProducts = Product::where('category', 'Laptops')->get();
        return view('laptop', compact('laptopProducts'));
    }

    public function showTablets()
    {
        return view('tablet');
    }

    public function showAccessories()
    {
        return view('accessory');
    }

    public function buyProduct(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::where('name', $request->product)->first();

        if (!$product || $product->stock < $request->quantity) {
            return response()->json(['success' => false, 'message' => 'Not enough stock available.']);
        }

        // Reduce stock quantity
        $product->stock -= $request->quantity;
        $product->save();

        return response()->json(['success' => true]);
    }

    public function orderSuccess()
    {
        return view('order-success');
    }

    public function updateStock(Request $request)
    {
        $product = Product::where('name', $request->product)->first();
        
        if ($product) {
            $product->stock = $request->stock;
            $product->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'specs' => 'required|string',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'specs' => $request->specs,
            'stock' => $request->stock,
            'category' => $request->category,
            'image' => $imageName,
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);

        if ($product) {
            // Delete the old image
            if ($product->image && File::exists(public_path('images/' . $product->image))) {
                File::delete(public_path('images/' . $product->image));
            }
            $product->delete();
            return response()->json(['success' => 'Product deleted successfully!']);
        } else {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }

    public function updateImage(Request $request)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);

        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        // Delete the old image
        if ($product->image && File::exists(public_path('images/' . $product->image))) {
            File::delete(public_path('images/' . $product->image));
        }

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        $product->image = $imageName;
        $product->save();

        return response()->json(['success' => true, 'image_url' => asset('images/' . $imageName)]);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->specs = $request->specs;
        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($product->image && File::exists(public_path('images/' . $product->image))) {
                File::delete(public_path('images/' . $product->image));
            }

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'image_url' => $request->hasFile('image') ? asset('images/' . $imageName) : null
        ]);
    }
}