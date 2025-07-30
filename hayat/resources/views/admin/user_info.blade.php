<div id="user-info" class="content-section hidden m-4 bg-white">
    <h2 class="text-3xl text-center">اطلاعات کاربری</h2>
    <form action="{{ route('admin.update_user_info') }}" method="POST" class="max-w-md mx-auto mt-8">
        @csrf
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

        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">نام</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">نام خانوادگی</label>
            <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">ایمیل</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">شماره تلفن</label>
            <input type="text"
                   name="phone"
                   value="{{ Auth::user()->phone }}"
                   placeholder="9012*******"
                   pattern="[0-9]{11}"
                   maxlength="11"
                   class="w-full px-3 py-2 border rounded">
            <p class="text-yellow-600 text-sm mt-1">لطفا از شماره تلفن خود اطمینان حاصل کنید</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">رمز عبور جدید (اختیاری)</label>
            <input type="password" name="password" class="w-full px-3 py-2 border rounded" placeholder="برای تغییر رمز عبور، رمز جدید را وارد کنید">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">تکرار رمز عبور جدید</label>
            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded" placeholder="رمز عبور جدید را تکرار کنید">
        </div>
        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">ذخیره تغییرات</button>
            <a href="{{ url('/dash') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">انصراف</a>
        </div>
    </form>
</div>
