@extends('welcome')
@section('content')




<div id="edit-user" class="content-section m-4 mt-20">
    <h2 class="text-3xl text-center">ویرایش کاربر</h2>
    <form action="{{ url('dash/update_user', $user->id) }}" method="POST" class="max-w-md mx-auto mt-8">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">نام</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">نام خانوادگی</label>
            <input type="text" name="lastname" value="{{ $user->lastname }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">ایمیل</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-xl mb-2">شماره تلفن</label>
            <input type="text"
                   name="phone"
                   value="{{ $user->phone }}"
                   placeholder="9012*******"
                   pattern="[0-9]{11}"
                   maxlength="11"
                   class="w-full px-3 py-2 border rounded">
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <label class="block mb-2 text-sm font-medium text-gray-900">نقش کاربر</label>
            <select name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>کاربر عادی</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ادمین</option>
                <option value="doctor" {{ $user->role == 'doctor' ? 'selected' : '' }}>دکتر</option>
            </select>
        </div>
        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">ذخیره تغییرات</button>
            <a href="{{ url('/dash') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">انصراف</a>
        </div>
    </form>
</div>

@endsection
