<!-- Navigation Bar -->
@include('admin.header')

<!-- Sidebar -->
@include('admin.sidebar')

<div class="mt-20">


<!-- Main Content Area -->
<div class="p-4 sm:ml-64">
    <!-- Default content -->
    <div id="default-content">
        <h1 class="text-4xl text-center text-gray-600">داشبورد</h1>

        <style>
            .clock-container {
                background: #ececec;
                width: 300px;
                height: 300px;
                margin: 6% auto 0;
                border-radius: 50%;
                border: 0px solid #333;
                position: relative;
                box-shadow: 0 2vw 4vw -1vw rgba(0, 0, 0, 0.8);
            }

            .clock-dot {
                width: 14px;
                height: 14px;
                border-radius: 50%;
                background: #ccc;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                margin: auto;
                position: absolute;
                z-index: 10;
                box-shadow: 0 2px 4px -1px black;
            }

            .clock-hour-hand {
                position: absolute;
                z-index: 5;
                width: 4px;
                height: 65px;
                background: #333;
                top: 79px;
                transform-origin: 50% 72px;
                left: 50%;
                margin-left: -2px;
                border-top-left-radius: 50%;
                border-top-right-radius: 50%;
            }

            .clock-minute-hand {
                position: absolute;
                z-index: 6;
                width: 4px;
                height: 100px;
                background: #666;
                top: 46px;
                left: 50%;
                margin-left: -2px;
                border-top-left-radius: 50%;
                border-top-right-radius: 50%;
                transform-origin: 50% 105px;
            }

            .clock-second-hand {
                position: absolute;
                z-index: 7;
                width: 2px;
                height: 120px;
                background: gold;
                top: 26px;
                left: 50%;
                margin-left: -1px;
                border-top-left-radius: 50%;
                border-top-right-radius: 50%;
                transform-origin: 50% 125px;
            }

            .clock-number {
                display: inline-block;
                position: absolute;
                color: #333;
                font-size: 22px;
                font-family: 'Poiret One';
                font-weight: 700;
                z-index: 4;
            }

            .clock-h12 {
                top: 30px;
                left: 50%;
                margin-left: -9px;
            }

            .clock-h3 {
                top: 140px;
                right: 30px;
            }

            .clock-h6 {
                bottom: 30px;
                left: 50%;
                margin-left: -5px;
            }

            .clock-h9 {
                left: 32px;
                top: 140px;
            }

            .clock-dial-lines {
                position: absolute;
                z-index: 2;
                width: 2px;
                height: 15px;
                background: #666;
                left: 50%;
                margin-left: -1px;
                transform-origin: 50% 150px;
            }

            .clock-dial-lines:nth-of-type(5n) {
                width: 4px;
                height: 25px;
            }

            .clock-info {
                position: absolute;
                width: 120px;
                height: 20px;
                border-radius: 7px;
                background: #ccc;
                text-align: center;
                line-height: 20px;
                color: #000;
                font-size: 11px;
                top: 200px;
                left: 50%;
                margin-left: -60px;
                font-family: "Poiret One";
                font-weight: 700;
                z-index: 3;
                letter-spacing: 3px;
            }

            .clock-date {
                top: 80px;
            }

            .clock-day {
                top: 200px;
            }
        </style>

        <div class="clock-container">
            <div>
                <div class="clock-info clock-date"></div>
                <div class="clock-info clock-day"></div>
            </div>
            <div class="clock-dot"></div>
            <div>
                <div class="clock-hour-hand"></div>
                <div class="clock-minute-hand"></div>
                <div class="clock-second-hand"></div>
            </div>
            <div>
                <span class="clock-number clock-h3">3</span>
                <span class="clock-number clock-h6">6</span>
                <span class="clock-number clock-h9">9</span>
                <span class="clock-number clock-h12">12</span>
            </div>
            <div class="clock-dial-lines"></div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded top-0 flex justify-center fixed mt-24 max-w-fit text-center mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded top-0 flex justify-center fixed mt-24 max-w-fit text-center mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded top-0 flex justify-center fixed mt-24 max-w-fit text-center mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <script>
            var dialLines = document.getElementsByClassName('clock-dial-lines');
            var clockEl = document.getElementsByClassName('clock-container')[0];

            for (var i = 1; i < 60; i++) {
                clockEl.innerHTML += "<div class='clock-dial-lines'></div>";
                dialLines[i].style.transform = "rotate(" + 6 * i + "deg)";
            }

            function clock() {
                var weekday = [
                        "Sunday",
                        "Monday",
                        "Tuesday",
                        "Wednesday",
                        "Thursday",
                        "Friday",
                        "Saturday"
                    ],
                    d = new Date(),
                    h = d.getHours(),
                    m = d.getMinutes(),
                    s = d.getSeconds(),
                    date = d.getDate(),
                    month = d.getMonth() + 1,
                    year = d.getFullYear(),

                    hDeg = h * 30 + m * (360 / 720),
                    mDeg = m * 6 + s * (360 / 3600),
                    sDeg = s * 6,

                    hEl = document.querySelector('.clock-hour-hand'),
                    mEl = document.querySelector('.clock-minute-hand'),
                    sEl = document.querySelector('.clock-second-hand'),
                    dateEl = document.querySelector('.clock-date'),
                    dayEl = document.querySelector('.clock-day');

                var day = weekday[d.getDay()];

                if (month < 9) {
                    month = "0" + month;
                }

                hEl.style.transform = "rotate(" + hDeg + "deg)";
                mEl.style.transform = "rotate(" + mDeg + "deg)";
                sEl.style.transform = "rotate(" + sDeg + "deg)";
                dateEl.innerHTML = date + "/" + month + "/" + year;
                dayEl.innerHTML = day;
            }

            setInterval(clock, 100);
        </script>

    </div>

    @if(Auth::user()->role === 'admin')
        @include('admin.add_food')
        @include('admin.add_item')
        @include('admin.show_food')
        @include('admin.user_list')
        @include('admin.order')
        @include('admin.gallery')
    @endif

    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'doctor'))
        @include('admin.doctor')
    @endif

    @if(Auth::check() && Auth::user()->role === 'user')
        @include('admin.user_order')
        @include('admin.user_info')
    @endif
