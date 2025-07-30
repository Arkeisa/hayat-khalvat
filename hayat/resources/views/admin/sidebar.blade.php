<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-white border-r border-gray-200 md:block hidden">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            @if(Auth::check() && Auth::user()->role === 'admin')
            <li>
                <button id="menu-toggle-button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                    <span class="flex-1 ms-3 text-3xl text-right">منو</span>
                    <!-- SVG arrow -->
                    <svg id="arrow-icon" class="w-3 h-3 transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#" class="nav-link flex text-xl items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100" data-target="add-cafe">افزودن ایتم منو</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link flex text-xl items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100" data-target="add-item">افزودن محصول</a>
                    </li>

                </ul>
            </li>
            @endif

            @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'doctor'))
            <li>
                <a href="#" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" data-target="doctor-section">
                    <span class="flex-1 text-3xl ms-3 whitespace-nowrap">دکتر</span>
                </a>
            </li>
            @endif

            @if(Auth::check() && Auth::user()->role === 'admin')
            <li>
                <a href="#" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" data-target="edit-menu">
                    <span class="flex-1 ms-3 text-3xl">ویرایش منو</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" data-target="user-list">
                    <span class="flex-1 ms-3 text-3xl">لیست کاربران</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" data-target="orders-section">
                    <span class="flex-1 text-3xl ms-3 whitespace-nowrap">سفارشات</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" data-target="gallery-section">
                    <span class="flex-1 text-3xl ms-3 whitespace-nowrap">گالری</span>
                </a>
            </li>
            @endif

            @if (Auth::check() && Auth::user()->role === 'user')
            <li>
                <a href="{{ route('user.orders') }}" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" data-target="user-order">
                    <span class="flex-1 ms-3 text-3xl">سفارش های شما</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user_info') }}" class="nav-link flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" data-target="user-info">
                    <span class="flex-1 ms-3 text-3xl">اطلاعات شما</span>
                </a>
            </li>
            @endif

            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <span class="flex-1 ms-3 text-3xl whitespace-nowrap">صفحه اصلی</span>
                </a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group w-full">
                        <span class="flex-1 text-3xl ms-3 whitespace-nowrap text-red-600">خروج</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
