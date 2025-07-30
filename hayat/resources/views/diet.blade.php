<style>
    .fadeInUp {
    -webkit-animation-name: fadeInUp;
    animation-name: fadeInUp;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    }
    @-webkit-keyframes fadeInUp {
    0% {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
    }
    100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
    }
    }
    @keyframes fadeInUp {
    0% {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);
    }
    100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
    }
    }
    </style>

<div class="flex flex-wrap md:flex-nowrap mt-20">

    <div class="flex w-full h-auto justify-center md:order-1 order-2 text-justify" dir="rtl">
        <div class="flex flex-col my-8 md:my-auto gap-4 pt-11">
            <h2 class="mx-auto text-3xl font-bold text-gray-600"> رژیم غذایی سالم: کلید تغییر زندگی شما</h2>
<p class="pb-5 px-4 text-gray-500 text-xl max-w-3xl text-justify">آیا به دنبال روشی مطمئن برای بهبود سلامت، افزایش انرژی و رسیدن به وزن ایده‌آل خود هستید؟ با یک رژیم غذایی سالم و علمی می‌توانید همه این اهداف را محقق کنید!<br>
    این رژیم نه‌تنها شامل غذاهای طبیعی و خوشمزه‌ای است که بدن شما را تقویت می‌کند، بلکه به شما کمک می‌کند از مشکلاتی مانند خستگی مداوم، مشکلات گوارشی و اضافه‌وزن خلاص شوید.<br>
    فقط تصور کنید با تغییر سبک تغذیه‌تان چقدر می‌توانید احساس شادابی و نشاط بیشتری داشته باشید. دیگر نیازی نیست زمان خود را برای جستجوی روش‌های نامطمئن هدر دهید؛ ما اینجا هستیم تا با برنامه‌ای کاملاً شخصی‌سازی‌شده، شما را در مسیر رسیدن به بهترین نسخه از خودتان همراهی کنیم.
    همین حالا قدم اول را بردارید!<br>
     فرم درخواست مشاوره را پر کنید و اولین گام را به سوی تغییر زندگی خود بردارید. فرصت را از دست ندهید، سلامتی شما ارزشمندتر از هر چیزی است.
    ..</p>
        </div>
    </div>

    <div class="flex w-full h-auto justify-center md:order-2 order-1 from-green-400/60 bg-gradient-to-r gap-10 md:w-1/2 items-end"> <!-- Added items-end to align to the bottom -->
        <img src="/images/avokado.png" class="max-h-96 h-96 object-contain" alt=""> <!-- object-contain ensures responsiveness -->
    </div>

 </div>

 <div class="flex">
    <div class="from-green-400/60  bg-gradient-to-r w-1/2 h-1">
    </div>
    <div class="from-green-400/60 bg-gradient-to-l w-1/2 h-1">
    </div>
 </div>



 @php
 $categories = [['']]
@endphp



 <div class="container mx-auto mt-36 px-4">
    @if(session('success'))
        <div class="alert alert-success shadow-lg mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
                <span>{{ session('success') }}</span>
            </div>
      </div>
    @endif

 <div class="w-fit px-7 py-3 bg-blue-600 bg-opacity-30 rounded-3xl opacity-90 my-12 text-center mx-auto flex gap-2 items-center">
    <h2 class="lg:text-4xl xxl:text-5xl md:text-3xl text-2xl mx-auto font-bold">
        رزرو وقت مشاوره
    </h2>
</div>

<div class="grid grid-cols-1 w-full mx-auto place-items-center md:grid-cols-2">
    @auth
    <div class="">
        <form action="{{ route('consultation.store') }}" method="POST" class="min-w-96 w-full mx-auto justify-items-center mt-14 border p-8 rounded-xl shadow-lg">
            @csrf
    <p class="text-3xl font-bold my-4">فرم مشاوره</p>
    <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="name" id="floating_text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600/50 peer" placeholder=" " required />
        <label for="floating_text" class="peer-focus:font-bold absolute text-xl text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600/50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">نام و نام خانوادگی</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
                <input type="phone" name="phone" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600/50 peer" placeholder=" " required />
        <label for="floating_phone" class="peer-focus:font-bold absolute text-xl text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600/50 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">شماره تلفن</label>
    </div>
    <div class="max-w-sm mx-auto">
                <label for="details" class="block mb-2 text-sm font-bold text-gray-900">متن پیام</label>
                <textarea name="details" id="details" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-blue-600/30 rounded-lg border border-gray-300 focus:ring-gray-900 focus:border-gray-900 font-bold" placeholder="سلام دکتر ...."></textarea>
            </div>
            <button type="submit" class="mt-6 text-black text-2xl bg-blue-600/30 hover:bg-blue-600/50 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">ارسال</button>
        </form>
    </div>
@else
    <a href="/login">
        <button type="button" class="btn px-7 btn-outline text-black hover:bg-slate-700 hover:text-white font-medium rounded-lg text-2xl py-2 text-center">ورود</button>
    </a>
@endauth


<div class="max-w-lg mt-12 md:mt-0">
    <h1 class="text-4xl font-bold text-center md:text-right">وقت مشاوره</h1>
<p class="text-2xl my-4 mx-5">سلام، وقت شما به‌خیر، برای رزرو وقت مشاوره با پزشک لطفاً نام و نام خانوادگی، شماره تماس، و موضوع مشاوره را ارسال کنید تا هماهنگی لازم انجام شود. پس از بررسی زمان‌های خالی پزشک، وقت پیشنهادی به شما اعلام خواهد شد. در صورت نیاز به تغییر زمان، لطفاً در اسرع وقت اطلاع دهید. برای اطمینان از ثبت وقت، پیام تأییدیه دریافت خواهید کرد. با سپاس از اعتماد شما، منتظر حضور شما هستیم.</p>
        </div>
</div>
</div>
