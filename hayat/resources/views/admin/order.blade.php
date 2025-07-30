<div id="orders-section" class="content-section hidden">
    <h2 class="text-3xl text-center mb-8">سفارشات</h2>
    <div class="overflow-x-auto">
        <div class="container mx-auto px-4">
            <!-- Search Input -->
            <div class="mb-6">
                <input
                    type="text"
                    id="orderSearchInput"
                    class="input input-bordered w-full max-w-xs text-lg"
                    placeholder="جستجو..."
                    oninput="filterOrders()"
                />
            </div>

            <!-- Orders Grid -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                @php
                    if(Auth::user()->role === 'admin') {
                        $orders = DB::table('orders')
                            ->select('*',
                                DB::raw('ROW_NUMBER() OVER (PARTITION BY DATE(created_at) ORDER BY created_at) as daily_order_number'),
                                DB::raw('DATE(created_at) as order_date'),
                                DB::raw("CASE
                                    WHEN EXISTS (SELECT 1 FROM c_o_f_e_s WHERE c_o_f_e_s.title = orders.title)
                                    THEN 'c_o_f_e_s'
                                    ELSE 'foods'
                                END as from_table"))
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->groupBy(function($item) {
                                return $item->created_at . '_' . $item->email;
                            });
                    } else {
                        $orders = DB::table('orders')
                            ->select('*',
                                DB::raw('ROW_NUMBER() OVER (PARTITION BY DATE(created_at) ORDER BY created_at) as daily_order_number'),
                                DB::raw('DATE(created_at) as order_date'),
                                DB::raw("CASE
                                    WHEN EXISTS (SELECT 1 FROM c_o_f_e_s WHERE c_o_f_e_s.title = orders.title)
                                    THEN 'c_o_f_e_s'
                                    ELSE 'foods'
                                END as from_table"))
                            ->where('email', Auth::user()->email)
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->groupBy(function($item) {
                                return $item->created_at;
                            });
                    }
                @endphp

                @forelse ($orders as $group_key => $items)
                    <div class="order-card bg-white rounded-lg shadow-lg p-6">
                        <!-- Order Header -->
                        <div class="mb-4 border-b pb-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-2xl font-semibold">
                                        سفارش #{{ $items[0]->daily_order_number }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        سفارش {{ $items[0]->daily_order_number }} ام روز
                                        <span class="order-date" data-timestamp="{{ $items[0]->created_at }}"></span>
                                    </p>
                                </div>
                                <div class="text-gray-600 text-lg">
                                    <span class="order-time" data-timestamp="{{ $items[0]->created_at }}"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="space-y-4 mb-4">
                            @foreach($items as $item)
                            <div class="flex items-center justify-between border-b pb-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset($item->image) }}"
                                         alt="{{ $item->title }}"
                                         class="w-20 h-20 object-cover rounded"
                                         onerror="console.log('Failed to load image:', this.src)">
                                    <div>
                                        <h4 class="text-xl font-semibold">{{ $item->title }}</h4>
                                        <p class="text-lg">تعداد: {{ $item->quantity }}</p>
                                        <p class="text-lg">قیمت: {{ number_format($item->price) }} تومان</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Order Details -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-xl">
                                @if(Auth::user()->role === 'admin')
                                    <p><span class="font-semibold">مشتری:</span> {{ $items[0]->name }}</p>
                                    <p><span class="font-semibold">ایمیل:</span> {{ $items[0]->email }}</p>
                                    <p><span class="font-semibold">تلفن:</span> {{ $items[0]->phone }}</p>
                                @endif
                                <p><span class="font-semibold">مجموع:</span>
                                    {{ number_format($items->sum('price')) }} تومان
                                </p>
                            </div>
                            <div class="text-xl">
                                <p><span class="font-semibold">وضعیت:</span>
                                    <span class="@if($items[0]->status == 'pending') text-yellow-600
                                               @elseif($items[0]->status == 'preparing') text-blue-600
                                               @elseif($items[0]->status == 'delivering') text-green-600
                                               @else text-red-600 @endif">
                                        @switch($items[0]->status)
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
                                </p>
                                <p><span class="font-semibold">آدرس:</span> {{ $items[0]->address }}</p>
                            </div>
                        </div>

                        @if(Auth::user()->role === 'admin')
                            <div class="flex gap-2 mt-4">
                                <a onclick="return confirm('آیا از تغییر وضعیت سفارش مطمئن هستید؟')"
                                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-center flex-1"
                                   href="{{ url('dash/on_the_way', $items[0]->id) }}">
                                   در حال آماده سازی
                                </a>
                                <a onclick="return confirm('آیا از تغییر وضعیت سفارش مطمئن هستید؟')"
                                   class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-center flex-1"
                                   href="{{ url('dash/delivered', $items[0]->id) }}">
                                   در حال ارسال
                                </a>
                                <a onclick="return confirm('آیا از کنسل کردن سفارش مطمئن هستید؟')"
                                   class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-center flex-1"
                                   href="{{ url('dash/canceled', $items[0]->id) }}">
                                   کنسل کردن
                                </a>
                                <a onclick="return confirm('آیا از حذف این سفارش مطمئن هستید؟')"
                                   class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 text-center flex-1"
                                   href="{{ url('dash/delete-order', $items[0]->id) }}">
                                   حذف سفارش
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-500 text-xl">
                        هیچ سفارشی یافت نشد
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
function filterOrders() {
    const input = document.getElementById('orderSearchInput');
    const filter = input.value.toLowerCase();
    const cards = document.getElementsByClassName('order-card');

    Array.from(cards).forEach(card => {
        let found = false;
        
        // Search in specific elements within the card
        const searchableElements = [
            ...card.getElementsByClassName('text-xl'),  // For name, email, phone, etc.
            ...card.getElementsByTagName('h4'),        // For item titles
            ...card.getElementsByClassName('order-date')  // For dates
        ];
        
        for (let element of searchableElements) {
            if (element.textContent.toLowerCase().includes(filter)) {
                found = true;
                break;
            }
        }
        
        card.style.display = found ? '' : 'none';
    });
}

// Format dates and times
document.addEventListener('DOMContentLoaded', function() {
    // Format all dates
    document.querySelectorAll('.order-date').forEach(element => {
        const timestamp = element.getAttribute('data-timestamp');
        const date = new Date(timestamp);
        element.textContent = new Intl.DateTimeFormat('fa-IR', {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            timeZone: 'Asia/Tehran'
        }).format(date);
    });

    // Format all times
    document.querySelectorAll('.order-time').forEach(element => {
        const timestamp = element.getAttribute('data-timestamp');
        const date = new Date(timestamp);
        element.textContent = new Intl.DateTimeFormat('fa-IR', {
            hour: 'numeric',
            minute: 'numeric',
            hour12: false,
            timeZone: 'Asia/Tehran'
        }).format(date);
    });
});
</script>

