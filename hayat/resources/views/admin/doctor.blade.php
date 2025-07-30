@if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'doctor'))
    <div id="doctor-section" class="content-section hidden">
        <h2 class="text-3xl font-bold mb-8">درخواست‌های مشاوره</h2>

        <div class="bg-white rounded-lg shadow  overflow-scroll">
            <table class="w-full table-auto">
                <thead class="bg-gray-50 ">
                    <tr class="text-xl border-b">
                        <th class="px-6 py-4 text-right">نام</th>
                        <th class="px-6 py-4 text-right">شماره تماس</th>
                        <th class="px-6 py-4 text-right">پیام</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $consultations = DB::table('doctors')->get();
                    @endphp
                    @forelse($consultations as $consultation)
                        <tr class="text-lg">
                            <td class="text-2xl">{{ $consultation->name }}</td>
                            <td class="text-2xl"><a href="tel:{{ $consultation->phone }}">{{ $consultation->phone }}</a></td>
                            <td class="text-gray-900 max-w-36">{{ $consultation->details }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">هیچ درخواست مشاوره‌ای یافت نشد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif




