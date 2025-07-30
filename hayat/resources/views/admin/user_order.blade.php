<div id="user-order" class="content-section hidden m-4 bg-white">
    <h2 class="text-3xl text-center font-bold mb-8">سفارش های شما</h2>
    <div class="container mx-auto mt-8 px-4">
        <div class="mt-4 space-y-4">
            @php
                $userOrders = DB::table('orders')
                    ->where('email', Auth::user()->email)
                    ->orderBy('created_at', 'desc')
                    ->get();
            @endphp

            @if($userOrders->count() > 0)
                @foreach($userOrders as $order)
                    <div style="direction: rtl" class="border-2 border-gray-200 rounded-lg shadow-lg p-6 bg-white hover:shadow-xl transition-all duration-300">
                        <div class="grid md:flex items-center md:justify-between mb-4 justify-center">
                            <h2 class="text-2xl font-semibold text-center">{{ $order->title }}</h2>
                            @if(str_contains($order->image, 'food_img/'))
                                <img src="{{ asset($order->image) }}" alt="" class="w-40 h-40 object-cover rounded">
                            @else
                                <img src="{{ asset('food_img/' . $order->image) }}" alt="" class="w-40 h-40 object-cover rounded">
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="mb-2 text-2xl">
                                    <span class="font-semibold">تعداد:</span> {{ $order->quantity }}
                                </div>
                                <div class="mb-2 text-2xl">
                                    <span class="font-semibold">قیمت:</span> {{ number_format($order->price) }} تومان
                                </div>
                                <div class="mb-2 text-2xl">
                                    <span class="font-semibold">آدرس تحویل:</span> {{ $order->address }}
                                </div>
                                <div class="mb-2 text-2xl">
                                    <span class="font-semibold">تاریخ سفارش:</span>
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('Y/m/d H:i') }}
                                </div>
                            </div>

                            <div>
                                <div class="mb-2 text-2xl">
                                    <span class="font-semibold">وضعیت سفارش:</span>
                                    <span class="@if($order->status == 'pending') text-yellow-600
                                               @elseif($order->status == 'preparing') text-blue-600
                                               @elseif($order->status == 'delivering') text-green-600
                                               @else text-red-600 @endif">
                                        @switch($order->status)
                                            @case('pending')
                                                در انتظار تایید
                                                @break
                                            @case('preparing')
                                                در حال آماده سازی
                                                @break
                                            @case('delivering')
                                                در حال ارسال
                                                @break
                                            @case('canceled')
                                                کنسل شده
                                                @break
                                        @endswitch
                                    </span>
                                </div>

                                @php
                                    $orderTime = \Carbon\Carbon::parse($order->created_at);
                                    $canCancel = $orderTime->diffInHours(now()) <= 1 && $order->status == 'pending';
                                @endphp

                                <button onclick="cancelOrder('{{ $order->id }}', {{ $canCancel }})"
                                        class="btn w-full mt-4 {{ $canCancel ? 'btn-error' : 'btn-disabled' }}">
                                    کنسل کردن سفارش
                                </button>

                                @if(!$canCancel)
                                    <p class="text-red-500 text-sm mt-2 text-center">
                                        لطفا برای کنسل یا شخصی سازی سفارشاتتون با کافه تماس بگیرید
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12 bg-white rounded-lg shadow-lg">
                    <p class="text-xl text-gray-600">شما هنوز سفارشی ثبت نکرده‌اید</p>
                    <a href="/menu" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                        مشاهده منو
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
function cancelOrder(orderId, canCancel) {
    if (typeof window.Swal === 'undefined') {
        alert('لطفا برای کنسل یا شخصی سازی سفارشاتتون با کافه تماس بگیرید');
        return;
    }

    window.Swal.fire({
        title: 'توجه!',
        html: `
            <p>لطفا برای کنسل یا شخصی سازی سفارشاتتون با کافه تماس بگیرید</p>
            <a href="tel:09373729154" class="inline-block mt-4 text-blue-600 hover:text-blue-800 text-lg font-bold">
                ۰۹۳۷۳۷۲۹۱۵۴
            </a>
        `,
        icon: 'info',
        confirmButtonText: 'متوجه شدم',
        customClass: {
            popup: 'swal-rtl',
            title: 'text-xl font-bold mb-4',
            confirmButton: 'bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'
        },
        background: '#fff',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
}
</script>

<style>
.swal-rtl {
    direction: rtl;
    font-family: your-persian-font, Arial, sans-serif;
}
</style>

