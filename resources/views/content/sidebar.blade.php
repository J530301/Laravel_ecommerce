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
                    <li class="mb-4">
                        <button id="addProductButton"
                            class="flex items-center gap-4 px-6 py-4 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-600 text-black text-2xl font-bold shadow-lg border-4 border-yellow-700 hover:scale-105 hover:shadow-2xl transition-all duration-200 w-full text-left">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Product
                        </button>
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
<div id="addProductModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/2 bg-white border border-black">
        <div class="p-4 border-b">
            <h5 class="text-xl font-bold">Add New Product</h5>
            <button id="closeAddProductModal" class="text-black text-lg">&times;</button>
        </div>
        <div class="p-4">
            <form id="addProductForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Product Name</label>
                    <input type="text" class="form-control w-full border rounded p-2" name="name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Price</label>
                    <input type="number" class="form-control w-full border rounded p-2" name="price" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Specifications</label>
                    <textarea class="form-control w-full border rounded p-2" name="specs" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Stock</label>
                    <input type="number" class="form-control w-full border rounded p-2" name="stock" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Category</label>
                    <select class="form-control w-full border rounded p-2" name="category" required>
                        <option value="Phones">Phones</option>
                        <option value="Computers">Computers</option>
                        <option value="Laptops">Laptops</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Product Image</label>
                    <input type="file" class="form-control-file w-full border rounded p-2" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary bg-blue-500 text-white rounded p-2">Add Product</button>
            </form>
        </div>
    </div>
</div>

<script>


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