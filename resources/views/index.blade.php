@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">



<div 
    class="w-full min-h-screen bg-cover bg-center"
    style="background-image: url('{{ asset('images/banner-bg.jpg') }}');"
>

        <div id="productOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-[102]">
            <div class="bg-white p-8 rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 mx-auto mt-10 relative">
                <div class="flex justify-between items-center mb-6">
                    @if(auth()->user()->role === 'admin')
                        <h5 class="text-2xl font-extrabold text-gray-900">Update Product</h5>
                    @else
                        <h5 class="text-2xl font-extrabold text-gray-900">Product Details</h5>
                    @endif
                    <button id="closeOverlay" class="text-gray-700 text-3xl font-bold hover:text-red-500 transition">&times;</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="w-full h-96 flex items-center justify-center overflow-hidden relative bg-gray-100 rounded-xl shadow-inner">
                        <img src="" id="overlayImage" class="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105" style="width: 371px; height: 371px; object-fit: contain;">
                        @if(auth()->user()->role === 'admin')
                            <input type="file" id="editImageInput" class="hidden">
                           <div id="editImageOverlay" class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-40 text-white text-lg font-bold cursor-pointer rounded-xl hover:bg-opacity-60 transition space-y-4">
                                <span class="hover:underline decoration-4 decoration-blue-500 hover:decoration-green-400 transition">Edit Image</span>
                                <button id="updateImageButton"
                                    class="w-[100px] bg-gradient-to-r from-blue-500 to-green-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition hover:underline decoration-4 decoration-blue-500 hover:decoration-green-400 focus:outline-none">
                                    Update Image
                                </button>
                            </div>
                            
                        @endif
                    </div>
                    <div>
                        @if(auth()->user()->role === 'admin')
                            <h6 class="text-lg mb-2 text-gray-700">Product ID: <span id="overlayProductID" class="font-semibold"></span></h6>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                                <div class="flex items-center gap-2">
                                    <input type="text" id="editProductName" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                                    <button id="updateProductName" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition">Update</button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Price</label>
                                <div class="flex items-center gap-2">
                                    <input type="number" id="editProductPrice" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                                    <button id="updateProductPrice" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition">Update</button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Specifications</label>
                                <div class="flex items-center gap-2">
                                    <textarea id="editProductSpecs" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"></textarea>
                                    <button id="updateProductSpecs" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition">Update</button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Stock</label>
                                <div class="flex items-center gap-2">
                                    <input type="number" id="stockInput" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                                    <button id="updateProductStock" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition">Update</button>
                                </div>
                            </div>
                            <button id="saveAllChanges" class="w-full mt-4 bg-gradient-to-r from-green-400 to-blue-500 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition">Save All Changes</button>
                        @else
                            <h4 id="overlayProduct" class="text-2xl font-extrabold text-gray-900 mb-2"></h4>
                            <p id="overlayPrice" class="text-lg text-blue-600 mb-2"></p>
                            <div id="overlaySpecs" class="text-sm text-gray-700 mb-2"></div>
                            <p class="text-sm text-gray-600 mb-4">Stock: <span id="overlayStock"></span> left</p>
                            <div class="flex items-center mt-4 gap-2">
                                <button id="decreaseQuantity" class="bg-gradient-to-r from-gray-700 to-gray-900 text-white px-4 py-2 rounded-lg font-bold hover:scale-110 transition">-</button>
                                <input type="text" id="quantity" value="1" class="w-16 text-center border-2 border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                                <button id="increaseQuantity" class="bg-gradient-to-r from-gray-700 to-gray-900 text-white px-4 py-2 rounded-lg font-bold hover:scale-110 transition">+</button>
                            </div>
                            <div class="mt-6">
                                <button id="buyButton" class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition">Buy Now</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- First Row: Quotes Slider -->

        <div class="flex justify-center items-center py-12 md:py-20">
            <div class="w-full max-w-2xl mx-auto">
                <div id="quoteSlider" class="rounded-2xl shadow-2xl bg-white bg-opacity-80 p-8 text-center transition-all duration-500">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4" id="quoteText"></h2>
                    <p class="text-lg text-gray-700" id="quoteAuthor"></p>
                </div>
            </div>
        </div>
        <!-- Second Row: Product Slider -->
        <div class="flex justify-center items-center pb-12 md:pb-20">
            <div class="w-full max-w-4xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <button id="prevCategory" class="bg-white hover:bg-opacity-100 text-gray-900 rounded-full shadow p-2 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <h1 id="categoryTitle" class="text-3xl md:text-4xl font-extrabold text-gray-900 text-center"></h1>
                    <button id="nextCategory" class="bg-white bg-opacity-80 hover:bg-opacity-100 text-gray-900 rounded-full shadow p-2 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <div id="productContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-6"></div>
            </div>
        </div>
    
