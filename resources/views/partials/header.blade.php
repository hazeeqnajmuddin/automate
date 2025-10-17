<nav class="bg-gray-600 flex justify-between items-center px-6 py-3">
    <div class="flex items-center space-x-3">
        <a 
            href="{{ route('welcome') }}" 
            class="w-20 h-20 bg-black rounded-full flex items-center justify-center text-white font-bold text-sm hover:bg-gray-800 transition"
        >
            Automate
        </a>
    </div>

    <div class="flex items-center space-x-4">
        <a 
        href="{{ route('login') }}" 
           class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition">
           Login
        </a>
        <a 
        href="{{ route('signUp') }}" 
           class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition">
           Sign Up
        </a>
    </div>
</nav>
