@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Product Details Overlay -->
<div id="productOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-1/2 mx-auto mt-10">
        <div class="flex justify-between items-center mb-4">
            @if(auth()->user()->name === 'admin')
            <h5 class="text-xl font-bold">Update Product</h5>
            @else
            <h5 class="text-xl font-bold">Product Details</h5>
            @endif
            <button id="closeOverlay" class="text-black">&times;</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="w-full h-96 flex items-center justify-center overflow-hidden relative">
                <img src="" id="overlayImage" class="max-w-full max-h-full object-contain" style="width: 371px; height: 371px; object-fit: contain;">
                @if(auth()->user()->name === 'admin')
                    <input type="file" id="editImageInput" class="hidden">
                    <div id="editImageOverlay" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-lg font-bold cursor-pointer">
                        Edit Image
                    </div>
                @endif
            </div>
            <div>
                @if(auth()->user()->name === 'admin')
                <h6 class="text-lg">Product ID: <span id="overlayProductID"></span></h6>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Product Name</label>
                        <input type="text" id="editProductName" class="w-full border border-black rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Price</label>
                        <input type="number" id="editProductPrice" class="w-full border border-black rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Specifications</label>
                        <textarea id="editProductSpecs" class="w-full border border-black rounded p-2"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Stock</label>
                        <input type="number" id="stockInput" class="w-full border border-black rounded p-2">
                    </div>
                    <button id="saveAllChanges" class="bg-black text-white px-4 py-2 rounded">Save All Changes</button>
                @else
                    <h4 id="overlayProduct" class="text-2xl font-bold"></h4>
                    <p id="overlayPrice" class="text-lg"></p>
                    <div id="overlaySpecs" class="text-sm"></div>
                    <p class="text-sm">Stock: <span id="overlayStock"></span> left</p>
                    <div class="flex items-center mt-4">
                        <button id="decreaseQuantity" class="bg-black text-white px-4 py-2 rounded">-</button>
                        <input type="text" id="quantity" value="1" class="w-12 text-center border border-black mx-2 p-2">
                        <button id="increaseQuantity" class="bg-black text-white px-4 py-2 rounded">+</button>
                    </div>
                    <div class="mt-4">
                        <button id="buyButton" class="bg-black text-white px-4 py-2 rounded">Buy Now</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Product Display -->
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Phones</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($phoneProducts as $item)
            <div class="border border-black rounded-lg shadow-lg p-4">
                <h4 class="text-xl font-bold">{{ $item->name }}</h4>
                <p class="text-lg">Price: ${{ $item->price }}</p>
                <img src="{{ asset('images/' . $item->image) }}" class="w-full h-48 object-cover rounded-lg my-2" style="width: 371px; height: 371px; object-fit: contain;">
                <button class="view-details bg-black text-white px-4 py-2 rounded"
                    data-id="{{ $item->id }}"
                    data-product="{{ $item->name }}" 
                    data-price="${{ $item->price }}" 
                    data-image="{{ asset('images/' . $item->image) }}" 
                    data-specs="{{ $item->specs }}"
                    data-stock="{{ $item->stock }}">
                    View Details
                </button>
                @if(auth()->user()->name === 'admin')
                <button class="delete-product bg-red-500 text-white px-4 py-2 rounded mt-2" data-id="{{ $item->id }}">Delete</button>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection