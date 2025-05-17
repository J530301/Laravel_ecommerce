
<nav class="bg-white shadow-lg w-full">
    <div class="container mx-auto flex flex-wrap items-center justify-between p-4">
        <!-- Left: Category Button -->
       <div class="flex items-center flex-shrink-0" style="width:56px;min-width:56px;">
            <button id="categoryButton" class="text-black text-lg rounded-full p-2 hover:bg-gray-100 transition shadow focus:outline-none" aria-label="Open categories">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Center: Logo (flex-grow for centering) -->
        <div class="flex-1 flex justify-center min-w-0 ">
            <a href="{{ route('index') }}" class="text-2xl sm:text-4xl font-extrabold tracking-tight text-gradient  bg-gradient-to-r from-blue-600 via-green-400 to-blue-500 bg-clip-text text-transparent select-none truncate">
                SHOP TIME
            </a>
        </div>

        <!-- Right: User Dropdown -->
        <div id="userNavButton" class="flex items-center flex-shrink-0 relative">
            <button id="userDropdown" class="flex items-center gap-2 text-black text-base sm:text-lg font-bold uppercase px-3 sm:px-4 py-2 rounded-full border-2 border-gray-200 shadow hover:bg-gray-100 transition focus:outline-none">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="hidden sm:inline truncate max-w-[80px] sm:max-w-[120px]">
                    {{ Auth::user() ? Str::lower(Auth::user()->name) : 'guest' }}
                </span>
                <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="dropdownContent"
                class="origin-top-right absolute right-0 mt-24 min-w-[160px] bg-white border-2 border-gray-200 rounded-xl shadow-lg z-50
                        transition-all duration-200 transform scale-y-0 opacity-0 pointer-events-none"
            >
                <div class="py-2">
                    <!-- Show name on mobile only -->
                    <div class="block sm:hidden px-6 py-2 text-gray-700 font-semibold rounded-lg">
                        {{ Auth::user() ? Str::lower(Auth::user()->name) : 'guest' }}
                    </div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="block px-6 py-2 text-black font-semibold rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle User Dropdown
        const userDropdown = document.getElementById('userDropdown');
        const dropdownContent = document.getElementById('dropdownContent');
        if (userDropdown && dropdownContent) {
            userDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownContent.classList.toggle('scale-y-0');
                dropdownContent.classList.toggle('opacity-0');
                dropdownContent.classList.toggle('pointer-events-none');
                dropdownContent.classList.toggle('scale-y-100');
                dropdownContent.classList.toggle('opacity-100');
                dropdownContent.classList.toggle('pointer-events-auto');
            });
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userDropdown.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.classList.add('scale-y-0', 'opacity-0', 'pointer-events-none');
                    dropdownContent.classList.remove('scale-y-100', 'opacity-100', 'pointer-events-auto');
                }
            });
        }

        // Toggle Sidebar
        const categoryButton = document.getElementById('categoryButton');
        const sidebar = document.getElementById('sidebar');
        const pageContent = document.getElementById('pageContent');
        if (categoryButton && sidebar) {
            categoryButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                categoryButton.classList.add('hidden'); // Hide the button
            });
        }

        // Close Sidebar
        const closeSidebar = document.getElementById('closeSidebar');
        if (closeSidebar && sidebar) {
            closeSidebar.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                categoryButton.classList.remove('hidden'); // Show the button
            });
        }
        // Hide user button when modal is open
        const addProductModal = document.getElementById('addProductModal');
        const userNavButton = document.getElementById('userNavButton');
        const addProductButton = document.getElementById('addProductButton');
        const closeAddProductModal = document.getElementById('closeAddProductModal');

        function hideUserNavButton() {
            if (userNavButton) userNavButton.classList.add('hidden');
        }
        function showUserNavButton() {
            if (userNavButton) userNavButton.classList.remove('hidden');
        }

        if (addProductButton && addProductModal) {
            addProductButton.addEventListener('click', () => {
                addProductModal.classList.remove('hidden');
                hideUserNavButton();
            });
        }
        if (closeAddProductModal && addProductModal) {
            closeAddProductModal.addEventListener('click', () => {
                addProductModal.classList.add('hidden');
                showUserNavButton();
            });
        }

        // Also hide on outside click (optional, if you close modal that way)
        window.addEventListener('keydown', function(e) {
            if (e.key === "Escape" && !addProductModal.classList.contains('hidden')) {
                addProductModal.classList.add('hidden');
                showUserNavButton();
            }
        });
    });
</script>