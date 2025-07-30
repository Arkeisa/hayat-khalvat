<div class="container mx-auto mt-36 DIR-rtl px-3 text-2xl">
    @if(session('success'))
        <div class="alert alert-success shadow-lg mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error shadow-lg mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @php
        $categories = \App\Models\COFE::select('category')->distinct()->get();
    @endphp

    @foreach($categories as $category)
        <div class="w-fit px-7 py-3 bg-gradient-to-b bg-blue-600 bg-opacity-30 rounded-3xl opacity-90 my-12 text-center mx-auto flex gap-2 items-center">
            <h2 class="lg:text-4xl xxl:text-5xl md:text-3xl text-2xl mx-auto font-bold">
                {{ $category->category }}
            </h2>
        </div>

        <div class="grid grid-cols-1 px-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @php
                $items = \App\Models\COFE::where('category', $category->category)
                    ->orderBy('created_at', 'desc')
                    ->get();
            @endphp

            @foreach ($items as $item)
                <div class="flex flex-col items-center justify-center w-full max-w-sm mx-auto hover:scale-105 transition-all duration-300">
                    <div class="w-full h-64 bg-center bg-cover rounded-lg shadow-md"
                         style="background-image: url('{{ asset('food_img/' . $item->image) }}')">
                    </div>
                    <div class="indicator">
                        <span class="indicator-item badge badge-secondary hidden {{ $item->id }}indicator"></span>
                        <div class="w-56 -mt-10 overflow-hidden bg-base-100 text-base-content rounded-lg shadow-lg md:w-64 flex flex-col h-40">
                            <h3 class="py-2 font-bold tracking-wide text-center uppercase">{{ $item->title }}</h3>
                            <p class="text-xl px-4 flex-grow overflow-hidden text-ellipsis line-clamp-2">{{ $item->detail }}</p>
                            <div class="flex items-center justify-center flex-wrap lg:justify-between lg:flex-nowrap px-3 py-2">
                                <div class="mb-2">
                                    <span class="font-bold text-gray-800">{{ number_format($item->price) }} تومان</span>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <div class="hidden gap-4 quantity-controls{{ $item->id }}">
                                        <button onclick="decreaseQuantity('{{ $item->id }}', '{{ $item->title }}', '{{ $item->price }}')" class="btn bg-base-100 hover:bg-base-200 border-none btn-circle btn-sm text-gray-950">
                                            <svg fill="#000000" class="w-11 h-11" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 210.414 210.414" xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M105.207,0C47.196,0,0,47.196,0,105.207c0,58.011,47.196,105.207,105.207,105.207
                                                        c58.011,0,105.207-47.196,105.207-105.207C210.414,47.196,163.218,0,105.207,0z M105.207,202.621
                                                        c-53.715,0-97.414-43.699-97.414-97.414c0-53.715,43.699-97.414,97.414-97.414c53.715,0,97.414,43.699,97.414,97.414
                                                        C202.621,158.922,158.922,202.621,105.207,202.621z"/>
                                                    <path d="M155.862,101.31H54.552c-2.152,0-3.897,1.745-3.897,3.897c0,2.152,1.745,3.897,3.897,3.897h101.31
                                                        c2.152,0,3.897-1.745,3.897-3.897C159.759,103.055,158.014,101.31,155.862,101.31z"/>
                                                </g>
                                            </g>
                                        </g>
                                        </svg>
                                        </button>
                                        <span class="text-3xl" id="quantity{{ $item->id }}" class="mx-2 text-xl">1</span>
                                        <button onclick="increaseQuantity('{{ $item->id }}', '{{ $item->title }}', '{{ $item->price }}')" class="btn bg-base-100 hover:bg-base-200 border-none btn-circle btn-sm text-gray-950">
                                            <svg fill="#000000" class="w-11 h-11" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 52 52" xml:space="preserve">
                                       <g>
                                           <path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
                                               S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"/>
                                           <path d="M38.5,25H27V14c0-0.553-0.448-1-1-1s-1,0.447-1,1v11H13.5c-0.552,0-1,0.447-1,1s0.448,1,1,1H25v12c0,0.553,0.448,1,1,1
                                               s1-0.447,1-1V27h11.5c0.552,0,1-0.447,1-1S39.052,25,38.5,25z"/>
                                       </g>
                                       </svg>
                                        </button>
                                    </div>
                                    @auth
                                        <button onclick="addToCartHandler('{{ $item->id }}')" class="btn btn-outline btn-accent btn-sm addtoCart{{ $item->id }}">افزودن به سبد خرید</button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline btn-accent btn-sm">
                                            افزودن به سبد خرید
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
const quantities = {};

