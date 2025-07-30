<div id="add-cafe" class="content-section hidden">
    <h2 class="text-3xl text-center">افزودن ایتم منو</h2>
    <form action="{{ url('dash/upload_food') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto justify-items-center">
        @csrf
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="title" class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">اسم</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="details" class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">مشخصات</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="price" class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">قیمت-تومان</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label class="block mb-2 text-xl font-medium text-gray-900" for="img">آپلود عکس</label>
            <input class="block w-full text-xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="img" name="img" type="file" required>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label class="block mb-2 text-xl font-medium text-gray-900">دسته بندی</label>
            <select name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="">انتخاب کنید</option>
                <option value="صبحانه">صبحانه</option>
                <option value="بارگرم">بارگرم</option>
                <option value="بارسرد">بارسرد</option>
                <option value="شیک و گلاسه">شیک و گلاسه</option>
                <option value="کیک">کیک</option>
                <option value="غذا">غذا</option>
                <option value="سالاد">سالاد</option>
                <option value="دسر">دسر</option>
                <option value="نوشیدنی">نوشیدنی</option>
            </select>
        </div>

        <button type="submit" class="mt-5 btn btn-outline mx-auto text-xl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">افزودن</button>
    </form>
</div>
