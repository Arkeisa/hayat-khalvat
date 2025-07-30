<!DOCTYPE html>
<html lang="en">
<head>
<style>
    /* Firefox */
* {
  scrollbar-width: thin;
}

</style>
<style>
.pulse {
  position: relative;
  animation-name: example;
  animation-duration: 1s;
}

@keyframes example {
  0%   { left:0px; top:0px;}
  25%  { left:0px; top:0px;}
  50%  { left:0px; top:0px;}
  75%  { left:0px; top:0px;}
  100% {left:0px; top:0px;}
}
</style>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Favicon for all browsers (Works for Chrome, Firefox, etc.) -->
     <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

     <!-- Favicon for Android (Chrome, Firefox, etc.) -->
     <link rel="icon" sizes="192x192" href="{{ asset('android-chrome-192x192.png') }}">
 
     <!-- Apple Touch Icon (iOS Devices) -->
     <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
 
     <!-- Safari Pinned Tab Icon (Optional, for Safari on iOS/macOS) -->
     <link rel="mask-icon" href="{{ asset('favicon-32x32.png') }}" color="#5bbad5">
 
     <!-- Meta tags for Android / Chrome / Windows Phone -->
     <meta name="theme-color" content="#a5c7f8"> <!-- Adjust color to match your brand -->
 
     <!-- Additional metadata (optional) -->
     <meta name="description" content="Your website description">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ mix('css/app.css') }}"  rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"  defer></script>
    <title>@yield('title', 'کافه حیات خلوت')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="w-auto min-h-screen flex flex-col " dir="rtl">

  <div class="z-50 absolute inset-0 flex items-center justify-center bg-white" id="animatedDiv">
    <img class="pulse w-28 h-auto" src="/images/logo-min.png" alt="Logo">
  </div>
  <div class="text-black z-50 font-mono font-bold fixed left-0 m-4"  id="datetime" dir="rtl"></div>
  @yield('content')


    @yield('scripts')

    <script>
      const animatedElement = document.getElementById('animatedDiv');

      animatedElement.addEventListener('animationend', () => {
        // Hide the element after the animation ends
        animatedElement.style.display = 'none';
      });
    </script>
    <!-- time -->
<script>
 function updateDateTime() {
  var currentDate = new Date();
  
  // Persian options for date and time formatting
  var persianOptions = {
    calendar: 'persian',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
    second: 'numeric',
    hour12: false  // Set to false to use 24-hour format
  };

  // Get the formatted date in Persian
  var formattedDate = currentDate.toLocaleDateString('fa-IR', persianOptions);

  // Split the formatted string into separate components
  var dateTimeParts = formattedDate.split(' ساعت');

  // Ensure that 'dateTimeParts' contains both the date and time
  if (dateTimeParts.length === 2) {
    var date = dateTimeParts[0].trim();
    var time = dateTimeParts[1].trim();

    // Re-arrange the components as needed. For example, putting time first.
    var rearrangedFormattedDate = `${time} - ${date}`;

    document.getElementById('datetime').textContent = rearrangedFormattedDate;
  } else {
    document.getElementById('datetime').textContent = formattedDate; // Fallback
  }
}

// Update the date and time every second
setInterval(updateDateTime, 1000);

// Initial update
updateDateTime();





const quantities = {};

// Add this function to initialize quantities from cart
async function initializeCartQuantities() {
    try {
        const response = await fetch('/get-cart-items', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });
        
        if (!response.ok) {
            throw new Error('Failed to fetch cart items');
        }
        
        const data = await response.json();
        if (data.items) {
            data.items.forEach(item => {
                const foodId = item.food_id;
                if (foodId) {
                    quantities[foodId] = item.quantity;
                    // Show quantity controls for items in cart
                    const addToCartBtn = document.querySelector(`.addtoCart${foodId}`);
                    const quantityControls = document.querySelector(`.quantity-controls${foodId}`);
                    if (addToCartBtn && quantityControls) {
                        addToCartBtn.style.display = 'none';
                        quantityControls.style.display = 'flex';
                        const quantityDisplay = document.getElementById(`quantity${foodId}`);
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
    
    fetch(`/add-cart/${itemId}`, {
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
        // Optionally refresh the cart display
        if (typeof updateCartDisplay === 'function') {
            updateCartDisplay();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'خطا در بروزرسانی سبد خرید');
    });
}

function decreaseQuantity(itemId, title, price) {
    // First find the cart item by food ID
    fetch(`/get-cart-items`, {
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
            // Find the cart item that matches this food
            const cartItem = data.items.find(item => item.food_id == itemId);
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
                return fetch(`/remove-cart/${cartItem.id}`, {
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
        fetch(`/add-cart/${itemId}`, {
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

</body>
</html>
