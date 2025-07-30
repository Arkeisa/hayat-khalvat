@if(Auth::user()->role === 'admin')
@extends('welcome')
@section('content')
<div id="add-cafe" class="content-section mt-20 px-5">
    <h2 class="text-3xl text-center">ویرایش آیتم منو</h2>
    <form action="/dash/edit_food/{{$item->id}}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto justify-items-center">
        @csrf
        <input type="hidden" name="model_type" value="{{ $type }}">
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="title" value="{{ $item->title }}" class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="" class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">اسم</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="details" value="{{ $type === 'food' ? $item->details : $item->detail }}" class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="" class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">مشخصات</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="price" value="{{ $item->price }}" class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">قیمت-تومان</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label class="block mb-2 text-xl font-medium text-gray-900 " for="image">آپلود عکس</label>
            <input class="block w-full text-xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none " aria-describedby="image_help" id="image" type="file" name="image">
            <img src="/food_img/{{ $item->image }}" width="100px">
        </div>

        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">دسته بندی</label>
        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " name="category" required>
            <option value="">انتخاب کنید</option>
            @if($type === 'food')
                <option value="صبحانه" {{ $item->category == 'صبحانه' ? 'selected' : '' }}>صبحانه</option>
                <option value="بارگرم" {{ $item->category == 'بارگرم' ? 'selected' : '' }}>بارگرم</option>
                <option value="بارسرد" {{ $item->category == 'بارسرد' ? 'selected' : '' }}>بارسرد</option>
                <option value="شیک و گلاسه" {{ $item->category == 'شیک و گلاسه' ? 'selected' : '' }}>شیک و گلاسه</option>
                <option value="کیک" {{ $item->category == 'کیک' ? 'selected' : '' }}>کیک</option>
                <option value="غذا" {{ $item->category == 'غذا' ? 'selected' : '' }}>غذا</option>
                <option value="سالاد" {{ $item->category == 'سالاد' ? 'selected' : '' }}>سالاد</option>
                <option value="دسر" {{ $item->category == 'دسر' ? 'selected' : '' }}>دسر</option>
                <option value="نوشیدنی" {{ $item->category == 'نوشیدنی' ? 'selected' : '' }}>نوشیدنی</option>
            @else
                <option value="دان قهوه" {{ $item->category == 'دان قهوه' ? 'selected' : '' }}>دان قهوه</option>
                <option value="پودر قهوه" {{ $item->category == 'پودر قهوه' ? 'selected' : '' }}>پودر قهوه</option>
                <option value="دستگاه" {{ $item->category == 'دستگاه' ? 'selected' : '' }}>دستگاه</option>
                <option value="اکسسوری" {{ $item->category == 'اکسسوری' ? 'selected' : '' }}>اکسسوری</option>
                <option value="لباس" {{ $item->category == 'لباس' ? 'selected' : '' }}>لباس</option>
                <option value="کتاب" {{ $item->category == 'کتاب' ? 'selected' : '' }}>کتاب</option>
            @endif
        </select>

        <div class="flex justify-between gap-4 mt-5">
            <button type="submit" class="btn btn-outline text-xl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg sm:w-auto px-5 py-2.5 text-center">بروزرسانی</button>

            <button type="button"
                    onclick="window.history.back()"
                    class="btn btn-outline text-xl focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg sm:w-auto px-5 py-2.5 text-center">
                کنسل
            </button>
        </div>
    </form>
</div>
@endsection
@endif
