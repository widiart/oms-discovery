<nav class="bg-white p-2 px-4 h-16">
  <div class="container mx-auto flex justify-between items-center h-full">
    <!-- Logo -->
    <span href="#" class="text-gray-800 text-lg font-bold">Admin Panel</span>

    <!-- Profile Dropdown -->
    <div class="relative">
      <button class="text-gray-800 hover:text-indigo-500 cursor-pointer p-2 m-2 border-2 border-gray-800 rounded-full hover:border-indigo-500" onclick="toggleDropdown()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-4 h-4">
          <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
        </svg>
      </button>
      <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden" id="dropdown-menu">
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
      </div>
    </div>
  </div>
</nav>