// Add this function to initialize quantities from cart
async function initializeCartQuantities() {
    try {
        const response = await fetch('/get-coffee-cart-items', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            const errorData = await response.json();
            console.error('Server returned:', response.status, response.statusText, errorData);
            return;
        }

        const data = await response.json();
        if (data.success && data.items && Array.isArray(data.items)) {
            data.items.forEach(item => {
                if (item && item.coffee_id) {
                    quantities[item.coffee_id] = parseInt(item.quantity) || 0;
                    const addToCartBtn = document.querySelector(`.addtoCart${item.coffee_id}`);
                    const quantityControls = document.querySelector(`.quantity-controls${item.coffee_id}`);
                    if (addToCartBtn && quantityControls) {
                        addToCartBtn.style.display = 'none';
                        quantityControls.style.display = 'flex';
                        const quantityDisplay = document.getElementById(`quantity${item.coffee_id}`);
                        if (quantityDisplay) {
                            quantityDisplay.textContent = item.quantity;
                        }
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error initializing cart quantities:', error);
    }
}

// Call the initialization function when page loads
document.addEventListener('DOMContentLoaded', initializeCartQuantities);

function showQuantityControls(itemId) {
    document.querySelector(`.addtoCart${itemId}`).style.display = 'none';
    document.querySelector(`.quantity-controls${itemId}`).style.display = 'flex';
    if (!quantities[itemId]) {
        quantities[itemId] = 1;
    }
}

function updateQuantityDisplay(itemId) {
    document.getElementById(`quantity${itemId}`).textContent = quantities[itemId];
}

function increaseQuantity(itemId, title, price) {
    quantities[itemId] = (quantities[itemId] || 1) + 1;
    updateQuantityDisplay(itemId);

    fetch(`/add-coffee-cart/${itemId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            throw new Error(data.error || 'خطا در بروزرسانی سبد خرید');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('خطا در بروزرسانی سبد خرید');
    });
}

function decreaseQuantity(itemId, title, price) {
    // First find the cart item by coffee ID
    fetch(`/get-coffee-cart-items`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.items) {
            // Find the cart item that matches this coffee
            const cartItem = data.items.find(item => item.coffee_id == itemId);
            if (cartItem) {
                // Update UI
                if (quantities[itemId] > 1) {
                    quantities[itemId]--;
                    updateQuantityDisplay(itemId);
                } else {
                    quantities[itemId] = 0;
                    document.querySelector(`.quantity-controls${itemId}`).style.display = 'none';
                    document.querySelector(`.addtoCart${itemId}`).style.display = 'block';
                }

                // Now remove from cart using cart item ID
                return fetch(`/remove-coffee-cart/${itemId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    credentials: 'same-origin'
                });
            }
        }
        throw new Error('Item not found in cart');
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            // Revert UI changes if server request fails
            if (quantities[itemId] === 0) {
                quantities[itemId] = 1;
                document.querySelector(`.quantity-controls${itemId}`).style.display = 'flex';
                document.querySelector(`.addtoCart${itemId}`).style.display = 'none';
                updateQuantityDisplay(itemId);
            } else {
                quantities[itemId]++;
                updateQuantityDisplay(itemId);
            }
            throw new Error(data.error || 'خطا در حذف از سبد خرید');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('خطا در حذف از سبد خرید');
    });
}

function addToCartHandler(itemId) {
    @auth
        fetch(`/add-coffee-cart/${itemId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.json();
            }
        })
        .then(data => {
            if(data && data.success) {
                showQuantityControls(itemId);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('خطا در افزودن به سبد خرید');
        });
    @else
        window.location.href = '{{ route('login') }}';
    @endauth
}
</script>
