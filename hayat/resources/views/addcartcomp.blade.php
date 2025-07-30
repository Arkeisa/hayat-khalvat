@if (Route::has('login'))
    @auth
        <a href="{{ route('addcart') }}" class="btn btn-primary ml-xl-4">سبد خرید</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary ml-xl-4">سبد خرید</a>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">ورود</a>
        </li>
    @endauth
@endif

<div class=" min-h-screen">
    <div class="container mx-auto px-4 py-8 mt-20">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">سبد خرید شما</h2>

        @if(isset($data) && count($data) > 0)
            <div class=" rounded-lg shadow-lg p-6 mb-8 bg-gray-50">
                <!-- Cart Items -->
                <div class="space-y-4">
                    @foreach($data as $item)
                        <div class="flex flex-wrap items-center justify-center sm:justify-between border-b border-gray-200 py-4" data-cart-item="{{ $item->id }}">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                @if(str_contains($item->image, 'food_img/'))
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-24 h-24 object-cover rounded-lg">
                                @else
                                    <img src="{{ asset('food_img/' . $item->image) }}" alt="{{ $item->title }}" class="w-24 h-24 object-cover rounded-lg">
                                @endif
                                <div class="flex flex-col">
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $item->title }}</h3>
                                    <p class="text-gray-600">تعداد: {{ $item->quantity }}</p>
                                    <p class="text-gray-600">قیمت: {{ number_format($item->price) }} تومان</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <p class="text-lg font-semibold text-gray-900">
                                    جمع: {{ number_format($item->price * $item->quantity) }} تومان
                                </p>
                                <a href="javascript:void(0)"
                                   onclick="removeFromCart('{{ $item->id }}')"
                                   class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300">
                                    حذف
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                 <!-- Cart Summary -->
                <form action="{{ route('confirm.order') }}" method="POST" class="mt-8 border-t border-gray-200 pt-8">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-lg font-medium text-gray-700">نام</label>
                            <input type="text" name="name" value="{{ Auth::user()->name . ' ' . Auth::user()->lastname }}" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100">
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-700">ایمیل</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100">
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-700">تلفن</label>
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100">
                            <p class="text-yellow-600 text-sm mt-1">لطفا از شماره تلفن خود اطمینان حاصل کنید ( اگر شماره وارد شده اشتباه است شماره صحیح را در آخر قسمت آدرس وارد کنید )</p>
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-700">آدرس<span class="text-red-500">*</span></label>
                            <textarea name="address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="لطفا آدرس خود را وارد کنید"></textarea>
                            @error('address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <h3 class="text-xl font-semibold text-gray-900">جمع کل</h3>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ number_format($data->sum(function($item) { return $item->price * $item->quantity; })) }} تومان
                        </p>
                    </div>
                    <div class="flex justify-center w-full">
                        <button type="submit" class="mt-6 w-full text-2xl flex justify-center max-w-md bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                            تکمیل خرید
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow-lg">
                <p class="text-xl text-gray-600">سبد خرید شما خالی است</p>
                <a href="/menu" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    مشاهده منو
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function removeFromCart(cartItemId) {
    fetch(`/remove-cart/${cartItemId}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        const itemElement = document.querySelector(`[data-cart-item="${cartItemId}"]`);
        if (itemElement) {
            // Find elements within the flex-col div
            const quantityElement = itemElement.querySelector('.flex-col p:first-of-type');
            const priceElement = itemElement.querySelector('.flex-col p:last-of-type');
            const totalElement = itemElement.querySelector('.text-lg.font-semibold');

            // Get current quantity from the element
            const currentQuantity = parseInt(quantityElement.textContent.replace(/[^\d]/g, ''));

            if (currentQuantity <= 1 || !data.success) {
                // If it's the last item or there's an error, just reload the page
                window.location.reload();
                return;
            }

            // Update quantity
            if (quantityElement) {
                quantityElement.textContent = `تعداد: ${data.quantity}`;
            }

            // Update item total price
            if (priceElement && totalElement) {
                const price = parseInt(priceElement.textContent.replace(/[^\d]/g, ''));
                const newTotal = price * data.quantity;
                totalElement.textContent = `جمع: ${number_format(newTotal)} تومان`;
            }

            // Update cart total
            updateCartTotal();
        }
    })
    .catch(error => {
        // On any error, just reload the page
        window.location.reload();
    });
}

// Helper function to format numbers consistently
function number_format(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Function to update total price
function updateCartTotal() {
    const cartItems = document.querySelectorAll('[data-cart-item]');
    let total = 0;

    cartItems.forEach(item => {
        const totalElement = item.querySelector('.text-lg.font-semibold');
        if (totalElement) {
            const itemTotal = parseInt(totalElement.textContent.replace(/[^\d]/g, ''));
            if (!isNaN(itemTotal)) {
                total += itemTotal;
            }
        }
    });

    const cartTotalElement = document.querySelector('.text-2xl.font-bold');
    if (cartTotalElement) {
        cartTotalElement.textContent = `${number_format(total)} تومان`;
    }
}
</script>
