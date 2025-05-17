@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Product Details Overlay -->
<div id="productOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center px-2 py-4">
   
    <div class="bg-white p-4 sm:p-8 rounded-2xl shadow-2xl w-full max-w-xs sm:max-w-lg lg:max-w-3xl mx-auto relative flex flex-col overflow-y-auto"
         style="max-height: 95vh;">
        <div class="flex flex-row items-center justify-between mb-4 sm:mb-6 gap-2">
            @if(auth()->user()->role === 'admin')
                <h5 class="text-xl sm:text-2xl font-extrabold text-gray-900 truncate flex items-center gap-2">
                    Update Product
                </h5>
            @else
                <h5 class="text-xl sm:text-2xl font-extrabold text-gray-900 truncate flex items-center gap-2">
                    Product Details
                </h5>
            @endif
            <button id="closeOverlay" class="text-gray-700 text-2xl sm:text-3xl font-bold hover:text-red-500 transition leading-none flex-shrink-0" aria-label="Close">&times;</button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-8 flex-1">
            <div class="w-full h-60 sm:h-96 flex items-center justify-center overflow-hidden relative bg-gray-100 rounded-xl shadow-inner">
                <img src="" id="overlayImage" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105" style="width: 100%; max-width: 371px; height: 100%; max-height: 371px; object-fit: contain;">
                @if(auth()->user()->role === 'admin')
                    <input type="file" id="editImageInput" class="hidden">
                    <div id="editImageOverlay" class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-40 text-white text-base sm:text-lg font-bold cursor-pointer rounded-xl hover:bg-opacity-60 transition space-y-2 sm:space-y-4">
                        <span class="hover:underline decoration-4 decoration-blue-500 hover:decoration-green-400 transition">Edit Image</span>
                        <button id="updateImageButton"
                            class="w-[90px] sm:w-[100px] bg-gradient-to-r from-blue-500 to-green-400 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition hover:underline decoration-4 decoration-blue-500 hover:decoration-green-400 focus:outline-none">
                            Update Image
                        </button>
                    </div>
                @endif
            </div>
            <div class="flex flex-col justify-between">
                @if(auth()->user()->role === 'admin')
                    <h6 class="text-base sm:text-lg mb-1 sm:mb-2 text-gray-700">Product ID: <span id="overlayProductID" class="font-semibold"></span></h6>
                    <div class="mb-2 sm:mb-4">
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                            <input type="text" id="editProductName" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm sm:text-base">
                            <button id="updateProductName" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base">Update</button>
                        </div>
                    </div>
                    <div class="mb-2 sm:mb-4">
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1">Price</label>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                            <input type="number" id="editProductPrice" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm sm:text-base">
                            <button id="updateProductPrice" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base">Update</button>
                        </div>
                    </div>
                    <div class="mb-2 sm:mb-4">
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1">Specifications</label>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                            <textarea id="editProductSpecs" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm sm:text-base"></textarea>
                            <button id="updateProductSpecs" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base">Update</button>
                        </div>
                    </div>
                    <div class="mb-2 sm:mb-4">
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1">Stock</label>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                            <input type="number" id="stockInput" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm sm:text-base">
                            <button id="updateProductStock" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base">Update</button>
                        </div>
                    </div>
                    <button id="saveAllChanges" class="w-full mt-2 sm:mt-4 bg-gradient-to-r from-green-400 to-blue-500 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base">Save All Changes</button>
                @else
                    <h4 id="overlayProduct" class="text-xl sm:text-2xl font-extrabold text-gray-900 mb-1 sm:mb-2"></h4>
                    <p id="overlayPrice" class="text-base sm:text-lg text-blue-600 mb-1 sm:mb-2"></p>
                    <div id="overlaySpecs" class="text-xs sm:text-sm text-gray-700 mb-1 sm:mb-2"></div>
                    <p class="text-xs sm:text-sm text-gray-600 mb-2 sm:mb-4">Stock: <span id="overlayStock"></span> left</p>
                    <div class="flex items-center mt-2 sm:mt-4 gap-2">
                        <button id="decreaseQuantity" class="bg-gradient-to-r from-gray-700 to-gray-900 text-white px-3 sm:px-4 py-2 rounded-lg font-bold hover:scale-110 transition text-sm sm:text-base">-</button>
                        <input type="text" id="quantity" value="1" class="w-12 sm:w-16 text-center border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm sm:text-base">
                        <button id="increaseQuantity" class="bg-gradient-to-r from-gray-700 to-gray-900 text-white px-3 sm:px-4 py-2 rounded-lg font-bold hover:scale-110 transition text-sm sm:text-base">+</button>
                    </div>
                    <div class="mt-4 sm:mt-6">
                        <button id="buyButton" class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base">Buy Now</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Product Display -->
<div class="container mx-auto px-2 sm:px-6 py-4 sm:py-6">
    <h1 class="text-2xl sm:text-4xl font-extrabold mb-4 sm:mb-8 text-gray-900 tracking-tight">Phones</h1>
    <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-8">
        @foreach($phoneProducts as $item)
            <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl p-4 sm:p-6 flex flex-col items-center hover:shadow-2xl hover:scale-105 transition-all duration-200">
                <img src="{{ asset('images/' . $item->image) }}" class="w-40 h-40 sm:w-60 sm:h-60 object-contain rounded-xl mb-2 sm:mb-4 bg-gray-100 shadow-inner" alt="{{ $item->name }}">
                <h4 class="text-lg sm:text-2xl font-bold text-gray-900 mb-1 sm:mb-2">
                    {{ \Illuminate\Support\Str::limit($item->name, 32, '...') }}
                </h4>
                <p class="text-base sm:text-xl text-blue-600 font-semibold mb-1 sm:mb-2">Price: ${{ $item->price }}</p>
                <div class="flex flex-col w-full gap-2">
                    <button class="view-details bg-gradient-to-r from-green-400 to-blue-500 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base"
                        data-id="{{ $item->id }}"
                        data-product="{{ $item->name }}" 
                        data-price="${{ $item->price }}" 
                        data-image="{{ asset('images/' . $item->image) }}" 
                        data-specs="{{ $item->specs }}"
                        data-stock="{{ $item->stock }}">
                        View Details
                    </button>
                    @if(auth()->user()->role === 'admin')
                        <button class="delete-product bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 sm:px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition text-sm sm:text-base" data-id="{{ $item->id }}">Delete</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection