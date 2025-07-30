@php
    // Fetch food items from the database based on categories
    $categories = ['صبحانه', 'بارگرم', 'غذا', 'شیک و گلاسه'];
    $ourBests = [];

    foreach ($categories as $category) {
        $item = DB::table('food')->where('category', $category)->first();
        if ($item) {
            $ourBests[] = [
                'id' => $item->id,
                'title' => $item->title,
                'price' => $item->price,
                'details' => $item->details,
                'image' => $item->image,
            ];
        }
    }
@endphp

<div class="container mx-auto mt-8 DIR-rtl px-3 text-2xl">
    <div class="w-fit px-7 py-3 bg-gradient-to-b bg-blue-600 bg-opacity-30 rounded-3xl opacity-90 my-12 text-center mx-auto flex gap-2 items-center">
        <h2 class="lg:text-4xl xxl:text-5xl md:text-3xl text-2xl mx-auto font-bold">
            منو
        </h2>
    </div>

    <div class="grid grid-cols-1 px-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
        @foreach ($ourBests as $item)
            <div class="flex flex-col items-center justify-center w-full max-w-sm mx-auto hover:scale-105 transition-all duration-300">
                <div class="w-full h-64 bg-center bg-cover rounded-lg shadow-md" style="background-image: url(/food_img/{{ $item['image'] }})"></div>
                <div class="indicator">
                    <span class="indicator-item badge badge-secondary hidden {{ $item['id'] }}indicator"></span>
                    <div class="w-56 -mt-10 overflow-hidden bg-base-100 text-base-content rounded-lg shadow-lg md:w-64 flex flex-col h-40">
                        <h3 class="py-2 font-bold tracking-wide text-center uppercase">{{ $item['title'] }}</h3>

                        <p class="text-xl px-4 flex-grow overflow-hidden text-ellipsis line-clamp-2">{{ $item['details'] }}</p>

                        
                            <div class="mb-2 self-center">
                                <span class="font-bold text-gray-800">{{ number_format($item['price']) }} تومان</span>
                            </div>
                     
                
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center mt-2 my-0 md:my-16 p-2" dir="ltr">
        <a href="/menu" class="text-3xl gap-3 btn rounded-full bg-white shadow-md border border-blue-600 orderMenuBtn-special">
             سفارش از منو
        </a>
    </div>
</div>
