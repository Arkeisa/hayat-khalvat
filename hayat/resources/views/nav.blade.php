<nav class="bg-white md:fixed w-full z-20 top-0 start-0 border-b border-gray-200 pt-5 sm:pt-4 absolute">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-around lg:justify-between mx-auto p-4 text-3xl">
    <div class="hidden sm:block">
      <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="/images/logo-min.png" class="h-14" alt="کافه لوگو">
          <span class="self-center text-2xl font-semibold whitespace-nowrap">حیات خلوت</span>
      </a>
    </div>
      <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-3 justify-center">
        @auth
            <a href="/dash">
                <button type="button" class="btn px-7 btn-outline text-black hover:bg-slate-700 hover:text-white font-medium rounded-lg text-2xl py-2 text-center">داشبورد</button>
            </a>
        @else
            <a href="/login">
                <button type="button" class="btn px-7 btn-outline text-black hover:bg-slate-700 hover:text-white font-medium rounded-lg text-2xl py-2 text-center">ورود</button>
            </a>
        @endauth

        <a href="{{ url('addcart') }}">
            <button type="button" class="btn px-7 btn-outline text-black hover:bg-slate-700 hover:text-white font-medium rounded-lg text-2xl py-2 text-center">سبد خرید</button>
        </a>
      </div>
      <div id="navbar-sticky" class="hidden lg:flex flex-col md:flex-row items-center justify-between w-full md:w-auto ">
          <ul class="flex flex-col md:flex-row p-4 md:p-0 mt-4 md:mt-0 font-medium border border-gray-100 rounded-lg bg-gray-50 md:bg-white md:border-0 space-y-2 md:space-y-0 md:space-x-8 rtl:space-x-reverse">
              <li class="{{ request()->is('/') ? 'bg-blue-600 rounded-full py-2 px-4 bg-opacity-25' : '' }}"><a href="/" class="  block py-2 px-3  text-gray-900 md:p-0" aria-current="page">خانه</a></li>
              <li class="{{ request()->is('menu') ? 'bg-blue-600 rounded-full py-2 px-4 bg-opacity-25' : '' }}"><a href="/menu" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">منو</a></li>
              <li class="{{ request()->is('coffebuy') ? 'bg-blue-600 rounded-full py-2 px-4 bg-opacity-25' : '' }}"><a href="/coffebuy" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">فروشگاه</a></li>
              <li class="{{ request()->is('diet') ? 'bg-blue-600 rounded-full py-2 px-4 bg-opacity-25' : '' }}"><a href="/diet" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">رژیم غذایی</a></li>
              <li class="{{ request()->is('learn') ? 'bg-blue-600 rounded-full py-2 px-4 bg-opacity-25' : '' }}"><a href="/learn" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">آموزش</a></li>
              <li class="{{ request()->is('aboutus') ? 'bg-blue-600 rounded-full py-2 px-4 bg-opacity-25' : '' }}"><a href="/aboutus" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">درباره ما</a></li>
          </ul>
      </div>
  </div>
</nav>

{{-- nav mobile --}}
<div class="flex lg:hidden fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-white border border-gray-200 rounded-t-3xl bottom-0 left-1/2">
  <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
    <!-- Home Button -->
    <button
      id="home"
      data-page="home"
      type="button"
      onclick="window.location.href = '{{ url('/') }}'"
      class="{{ request()->is('/') ? 'bg-blue-600 rounded-full p-2 bg-opacity-25' : '' }} inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50 group"
    >
    <svg class="w-6 h-6 mb-1 text-gray-500" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0L0 6V8H1V15H4V10H7V15H15V8H16V6L14 4.5V1H11V2.25L8 0ZM9 10H12V13H9V10Z" fill="#000000"/>
      </svg>
      <span class="sr-only">خانه</span>
    </button>

    <!-- Wallet Button -->
    <button
      id="wallet"
      data-page="wallet"
      type="button"
      onclick="window.location.href = '{{ url('/menu') }}'"
      class="{{ request()->is('menu') ? 'bg-blue-600 rounded-full p-2 bg-opacity-25' : '' }} inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group"
    >
    <svg class="w-6 h-6 mb-1 text-gray-500" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
    viewBox="0 0 275.353 275.353" xml:space="preserve">
 <g>
   <g>
     <g>
       <g>
         <path style="fill:#010002;" d="M229.784,199.712c27.269,0,45.568-29.692,45.568-57.419c0-20.117-12.418-22.843-24.562-22.843
           c-3.468,0-7.21,0.234-11.167,0.479c-3.195,0.176-6.507,0.332-9.848,0.41l0.039-0.889H1.514c0,42.959,24.132,80.321,59.686,99.49
           C24.787,221.333,0,226.043,0,231.445c0,7.865,51.782,14.196,115.659,14.196s115.649-6.331,115.649-14.196
           c0-5.432-24.904-10.132-61.454-12.516c10.63-5.725,20.263-13.004,28.529-21.641
           C208.026,199.712,219.448,199.712,229.784,199.712z M229.364,128.272c3.683-0.088,7.289-0.244,10.737-0.469
           c3.83-0.205,7.464-0.42,10.698-0.42c11.509,0,16.658,2.159,16.658,14.909c0,23.419-15.466,49.515-37.664,49.515
           c-9.751,0-18.3-0.205-25.285-1.358C218.559,173.196,227.537,151.731,229.364,128.272z M98.982,97.203
           c-0.557-0.547-13.414-13.922,0.156-30.327c16.58-20,0.01-37-0.156-37.166l-3.595,3.595c0.557,0.537,13.414,13.932-0.166,30.327
           c-16.58,20.029-0.01,37.039,0.166,37.195L98.982,97.203z M118.737,97.203c-0.557-0.547-13.414-13.922,0.166-30.327
           c16.56-20,0-37-0.166-37.166l-3.605,3.595c0.557,0.537,13.414,13.932-0.156,30.327c-16.56,20.039-0.01,37.039,0.166,37.205
           L118.737,97.203z M140.251,97.203c-0.557-0.547-13.414-13.922,0.156-30.327c16.57-20,0-37-0.156-37.166l-3.615,3.595
           c0.547,0.537,13.424,13.932-0.166,30.327c-16.56,20.039,0,37.039,0.176,37.205L140.251,97.203z"/>
       </g>
     </g>
   </g>
 </g>
 </svg>
      <span class="sr-only">منو</span>
    </button>

    <!-- Add New Button -->
    
    <div class="flex items-center justify-center">
      <button
        id="new"
        data-page="new"
        type="button"
        onclick="window.location.href = '{{ url('/coffebuy') }}'"
        class="{{ request()->is('coffebuy') ? 'bg-blue-600 rounded-full p-2 bg-opacity-25' : '' }} inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group"
      >
      <svg class="w-6 h-6 mb-1 text-gray-500" fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 326.05 326.05"
	 xml:space="preserve">
