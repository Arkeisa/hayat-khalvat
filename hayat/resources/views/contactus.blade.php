@php
    $mapcontact = '<iframe
        src="https://maps.google.com/maps?q=36.5450815,52.6715288&t=&z=17&ie=UTF8&iwloc=&output=embed"
        class="absolute right-0 top-0 h-full w-full rounded-lg"
        frameborder="0"
        allowfullscreen>
    </iframe>';
@endphp

<!-- Divider -->
<div class="divider"></div>

<!-- Header Section -->
<div class="w-fit px-7 py-3 bg-blue-600 bg-opacity-30 rounded-3xl opacity-90 my-12 text-center mx-auto flex gap-2 items-center mt-20">
    <h2 class="lg:text-4xl xxl:text-5xl md:text-3xl text-2xl mx-auto font-bold">
        درباره کافه حیات
    </h2>
</div>

<!-- Section: Design Block -->
<div class="container mx-auto xl:px-32">

    <div class="grid items-center lg:grid-cols-2 gap-12">
        <!-- Map Section (For Screens) -->
        <div class="md:mb-12 lg:mb-0 print:hidden">
            <div class="relative h-[700px] rounded-lg shadow-lg">
                {!! $mapcontact !!}
            </div>
        </div>

        <!-- Map Section (For Print) -->
        <div class="hidden print:block">
            <div class="relative h-[45vh] w-screen rounded-lg shadow-lg">
                {!! $mapcontact !!}
            </div>
        </div>

        <!-- Description Section -->
        <div class="mb-12 lg:mt-0 print:hidden">
            <div class="relative z-[1] block rounded-lg bg-base-300 bg-opacity-80 px-6 py-12 backdrop-blur-[30px] md:px-12 lg:-mr-14">
                <h2 class="mb-12 text-3xl font-bold text-base-content">درباره کافه حیات</h2>
                <div dir="rtl" class="font-medium text-justify text-2xl">
                    <p class="mb-8">
                        کافه "حیات خلوت" جایی است برای کسانی که در دنیای پرهیاهو به دنبال لحظاتی از آرامش و سکون هستند. فضایی دنج و صمیمی که هر گوشه‌اش دعوت به آرامش می‌کند. در اینجا، شما نه تنها یک فنجان قهوه می‌نوشید، بلکه تجربه‌ای از آرامش و دلگرمی را به دست می‌آورید. هر نوشیدنی با دقت و عشق تهیه می‌شود و هر لحظه در "حیات خلوت" به نوعی فرصتی است برای بازتعریف لذت‌های ساده زندگی. ترکیب محیطی دلپذیر با طعم‌های خاص و دلنشین، این کافه را به مکانی تبدیل کرده که پس از هر بازدید، با حس خوب و آرامش از آن بیرون می‌آیید. اینجا، به هیچ چیز جز خودتان فکر نخواهید کرد. "حیات خلوت" یک پناهگاه کوچک است که همه‌چیز برای لحظاتی از تنهایی مطلق یا هم‌نشینی با دوستان در آن مهیاست.
                    </p>

                    <!-- Address Section -->
                    <div class="relative z-0 w-full mb-8 group text-right p-2 rounded">
                        <div class="text-center">
                            <p class="pt-10 text-3xl font-bold">آدرس</p>
                            <a
                                href="https://www.google.com/maps/place/Coffee+Hayat+Khalvat/@36.5450815,52.6715288,20z/data=!4m6!3m5!1s0x3f8f89194fd3a711:0xcd7523601e94c0ad!8m2!3d36.54513!4d52.6714956!16s%2Fg%2F11tsn2pnmw?entry=ttu"
                                target="_blank"
                                class="inline-flex items-center mt-6 hover:text-blue-600">
                                <p class="text-3xl">
                                    بابل - بلوار جانبازان - بعد از چهار راه گله محله - بین بهاران 21 و 23 - طبقه اول مجموعه پورجواد - کافه حیات خلوت
                                </p>
                            </a>
                        </div>

                    </div>

                    <!-- Contact Section -->
                    <div class="relative z-0 w-full group text-right p-2 rounded">
                        <div class="flex flex-col justify-center items-center text-center">
                            <p class="text-4xl font-bold mb-2">تلفن</p>
                            <a href="tel:09373729154" class="text-3xl text-blue-600 hover:underline">
                                09373729154
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4 mt-5">
                        <a href="https://t.me/your-telegram" target="_blank" class="text-gray-800 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 hover" viewBox="0 0 32 32" width="128px" height="128px">
                                <path fill="#ffe6e2" d="m26 32h-20c-3.314 0-6-2.686-6-6v-20c0-3.314 2.686-6 6-6h20c3.314 0 6 2.686 6 6v20c0 3.314-2.686 6-6 6z"/>
                                <path fill="#fd907e" d="m13.833 19.575v3.092c0 .216.139.408.344.475.051.017.104.025.156.025.156 0 .307-.074.403-.204l1.808-2.462z"/>
                                <path fill="#fc573b" d="m23.79 7.926c-.153-.109-.355-.123-.521-.036l-15 7.833c-.177.092-.282.282-.267.481.015.2.148.37.337.436l4.17 1.425 8.88-7.593-6.872 8.279 6.988 2.388c.053.018.107.027.162.027.091 0 .181-.025.26-.073.127-.077.213-.207.234-.354l1.833-12.333c.028-.185-.051-.371-.204-.48z"/>
                            </svg>
                          </a>
                          <a href="https://instagram.com/your-instagram" target="_blank" class="text-gray-800 hover:text-pink-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-11 h-11 hover" viewBox="0 0 128 128" width="128px" height="128px">
                                <path fill="#ff697b" d="M86.2,109H41.8C32,109,24,101,24,91.2V46.8C24,37,32,29,41.8,29h44.4C96,29,104,37,104,46.8v44.4C104,101,96,109,86.2,109z"/><path fill="#fff" d="M24,46.8V58h80V46.8C104,37,96,29,86.2,29H41.8C32,29,24,37,24,46.8z"/>
                                <path fill="#444b54" d="M86.2,112H41.8C30.3,112,21,102.7,21,91.2V46.8C21,35.3,30.3,26,41.8,26h44.4c11.5,0,20.8,9.3,20.8,20.8v44.4C107,102.7,97.7,112,86.2,112z M41.8,32C33.6,32,27,38.6,27,46.8v44.4c0,8.1,6.6,14.8,14.8,14.8h44.4c8.1,0,14.8-6.6,14.8-14.8V46.8c0-8.1-6.6-14.8-14.8-14.8H41.8z"/>
                                <path fill="#fff" d="M64 54A15 15 0 1 0 64 84A15 15 0 1 0 64 54Z"/><path fill="#444b54" d="M64,87c-9.9,0-18-8.1-18-18c0-1.7,1.3-3,3-3s3,1.3,3,3c0,6.6,5.4,12,12,12s12-5.4,12-12s-5.4-12-12-12c-1.7,0-3-1.3-3-3s1.3-3,3-3c9.9,0,18,8.1,18,18S73.9,87,64,87z"/>
                                <path fill="#444b54" d="M53.8 60.9c-.2 0-.4 0-.6-.1s-.4-.1-.6-.2c-.2-.1-.4-.2-.5-.3-.2-.1-.3-.2-.5-.4-.1-.1-.3-.3-.4-.5-.1-.2-.2-.3-.3-.5-.1-.2-.1-.4-.2-.6 0-.2-.1-.4-.1-.6 0-.2 0-.4.1-.6 0-.2.1-.4.2-.6.1-.2.2-.4.3-.5.1-.2.2-.3.4-.5.1-.1.3-.3.5-.4.2-.1.3-.2.5-.3.2-.1.4-.1.6-.2.4-.1.8-.1 1.2 0 .2 0 .4.1.6.2.2.1.4.2.5.3.2.1.3.2.4.4.1.1.3.3.4.5.1.2.2.3.3.5.1.2.1.4.2.6 0 .2.1.4.1.6 0 .2 0 .4-.1.6 0 .2-.1.4-.2.6-.1.2-.2.4-.3.5-.1.2-.2.3-.4.5-.1.1-.3.3-.4.4-.2.1-.3.2-.5.3-.2.1-.4.1-.6.2S54 60.9 53.8 60.9zM86 43A4 4 0 1 0 86 51 4 4 0 1 0 86 43zM19 112.3c-1.6 0-3-1.3-3-3 0-1.7 1.3-3 3-3l90-.5c0 0 0 0 0 0 1.6 0 3 1.3 3 3 0 1.7-1.3 3-3 3L19 112.3C19 112.3 19 112.3 19 112.3zM124 111.8c-.8 0-1.6-.3-2.1-.9-.1-.1-.3-.3-.4-.5-.1-.2-.2-.3-.3-.5-.1-.2-.1-.4-.2-.6 0-.2-.1-.4-.1-.6 0-.2 0-.4.1-.6 0-.2.1-.4.2-.6.1-.2.2-.4.3-.5.1-.2.2-.3.4-.5.1-.1.3-.3.4-.4.2-.1.3-.2.5-.3.2-.1.4-.1.6-.2.4-.1.8-.1 1.2 0 .2 0 .4.1.6.2.2.1.4.2.5.3.2.1.3.2.4.4.6.6.9 1.3.9 2.1 0 .2 0 .4-.1.6 0 .2-.1.4-.2.6-.1.2-.2.4-.3.5-.1.2-.2.3-.4.5C125.6 111.5 124.8 111.8 124 111.8z"/>
                            </svg>
                          </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Section: Design Block -->
