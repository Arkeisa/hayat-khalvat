<section class="bg-gray-50 w-full">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-20 h-auto mr-2" src="/images/logo-min.png" alt="logo">
        </a>
        <div class="w-full bg-white rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-center text-3xl font-bold leading-10 tracking-wider text-gray-900">
                   <span class="text-4xl">میخوای عضو شی؟</span> <br>سفارش یادت نره
                </h1>
                <form action="{{ route('register') }}" method="POST" class="space-y-4 md:space-y-6">
@csrf
                    <div>
                        <label for="name" class="text-2xl block mb-2 font-medium text-gray-900">نام</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="ali" required="">
                    </div>
                    <div>
                        <label for="lastname" class="text-2xl block mb-2 font-medium text-gray-900">نام خانوادگی</label>
                        <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="torabi" required="">
                    </div>
                    <div>
                        <label for="email" class="text-2xl block mb-2 font-medium text-gray-900">ایمیل</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="phone" class="text-2xl block mb-2 font-medium text-gray-900">شماره تلفن</label>
                        <input type="text" name="phone" id="phone"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                               placeholder="*******0912"
                               pattern="[0-9]{11}"
                               maxlength="11"
                               required="">
                    </div>
                    <div>
                        <label for="password" class="text-2xl block mb-2 font-medium text-gray-900">پسورد</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-2xl block mb-2 font-medium text-gray-900">تکرار پسورد</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    <button type="submit" class="btn btn-outline btn-md text-3xl w-full text-gray-900 text-center">ثبت نام</button>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="ml-3 text-sm">
                        </div>
                        <a href="/forgot" class=" font-medium text-primary-600 hover:underline text-2xl">فراموشی رمز?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </section>
