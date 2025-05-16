<!-- Sidebar for Categories -->
<div id="sidebar" class="fixed inset-y-0 left-0 bg-gray-900 w-64 shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
    <div class="p-4">
        <button id="closeSidebar" class="text-white text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
       <ul class="mt-4">
               <li class="mb-4 flex items-center">
                    <a href="{{ route('index') }}"
                    class="flex items-center gap-4 px-10 py-4 rounded-xl bg-gradient-to-r from-gray-100 to-gray-300 text-black text-3xl font-extrabold shadow-lg border-4 border-black hover:scale-105 hover:shadow-2xl transition-all duration-200">
                        <!-- Home Icon -->
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6"></path>
                        </svg>
                        Home
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                    <li class="mb-4 flex gap-2">
                        <button id="addProductButton"
                            class="flex items-center gap-4 px-6 py-4 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-600 text-black text-2xl font-bold shadow-lg border-4 border-yellow-700 hover:scale-105 hover:shadow-2xl transition-all duration-200 w-full text-left">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Product
                        </button>
                        
                    </li>
                     <li class="mb-4 flex gap-2">
                        <a href="{{ route('users.index') }}"
                            class="flex items-center gap-4 px-6 py-4 rounded-xl bg-gradient-to-r from-blue-400 to-blue-700 text-white text-2xl font-bold shadow-lg border-4 border-blue-800 hover:scale-105 hover:shadow-2xl transition-all duration-200 w-full text-left">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Account
                        </a>
                    </li>
                @else
                    <li class="mb-4 flex items-center">
                        <a href="{{ route('orders') }}"
                        class="flex items-center gap-4 px-4 py-4 rounded-xl bg-gradient-to-r from-gray-100 to-gray-300 text-black text-3xl font-extrabold shadow-lg border-4 border-black hover:scale-105 hover:shadow-2xl transition-all duration-200">
                            <!-- Purchase Icon (Shopping Cart) -->
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"></path>
                            </svg>
                            Purchase
                        </a>
                    </li>
                @endif
            <li class="mb-2 pt-5">
                <h2 class="text-white w-full pl-3 text-left text-2xl flex items-center font-bold mb-4">
                    Product Category
                </h2>
                <ul id="productCategoryList" class="space-y-3">
                    <li>
                        <a href="{{ route('phone') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-green-400 to-blue-500 text-white text-xl font-semibold shadow-lg border-2 border-blue-400 hover:scale-105 hover:shadow-2xl transition-all duration-200">
                            <svg class="w-7 h-7 text-white opacity-90" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3"></circle>
                            </svg>
                            Phones
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('computer') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-purple-400 to-pink-500 text-white text-xl font-semibold shadow-lg border-2 border-pink-400 hover:scale-105 hover:shadow-2xl transition-all duration-200">
                            <svg class="w-7 h-7 text-white opacity-90" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3"></circle>
                            </svg>
                            Computers
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laptop') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-yellow-400 to-red-500 text-white text-xl font-semibold shadow-lg border-2 border-red-400 hover:scale-105 hover:shadow-2xl transition-all duration-200">
                            <svg class="w-7 h-7 text-white opacity-90" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3"></circle>
                            </svg>
                            Laptops
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<!-- Add Product Modal -->
<div id="addProductModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[999]">
    <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden border-0 animate-fade-in">
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-8 py-6 bg-gradient-to-r from-blue-500 to-green-400 rounded-t-3xl">
            <h5 class="text-2xl font-extrabold text-white tracking-wide flex items-center gap-2">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Product
            </h5>
            <button id="closeAddProductModal" class="text-white text-3xl font-bold hover:text-red-200 transition">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="px-8 py-8 bg-gray-50">
            <form id="addProductForm" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Product Name</label>
                    <input type="text" class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" name="name" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Price</label>
                    <input type="number" class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" name="price" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Specifications</label>
                    <textarea class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" name="specs" required></textarea>
                </div>
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-1">Stock</label>
                        <input type="number" class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" name="stock" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-1">Category</label>
                        <select class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" name="category" required>
                            <option value="Phones">Phones</option>
                            <option value="Computers">Computers</option>
                            <option value="Laptops">Laptops</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Product Image</label>
                    <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-blue-400 rounded-xl cursor-pointer bg-white hover:bg-blue-50 transition">
                        <svg class="w-12 h-12 text-blue-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h-4a1 1 0 01-1-1v-4h6v4a1 1 0 01-1 1z" />
                        </svg>
                        <span id="imageUploadText" class="text-blue-400 font-semibold">Click to upload image</span>
                        <input type="file" class="hidden" name="image" accept="image/*" id="productImageInput" required>
                    </label>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white text-lg font-bold py-3 rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-200">
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
document.getElementById('productImageInput').addEventListener('change', function() {
    const textSpan = document.getElementById('imageUploadText');
    if (this.files && this.files.length > 0) {
        textSpan.textContent = "Already selected an image";
    } else {
        textSpan.textContent = "Click to upload image";
    }
});

    // Open Add Product Modal
    document.getElementById('addProductButton').addEventListener('click', () => {
        document.getElementById('addProductModal').classList.remove('hidden');
    });

    // Close Add Product Modal
    document.getElementById('closeAddProductModal').addEventListener('click', () => {
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