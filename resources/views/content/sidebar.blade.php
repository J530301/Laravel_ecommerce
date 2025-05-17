<div id="sidebar" class="fixed inset-y-0 left-0 bg-white w-72 max-w-full shadow-2xl transform -translate-x-full transition-transform duration-300 z-50 flex flex-col">
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <span class="text-2xl font-extrabold text-blue-600 tracking-tight">Categories</span>
        <button id="closeSidebar" class="text-gray-700 hover:text-red-500 transition">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <nav class="flex-1 overflow-y-auto p-4 space-y-6">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-blue-100 to-blue-300 text-blue-900 font-bold shadow hover:scale-105 hover:shadow-lg transition">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6"/>
                    </svg>
                    Home
                </a>
            </li>
            @if(auth()->user()->role === 'admin')
                <li>
                    <button id="addProductButton"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-yellow-200 to-yellow-400 text-yellow-900 font-bold shadow hover:scale-105 hover:shadow-lg transition w-full text-left">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Product
                    </button>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-blue-200 to-blue-500 text-blue-900 font-bold shadow hover:scale-105 hover:shadow-lg transition">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Account
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('orders') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-green-100 to-green-300 text-green-900 font-bold shadow hover:scale-105 hover:shadow-lg transition">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                        </svg>
                        Purchase
                    </a>
                </li>
            @endif
        </ul>
        <div>
            <h2 class="text-lg font-bold text-gray-700 mb-2">Product Category</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('phone') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-green-200 to-blue-200 text-blue-900 font-semibold shadow hover:scale-105 hover:shadow-lg transition">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="3"></circle>
                        </svg>
                        Phones
                    </a>
                </li>
                <li>
                    <a href="{{ route('computer') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-purple-200 to-pink-200 text-purple-900 font-semibold shadow hover:scale-105 hover:shadow-lg transition">
                        <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="3"></circle>
                        </svg>
                        Computers
                    </a>
                </li>
                <li>
                    <a href="{{ route('laptop') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-yellow-200 to-red-200 text-yellow-900 font-semibold shadow hover:scale-105 hover:shadow-lg transition">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="3"></circle>
                        </svg>
                        Laptops
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>



<div id="addProductModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[9999] px-2 py-4">
    <div class="relative w-full max-w-xs sm:max-w-lg md:max-w-xl bg-white rounded-3xl shadow-2xl overflow-hidden border-0 animate-fade-in mx-auto flex flex-col"
        style="max-height: 95vh;">
        <!-- Modal Header -->
        <div class="flex flex-row items-center justify-between px-4 sm:px-8 py-4 sm:py-6 bg-gradient-to-r from-blue-500 to-green-400 rounded-t-3xl gap-2">
            <h5 class="text-xl sm:text-2xl font-extrabold text-white tracking-wide flex items-center gap-2 truncate">
                <svg class="w-7 h-7 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="truncate">Add Product</span>
            </h5>
            <button id="closeAddProductModal" class="text-white text-3xl font-bold hover:text-red-200 transition leading-none flex-shrink-0" aria-label="Close">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="px-4 sm:px-8 py-6 sm:py-8 bg-gray-50 overflow-y-auto flex-1">
            <form id="addProductForm" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Product Name</label>
                    <input type="text" class="w-full border-2 border-gray-200 rounded-xl p-2 sm:p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition text-sm sm:text-base" name="name" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Price</label>
                    <input type="number" class="w-full border-2 border-gray-200 rounded-xl p-2 sm:p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition text-sm sm:text-base" name="price" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Specifications</label>
                    <textarea class="w-full border-2 border-gray-200 rounded-xl p-2 sm:p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition text-sm sm:text-base" name="specs" required></textarea>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="w-full sm:w-1/2">
                        <label class="block text-gray-700 font-semibold mb-1">Stock</label>
                        <input type="number" class="w-full border-2 border-gray-200 rounded-xl p-2 sm:p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition text-sm sm:text-base" name="stock" required>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label class="block text-gray-700 font-semibold mb-1">Category</label>
                        <select class="w-full border-2 border-gray-200 rounded-xl p-2 sm:p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition text-sm sm:text-base" name="category" required>
                            <option value="Phones">Phones</option>
                            <option value="Computers">Computers</option>
                            <option value="Laptops">Laptops</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Product Image</label>
                    <label class="flex flex-col items-center justify-center w-full h-32 sm:h-40 border-2 border-dashed border-blue-400 rounded-xl cursor-pointer bg-white hover:bg-blue-50 transition">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-blue-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h-4a1 1 0 01-1-1v-4h6v4a1 1 0 01-1 1z" />
                        </svg>
                        <span id="imageUploadText" class="text-blue-400 font-semibold text-xs sm:text-base">Click to upload image</span>
                        <input type="file" class="hidden" name="image" accept="image/*" id="productImageInput" required>
                    </label>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white text-base sm:text-lg font-bold py-2 sm:py-3 rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-200">
                    Add Product
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(40px);}
    to { opacity: 1; transform: translateY(0);}
}
.animate-fade-in {
    animation: fade-in 0.4s cubic-bezier(.4,0,.2,1);
}
</style>

<script>
document.getElementById('productImageInput')?.addEventListener('change', function() {
    const textSpan = document.getElementById('imageUploadText');
    if (this.files && this.files.length > 0) {
        textSpan.textContent = "Already selected an image";
    } else {
        textSpan.textContent = "Click to upload image";
    }
});

// Open Add Product Modal
document.getElementById('addProductButton')?.addEventListener('click', () => {
    document.getElementById('addProductModal').classList.remove('hidden');
});

// Close Add Product Modal
document.getElementById('closeAddProductModal')?.addEventListener('click', () => {
    document.getElementById('addProductModal').classList.add('hidden');
});

// Add new product
document.getElementById("addProductForm")?.addEventListener("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch("{{ route('products.store') }}", {
        method: "POST",
        body: formData,
        headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Product added successfully!");
            location.reload(); // Refresh the page
        } else {
            alert("Error adding product.");
        }
    })
    .catch(error => console.error("Error:", error));
});
</script>