</div>
</div>
@section('scripts')


<script>
    // JavaScript for toggling dropdown
    const menuToggleButton = document.getElementById('menu-toggle-button');
    const dropdownMenu = document.getElementById('dropdown-example');
    const arrowIcon = document.getElementById('arrow-icon');

    // Only add event listener if the element exists
    if (menuToggleButton && dropdownMenu && arrowIcon) {
        menuToggleButton.addEventListener('click', () => {
            // Toggle visibility of dropdown
            dropdownMenu.classList.toggle('hidden');

            // Rotate the arrow by 180 degrees when dropdown is open
            arrowIcon.classList.toggle('rotate-180');
        });
    }

    // JavaScript for switching between sections
    const links = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.content-section');
    const defaultContent = document.getElementById('default-content');

    if (links.length > 0) {
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const target = this.getAttribute('data-target');

                // Only prevent default if it's a section navigation link
                if (target) {
                    e.preventDefault();

                    // Hide all sections
                    sections.forEach(section => section.classList.add('hidden'));

                    // Hide default content
                    if (defaultContent) {
                        defaultContent.classList.add('hidden');
                    }

                    // Show the selected section
                    const selectedSection = document.getElementById(target);
                    if (selectedSection) {
                        selectedSection.classList.remove('hidden');
                    }
                }
            });
        });
    }

    // Get elements
    const menuToggle = document.getElementById('menu-toggle'); // Hamburger menu button
    const sidebar = document.getElementById('logo-sidebar'); // Sidebar element

    // Only proceed if both elements exist
    if (menuToggle && sidebar) {
        // Check if the sidebar is hidden when page loads (in case the page is refreshed)
        if (window.innerWidth < 768) { // Check if it's mobile
            sidebar.classList.add('hidden'); // Hide sidebar initially
        }

        // Toggle sidebar for mobile view
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden'); // Show/Hide the sidebar
        });

        // Optional: Close sidebar when navigating to a new page (or click on an item)
        document.querySelectorAll('.nav-link').forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('hidden'); // Hide sidebar after clicking a link on mobile
                }
            });
        });

        // Close sidebar if clicking outside (optional for better UX)
        document.addEventListener('click', (event) => {
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target) && window.innerWidth < 768) {
                sidebar.classList.add('hidden');
            }
        });
    }
</script>
@endsection