</div>


<script>
    // Quotes for the slider
    const quotes = [
        { text: "Great things never come from comfort zones.", author: "Ecommerce Proverb" },
        { text: "Your most unhappy customers are your greatest source of learning.", author: "Bill Gates" },
        { text: "Make it simple. Make it memorable. Make it inviting to look at.", author: "Leo Burnett" }
    ];
    let currentQuote = 0;
    function showQuote(idx) {
        document.getElementById('quoteText').textContent = quotes[idx].text;
        document.getElementById('quoteAuthor').textContent = quotes[idx].author;
    }
    function nextQuote() {
        currentQuote = (currentQuote + 1) % quotes.length;
        showQuote(currentQuote);
    }
    // Auto-slide quotes every 4 seconds
    showQuote(currentQuote);
    setInterval(nextQuote, 4000);

    // Product categories for the slider
    const categories = {
        'Phones': @json($phoneProducts),
        'Computers': @json($computerProducts),
        'Laptops': @json($laptopProducts)
    };
    let currentCategoryIndex = 0;
    const categoryKeys = Object.keys(categories);
    const productContainer = document.getElementById('productContainer');
    const categoryTitle = document.getElementById('categoryTitle');

    function displayProducts(category) {
        productContainer.innerHTML = '';
        categoryTitle.textContent = category;
        const products = categories[category].slice(0, 2); // Only 2 products
        products.forEach(product => {
            const productDiv = document.createElement('div');
            productDiv.className = 'bg-white bg-opacity-80 border-2 border-gray-200 rounded-2xl shadow-xl p-6 flex flex-col items-center hover:shadow-2xl hover:scale-105 transition-all duration-200';
            productDiv.innerHTML = `
                <img src="{{ asset('images') }}/${product.image}" class="w-48 h-48 object-contain rounded-xl mb-4 bg-gray-100 shadow-inner" alt="${product.name}">
                <h4 class="text-xl font-bold text-gray-900 mb-2">${product.name.length > 32 ? product.name.substring(0, 32) + '...' : product.name}</h4>
                <p class="text-lg text-blue-600 font-semibold mb-2">Price: $${product.price}</p>
                <button class="view-details bg-gradient-to-r from-green-400 to-blue-500 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition"
                    data-id="${product.id}"
                    data-product="${product.name}" 
                    data-price="${product.price}" 
                    data-image="{{ asset('images') }}/${product.image}" 
                    data-specs="${product.specs}"
                    data-stock="${product.stock}">
                    View Details
                </button>
                @if(auth()->user()->role === 'admin')
                <button class="delete-product bg-gradient-to-r from-red-500 to-pink-500 text-white px-4 py-2 rounded-lg font-bold shadow hover:scale-105 transition mt-2" data-id="${product.id}">Delete</button>
                @endif
            `;
            productContainer.appendChild(productDiv);
        });
    }

    function nextCategory() {
        currentCategoryIndex = (currentCategoryIndex + 1) % categoryKeys.length;
        displayProducts(categoryKeys[currentCategoryIndex]);
    }
    function prevCategory() {
        currentCategoryIndex = (currentCategoryIndex - 1 + categoryKeys.length) % categoryKeys.length;
        displayProducts(categoryKeys[currentCategoryIndex]);
    }

    document.getElementById('nextCategory').addEventListener('click', nextCategory);
    document.getElementById('prevCategory').addEventListener('click', prevCategory);

    // Auto-slide categories every 6 seconds
    setInterval(nextCategory, 6000);

    // Initial display
    displayProducts(categoryKeys[currentCategoryIndex]);
</script>
@endsection