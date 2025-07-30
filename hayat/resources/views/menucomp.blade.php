<div class="container mx-auto mt-36 DIR-rtl px-3 text-2xl">
    @foreach ($groupedItems as $category => $items)
        <div class="w-fit px-7 py-3 bg-gradient-to-b bg-blue-600 bg-opacity-30 rounded-3xl opacity-90 my-12 text-center mx-auto flex gap-2 items-center">
            <h2 class="lg:text-4xl xxl:text-5xl md:text-3xl text-2xl mx-auto font-bold">
                {{ $category }}
            </h2>
        </div>

        <div class="grid grid-cols-1 px-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @foreach ($items as $item)
                <div class="flex flex-col items-center justify-center w-full max-w-sm mx-auto hover:scale-105 transition-all duration-300">
                    <div class="w-full h-64 bg-center bg-cover rounded-lg shadow-md" style="background-image: url({{ asset('food_img/' . $item->image) }})"></div>
                    <div class="indicator">
                        <span class="indicator-item badge badge-secondary hidden {{ $item->id }}indicator"></span>
                        <div class="w-56 -mt-10 overflow-hidden bg-base-100 text-base-content rounded-lg shadow-lg md:w-64 flex flex-col h-40">
                            <h3 class="py-2 font-bold tracking-wide text-center uppercase text-3xl">{{ $item->title }}</h3>

                            <p class="text-xl font-bold px-4 flex-grow overflow-hidden text-ellipsis line-clamp-2">{{ $item->details }}</p>

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
                                    <button onclick="addToCartHandler('{{ $item->id }}')" class="btn btn-outline btn-accent btn-sm addtoCart{{ $item->id }}">افزودن به سبد خرید</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>