<g>
	<path d="M14.257,275.602C-17.052,220.391,4.253,133.798,69.023,69.01c73.553-73.543,175.256-91.076,227.182-39.16
		c0.061,0.068,0.112,0.145,0.195,0.214c-10.392,30.235-43.486,94.567-142.686,129.348C62.842,191.29,27.788,241.972,14.257,275.602z
		 M310.81,48.75c-7.871,18.361-21.57,42.356-45.173,65.957c-23.725,23.735-57.445,47.046-105.208,63.8
		C63.49,212.5,36.405,268.149,28.848,295.116c0.357,0.36,0.664,0.733,1.011,1.083c51.921,51.918,153.628,34.386,227.176-39.169
		C322.479,191.585,343.526,103.869,310.81,48.75z"/>
</g>
</svg>
        <span class="sr-only">خرید قهوه</span>
      </button>
    </div>

    <!-- Settings Button -->
    <button
      id="settings"
      data-page="settings"
      type="button"
      onclick="window.location.href = '{{ url('/diet') }}'"
      class="{{ request()->is('diet') ? 'bg-blue-600 rounded-full p-2 bg-opacity-25' : '' }} inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group"
    >
    <svg class="w-6 h-6 mb-1 text-gray-500" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
     viewBox="0 0 512 512"  xml:space="preserve">
 <g>
   <polygon class="st0" points="319.141,324.732 279.297,245.514 232.672,386.217 169.703,171.967 140.266,284.717 64.953,284.717 
     255.984,475.779 447.047,284.717 357.859,284.717 	"/>
   <path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.563-29.031,38.891-34.438,61.391
     c-5.375-22.5-16.844-43.828-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.672-50.688,132.875,0,183.547
     l3.594,3.594h80.625l46.125-176.703l65.656,223.328l40.875-123.281l50.344,100.156l22.75-23.5h122.406l3.594-3.594
     C524.672,207.123,524.672,124.92,473.984,74.248z"/>
 </g>
 </svg>
      <span class="sr-only">رژیم غذایی</span>
    </button>

    <!-- Profile Button -->
    <button
  id="profile"
  data-page="profile"
  type="button"
  onclick="window.location.href = '{{ url('/aboutus') }}'"
  class="{{ request()->is('aboutus') ? 'bg-blue-600 rounded-full p-2 bg-opacity-25' : '' }} inline-flex flex-col items-center justify-center px-5 rounded-e-full hover:bg-gray-50 group"
>
<svg class="w-6 h-6 mb-1 text-gray-500" viewBox="-4 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
      <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-106.000000, -413.000000)" fill="#000000">
          <path d="M118,422 C116.343,422 115,423.343 115,425 C115,426.657 116.343,428 118,428 C119.657,428 121,426.657 121,425 C121,423.343 119.657,422 118,422 L118,422 Z M118,430 C115.239,430 113,427.762 113,425 C113,422.238 115.239,420 118,420 C120.761,420 123,422.238 123,425 C123,427.762 120.761,430 118,430 L118,430 Z M118,413 C111.373,413 106,418.373 106,425 C106,430.018 116.005,445.011 118,445 C119.964,445.011 130,429.95 130,425 C130,418.373 124.627,413 118,413 L118,413 Z" id="location" sketch:type="MSShapeGroup">

</path>
      </g>
  </g>
</svg>
  <span class="sr-only">درباره ما</span>
</button>


  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Get all the buttons and the current route from Laravel
    const buttons = document.querySelectorAll(".nav-btn");

    buttons.forEach((button) => {
        // Get the data-page attribute for comparison
        const page = button.getAttribute("data-page");

        // If the button's data-page matches the current route, add active styles
        if (page === window.currentRoute) {
            button.classList.add("bg-blue-600", "text-white");
            button.querySelector("svg").classList.add("text-white"); // If you have SVG icons inside the buttons
        } else {
            button.classList.remove("bg-blue-600", "text-white");
            button.querySelector("svg").classList.remove("text-white");
        }
    });
});

</script>


{{-- end nav mobile --}}

<script>
    function toggleMenu() {
    const menu = document.getElementById('navbar-sticky');
    menu.classList.toggle('hidden');
}
  </script>
