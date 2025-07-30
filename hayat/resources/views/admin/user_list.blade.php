<div id="user-list" class="content-section hidden">
    <h2 class="text-3xl text-center mb-8">لیست کاربران</h2>
    <div class="overflow-x-auto">
        <div class="container mx-auto px-4">
            <!-- Search Input -->
            <div class="mb-6">
                <input
                    type="text"
                    id="searchInput"
                    class="input input-bordered w-full max-w-xs text-lg"
                    placeholder="جستجو..."
                    oninput="filterTable()"
                />
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow  overflow-scroll">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr class="text-xl border-b">
                            <th class="px-6 py-4 text-right">شماره</th>
                            <th class="px-6 py-4 text-right">نام</th>
                            <th class="px-6 py-4 text-right">نام خانوادگی</th>
                            <th class="px-6 py-4 text-right">ایمیل</th>
                            <th class="px-6 py-4 text-right">شماره تلفن</th>
                            <th class="px-6 py-4 text-right">دسترسی</th>
                            <th class="px-6 py-4 text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-gray-200">
                        @php
                            $users = DB::table('users')->get();
                        @endphp

                        @foreach($users as $index => $user)
                        <tr class="hover:bg-gray-50 text-lg">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->lastname }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->phone ?? 'ثبت نشده' }}</td>
                            <td class="px-6 py-4">
                                <span class="
                                    @if($user->role == 'admin')
                                        text-blue-600
                                    @elseif($user->role == 'doctor')
                                        text-green-500
                                    @else
                                        text-gray-600
                                    @endif
                                ">
                                    @if($user->role == 'admin')
                                        ادمین
                                    @elseif($user->role == 'doctor')
                                        دکتر
                                    @else
                                        کاربر
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ url('dash/edit_user', $user->id) }}"
                                       class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                                        ویرایش
                                    </a>
                                    <a href="{{ url('dash/delete_user', $user->id) }}"
                                       onclick="return confirm('آیا از حذف این کاربر مطمئن هستید؟')"
                                       class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">
                                        حذف
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @if(count($users) == 0)
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">هیچ کاربری یافت نشد</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const tbody = document.getElementById('tableBody');
        const rows = tbody.getElementsByTagName('tr');

        for (let row of rows) {
            const cells = row.getElementsByTagName('td');
            let found = false;
            
            for (let cell of cells) {
                const text = cell.textContent || cell.innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
            
            row.style.display = found ? '' : 'none';
        }
    }
</script>


