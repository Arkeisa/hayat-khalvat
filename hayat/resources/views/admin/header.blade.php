<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button id="menu-toggle" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-xl text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">داشبورد</span>
                    <svg class="w-10 h-10" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H14M4 18H9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                </button>
                <a href="/" class="flex ms-2 md:me-24">
                    <img src="/images/logo-min.png" class="h-14" alt="کافه لوگو">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">کافه حیات خلوت</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3 mx-6 md:mx-16">
                    <div>
                        <button type="button" class="flex text-xl rounded-full focus:ring-4 focus:ring-gray-300 " aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">داشبورد</span>
                            <svg class="w-12 h-12 rounded-full overflow-hidden border-blue-500 border-4 p-0.5 border-opacity-70" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path d="m 8 1 c -1.65625 0 -3 1.34375 -3 3 s 1.34375 3 3 3 s 3 -1.34375 3 -3 s -1.34375 -3 -3 -3 z m -1.5 7 c -2.492188 0 -4.5 2.007812 -4.5 4.5 v 0.5 c 0 1.109375 0.890625 2 2 2 h 8 c 1.109375 0 2 -0.890625 2 -2 v -0.5 c 0 -2.492188 -2.007812 -4.5 -4.5 -4.5 z m 0 0" fill="#2e3436"/>
                            </svg>
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-xl text-gray-900" role="none">{{ Auth::user()->name }}</p>
                            <p class="text-lg font-medium text-gray-900 truncate" role="none">{{ Auth::user()->role }}</p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                        <button type="submit" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group w-full">
                                            <span class="flex-1 text-3xl ms-3 whitespace-nowrap text-red-600">خروج</span>
                                        </button>
                                    </form>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
