<!-- Navigation -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Category Button -->
        <button id="categoryButton" class="text-black text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Logo -->
        <div class="text-center">
            <a href="{{ route('index') }}" class="text-2xl font-bold">SHOP TIME</a>
        </div>

        <!-- User Dropdown -->
        <div class="relative">
            <button id="userDropdown" class="text-black text-lg">{{ Auth::user()->name ?? 'Guest' }}</button>
            <div id="dropdownContent" class="hidden absolute right-0 mt-2 bg-white border border-black rounded-lg shadow-lg">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-black hover:bg-gray-100">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Include Sidebar -->
@include('content.sidebar')

<script>
    // Toggle User Dropdown
    document.getElementById('userDropdown').addEventListener('click', () => {
        document.getElementById('dropdownContent').classList.toggle('hidden');
    });

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
</script>