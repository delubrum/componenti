<li class="dropdown" x-data="{ isOpen: false}">
  <button 
    class="text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600"
    type="button" 
    @click="isOpen = !isOpen" 
  >
    <i class="ri-notification-3-line"></i>
    <!-- <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">99</span> -->
  </button>
  <ul 
    class="max-h-64 overflow-y-auto shadow-md shadow-black/5 z-30 max-w-xs w-full bg-white rounded-md border border-gray-100 my-2" 
    style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-54px, 48px, 0px);"
    x-cloak
    x-show="isOpen"
    @click.away="isOpen = false"
  >
  <li>
    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
      <div class="ml-2">
        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
        <div class="text-[11px] text-gray-400">from a user</div>
      </div>
    </a>
  </li>
  </ul>
</li>