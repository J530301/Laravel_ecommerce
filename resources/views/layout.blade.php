<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Time</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
   
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-black">
    <!-- Loading Screen -->
    <div id="loadingScreen" class="fixed inset-0 flex items-center justify-center bg-gray-100 z-50">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
    </div>

      @include('content.sidebar')

    <!-- Page Content (Initially Hidden) -->
    <div id="pageContent" class="hidden transition-opacity duration-500">
        @include('content.nav') <!-- Navbar -->
        @yield('content') <!-- Page Content -->
    </div>

    <!-- JavaScript to Control Loading -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                document.getElementById("loadingScreen").classList.add("hidden"); // Hide loader
                let content = document.getElementById("pageContent");
                content.classList.remove("hidden"); // Show content
                content.classList.add("opacity-100"); // Smooth fade-in
            }, 1000); // Short delay
        });
    </script>

    <!-- Scripts for functionality -->
    <script>
        
        $(document).ready(function () {
            // Toggle Sidebar
            
            

            // Show product details overlay
            $(document).on('click', '.view-details', function () {
                let productID = $(this).data("id");
                let product = $(this).data("product"),
                    price = $(this).data("price"),
                    image = $(this).data("image"),
                    specs = $(this).data("specs") || "Specifications not available.";
                stock = parseInt($(this).data("stock"));
    
                $("#overlayProductID").text(productID);
                $("#overlayProduct").text(product);
                $("#overlayPrice").text("Price: $" + price);
                $("#overlayImage").attr("src", image);
                $("#overlaySpecs").html(specs);
                $("#overlayStock").text(stock);
                $("#quantity").val(1);
    
                if ($(this).closest('body').find('#editProductName').length) {
                    $("#editProductName").val(product);
                    $("#editProductPrice").val(price);
                    $("#editProductSpecs").val(specs);
                    $("#stockInput").val(stock);
                }
    
                $("#productOverlay").fadeIn();
            });
    
            // Close overlay
            $("#closeOverlay").click(function () {
                if (name === 'admin') {
                    location.reload(); // Reload page for admin
                } else {
                    $("#productOverlay").hide(); // Close modal for non-admin
                }
            });
    
            // Adjust quantity
            $("#increaseQuantity").click(() => {
                let quantity = parseInt($("#quantity").val());
                if (quantity < stock) $("#quantity").val(quantity + 1);
            });
    
            $("#decreaseQuantity").click(() => {
                let quantity = parseInt($("#quantity").val());
                if (quantity > 1) $("#quantity").val(quantity - 1);
            });
    
            // Purchase product
            $("#buyButton").click(function () {
                let quantity = parseInt($("#quantity").val()),
                    productName = $("#overlayProduct").text();
    
                if (quantity > stock) return alert("Not enough stock available.");
    
                $.ajax({
                    url: "{{ route('buyProduct') }}",
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    data: { product: productName, quantity },
                    success: function (response) {
                        if (response.success) {
                            alert("Purchase successful!");
                            location.reload(); // Refresh the page after successful purchase
                        } else {
                            alert(response.message);
                        }
                    },
                    error: () => alert("An error occurred. Please try again."),
                });
            });
    
            // Save all changes
            $("#saveAllChanges").click(function () {
                let productID = $("#overlayProductID").text(),
                    productName = $("#editProductName").val(),
                    price = $("#editProductPrice").val(),
                    specs = $("#editProductSpecs").val(),
                    stock = $("#stockInput").val(),
                    image = $("#editImageInput")[0].files[0];
    
                let formData = new FormData();
                formData.append('id', productID);
                formData.append('name', productName);
                formData.append('price', price);
                formData.append('specs', specs);
                formData.append('stock', stock);
                if (image) {
                    formData.append('image', image);
                }
    
                $.ajax({
                    url: "{{ route('updateProduct') }}",
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            alert("Product updated successfully!");
                            location.reload(); // Refresh the page after successful update
                        } else {    
                            alert(response.message);
                        }
                    },
                    error: () => alert("Please update all other fields. Try again."),
                });
            });
    
            // Delete product
            $(document).on('click', '.delete-product', function() {
                let productId = $(this).data('id');
                let token = $('meta[name="csrf-token"]').attr('content');
    
                if (confirm("Are you sure you want to delete this product?")) {
                    $.ajax({
                        url: "{{ route('deleteProduct') }}",
                        type: "POST",
                        data: { _token: token, id: productId },
                        success: function(response) {
                            alert(response.success);
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseJSON.error);
                        }
                    });
                }
            });
    
            // Edit image overlay click
            $(document).on('click', '#editImageOverlay', function () {
                $("#editImageInput").click();
            });

            
        $(document).on('click', '#updateImageButton', function () {
            let productID = $("#overlayProductID").text();
            let image = $("#editImageInput")[0].files[0];

            if (!image) {
                alert("Please select an image first.");
                return;
            }

            let formData = new FormData();
            formData.append('id', productID);
            formData.append('image', image);

            $.ajax({
                url: "{{ route('updateProduct') }}",
                method: "POST",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        alert("Product image updated successfully!");
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: () => alert("An error occurred. Please try again."),
            });
        });


    // Update Product Name
    $("#updateProductName").click(function () {
        let productID = $("#overlayProductID").text();
        let productName = $("#editProductName").val();

        $.ajax({
            url: "{{ route('updateProduct') }}",
            method: "POST",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: { id: productID, name: productName },
            success: function (response) {
                if (response.success) {
                    alert("Product name updated successfully!");
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: () => alert("An error occurred. Please try again."),
        });
    });

    // Update Product Price
    $("#updateProductPrice").click(function () {
        let productID = $("#overlayProductID").text();
        let price = $("#editProductPrice").val();

        $.ajax({
            url: "{{ route('updateProduct') }}",
            method: "POST",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: { id: productID, price: price },
            success: function (response) {
                if (response.success) {
                    alert("Product price updated successfully!");
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: () => alert("An error occurred. Please try again."),
        });
    });

    // Update Product Specifications
    $("#updateProductSpecs").click(function () {
        let productID = $("#overlayProductID").text();
        let specs = $("#editProductSpecs").val();

        $.ajax({
            url: "{{ route('updateProduct') }}",
            method: "POST",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: { id: productID, specs: specs },
            success: function (response) {
                if (response.success) {
                    alert("Product specifications updated successfully!");
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: () => alert("An error occurred. Please try again."),
        });
    });

    // Update Product Stock
    $("#updateProductStock").click(function () {
        let productID = $("#overlayProductID").text();
        let stock = $("#stockInput").val();

        $.ajax({
            url: "{{ route('updateProduct') }}",
            method: "POST",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            data: { id: productID, stock: stock },
            success: function (response) {
                if (response.success) {
                    alert("Product stock updated successfully!");
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: () => alert("An error occurred. Please try again."),
        });
    });

        });
    </script>
    
    
</body>
</html>