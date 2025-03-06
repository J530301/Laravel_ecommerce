<!-- Sidebar for Categories -->
<div id="sidebar" class="fixed inset-y-0 left-0 bg-white w-64 shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
    <div class="p-4">
        <button id="closeSidebar" class="text-black text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <ul class="mt-4">
            <li class="mb-2 flex items-center">
                <a href="{{ route('index') }}" class="text-black hover:text-gray-700 w-full text-left text-1xl flex items-center bg-green-200 bg-opacity-70 border border-green-500 p-2 rounded">
                    <svg class="w-4 h-4 mr-2 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0l-7 7-2-2m0 0l7-7 7 7"></path>
                    </svg>
                    <span class="">Home</span>
                </a>
            </li>
            <li class="mb-2">
                <button id="addProductButton" class="text-black hover:text-gray-700 w-full text-left flex items-center bg-green-200 bg-opacity-70 border border-green-500 p-2 rounded">
                    <svg class="w-4 h-4 mr-2 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Product
                </button>
            </li>
            <li class="mb-2">
                <h2 class="text-black w-full text-left flex items-center font-bold">
                    Product Category
                </h2>
                <ul id="productCategoryList" class="mt-2 ml-4">
                    <li class="mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-black" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="10" cy="10" r="3"></circle>
                        </svg>
                        <h3><a href="{{ route('phone') }}" class="text-black hover:text-gray-700">Phones</a></h3>
                    </li>
                    <li class="mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-black" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="10" cy="10" r="3"></circle>
                        </svg>
                        <h3><a href="{{ route('computer') }}" class="text-black hover:text-gray-700">Computers</a></h3>
                    </li>
                    <li class="mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-black" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="10" cy="10" r="3"></circle>
                        </svg>
                        <h3><a href="{{ route('laptop') }}" class="text-black hover:text-gray-700">Laptops</a></h3>
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
     // Toggle Sidebar
     document.getElementById('categoryButton').addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('pageContent').classList.toggle('ml-64'); // Adjust content width
    });

    // Close Sidebar
    document.getElementById('closeSidebar').addEventListener('click', () => {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('pageContent').classList.remove('ml-64'); // Reset content width
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