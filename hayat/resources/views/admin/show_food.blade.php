<div id="edit-menu" class="content-section hidden">
  <h2 class="text-3xl text-center">ویرایش منو</h2>
  <div class="container mx-auto mt-8 px-4">
      <!-- Search Bar -->
      <div class="mb-4 max-w-lg">
          <input type="text" id="searchBar" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="جستجو..." onkeyup="searchFood()">
      </div>

      <!-- Mobile View (Stacked Cards) -->
      <div class="mt-4 space-y-4">
        @php
          $food = DB::table('food')->get();
          $c_o_f_e_s = DB::table('c_o_f_e_s')->get();

          // Add type identifier to each item
          $food = array_map(function($item) {
              $item->model_type = 'food';
              return $item;
          }, $food->toArray());

          $c_o_f_e_s = array_map(function($item) {
              $item->model_type = 'cofe';
              return $item;
          }, $c_o_f_e_s->toArray());

          // Combine both collections
          $allItems = array_merge($food, $c_o_f_e_s);
        @endphp
        <div class="grid grid-cols-1 gap-3 w-full lg:grid-cols-2 mx-auto">
          @foreach ($allItems as $item)
            <div class="food-card border border-gray-300 rounded-lg shadow-lg p-4 bg-white">
              <div class="grid lg:flex items-center lg:justify-between mb-4 justify-center">
                <h2 class="text-3xl font-semibold text-center">{{ $item->title }}</h2>
                <img src="food_img/{{ $item->image }}" alt="Food Item" class="w-40 h-40 object-cover rounded">
              </div>
              <div class="mb-2 mx-auto w-full text-3xl">
                  <span class="font-semibold">توضیحات:</span>
                  {{ isset($item->details) ? $item->details : $item->detail }}
              </div>
              <div class="mb-2 mx-auto w-full text-3xl">
                  <span class="font-semibold">دسته بندی:</span> {{ $item->category }}
              </div>
              <div class="mb-2 mx-auto text-center w-full text-3xl">
                <span class="font-semibold">قیمت:</span> {{ $item->price }}
              </div>
              <div class="flex space-x-2 mt-4 justify-between">
                  <td>
                      <a class="bg-blue-500/80 text-white px-2 py-1 rounded hover:bg-blue-600 w-1/3"
                         href="/dash/update_food/{{ $item->id }}?type={{ $item->model_type }}">Edit</a>
                  </td>
                <td>
                    <a class="bg-red-500/80 text-white px-2 py-1 rounded hover:bg-red-600 w-1/3"
                       onclick="return confirm('Are you sure to delete this?')"
                       href="{{ url('dash/delete_food', $item->id) }}">Delete</a>
                </td>
              </div>
            </div>
          @endforeach
        </div>
      </div>
  </div>
</div>

<script>
// Function to filter food items based on the search query
function searchFood() {
let input = document.getElementById('searchBar');
let filter = input.value.toLowerCase();
let foodCards = document.getElementsByClassName('food-card');

// Loop through all food cards
for (let i = 0; i < foodCards.length; i++) {
  let title = foodCards[i].getElementsByTagName('h2')[0].innerText.toLowerCase();

  // If title matches the search filter, display the card, otherwise hide it
  if (title.indexOf(filter) > -1) {
    foodCards[i].style.display = '';
  } else {
    foodCards[i].style.display = 'none';
  }
}
}
</script>
