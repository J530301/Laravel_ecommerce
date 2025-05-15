<!-- Navigation -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Category Button -->
        <button id="categoryButton" class="text-black text-lg rounded-full p-2 hover:bg-gray-100 transition shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Logo -->
        <div class="text-center flex-1 pl-24">
            <a href="{{ route('index') }}" class="text-3xl font-extrabold tracking-tight text-gradient bg-gradient-to-r from-blue-600 via-green-400 to-blue-500 bg-clip-text text-transparent select-none">
                SHOP TIME
            </a>
        </div>

        <!-- User Dropdown -->
        <div class="relative">
    <button id="userDropdown" class="flex items-center gap-2 text-black text-lg font-bold uppercase px-4 py-2 rounded-full border-2 border-gray-200 shadow hover:bg-gray-100 transition">
        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        {{ Auth::user() ? Str::lower(Auth::user()->name) : 'guest' }}
        <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div id="dropdownContent" class="hidden absolute right-0 mt-2 min-w-[180px] bg-white border-2 border-gray-200 rounded-xl shadow-lg z-50">
        <div class="py-2">
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


<!-- ...existing code... -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle User Dropdown
        const userDropdown = document.getElementById('userDropdown');
        const dropdownContent = document.getElementById('dropdownContent');
        if (userDropdown && dropdownContent) {
            userDropdown.addEventListener('click', () => {
                dropdownContent.classList.toggle('hidden');
            });
        }

        // Toggle Sidebar
        const categoryButton = document.getElementById('categoryButton');
        const sidebar = document.getElementById('sidebar');
        const pageContent = document.getElementById('pageContent');
        if (categoryButton && sidebar && pageContent) {
            categoryButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
              
            });
        }

        // Close Sidebar
        const closeSidebar = document.getElementById('closeSidebar');
        if (closeSidebar && sidebar && pageContent) {
            closeSidebar.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                
            });
        }
    });
</script>
