<div id="gallery-section" class="content-section hidden">
    <h2 class="text-3xl text-center">افزودن ایتم منو</h2>
    <form action="{{ url('dash/upload_gal') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto justify-items-center">
        @csrf
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="details" class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">موضوع</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <label class="block mb-2 text-xl font-medium text-gray-900" for="img">آپلود عکس</label>
            <input class="block w-full text-xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="img" name="img" type="file" required>
        </div>
        <button type="submit" class="mt-5 btn btn-outline mx-auto text-xl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">افزودن</button>
    </form>

    <!-- Gallery Table -->
    <div class="mt-8">
        <h3 class="text-2xl text-center mb-4">گالری تصاویر</h3>
        <div class="bg-white rounded-lg shadow overflow-scroll">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr class="text-xl border-b">
                        <th class="px-6 py-4 text-right">تصویر</th>
                        <th class="px-6 py-4 text-right">موضوع</th>
                        <th class="px-6 py-4 text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $gallery_items = DB::table('galleries')->get();
                    @endphp

                    @forelse($gallery_items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <img src="{{ asset('images/gallery/' . $item->image) }}"
                                 alt="Gallery Image"
                                 class="w-24 h-24 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 text-xl">{{ $item->details }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <a href="{{ url('dash/delete_gallery', $item->id) }}"
                                   onclick="return confirm('آیا از حذف این تصویر مطمئن هستید؟')"
                                   class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">
                                    حذف
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">هیچ تصویری در گالری وجود ندارد</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
