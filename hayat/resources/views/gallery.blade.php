@php
$galleries = DB::table('galleries')->get();
@endphp

<div class="divider"></div>
<div class="w-fit px-7 py-3 bg-blue-600 bg-opacity-30 rounded-3xl opacity-90 my-12 text-center mx-auto flex gap-2 items-center">
    <h2 class="lg:text-4xl xxl:text-5xl md:text-3xl text-2xl mx-auto font-bold">
        گالری
    </h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 px-4" id="gallery-container">
    @foreach ($galleries as $index => $item)
        <div class="gallery-item fadeInDown aspect-square" style="display: {{ $index < 4 ? 'block' : 'none' }}">
            <img class="w-full h-full object-cover rounded-lg cursor-pointer hover:scale-105 transition-transform duration-300 shadow-lg" 
                 src="{{ asset('images/gallery/' . $item->image) }}" 
                 alt="{{ $item->details }}">
        </div>
    @endforeach
</div>

<div class="text-center my-4">
    <button id="show-more-btn" class="px-4 py-2 bg-blue-600 bg-opacity-30 rounded-3xl opacity-90 my-12 text-center mx-auto flex gap-2 items-center text-3xl">مشاهده بیشتر</button>
</div>

<!-- Modal for viewing larger images -->
<div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="relative w-full h-full p-4 flex items-center justify-center">
        <img id="modal-img" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg" src="" alt="">
        <button id="close-modal" class="absolute top-4 right-4 text-white text-4xl font-bold hover:text-gray-300 transition-colors">&times;</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const galleryItems = document.querySelectorAll('.gallery-item');
        const showMoreBtn = document.getElementById('show-more-btn');
        const modal = document.getElementById('image-modal');
        const modalImg = document.getElementById('modal-img');
        const closeModal = document.getElementById('close-modal');
        let visibleItems = 4;

        // Show more images on button click
        showMoreBtn.addEventListener('click', () => {
            visibleItems += 8; // Load 4 more rows (8 images in total)
            galleryItems.forEach((item, index) => {
                if (index < visibleItems) {
                    item.style.display = 'block';
                }
            });
            if (visibleItems >= galleryItems.length) {
                showMoreBtn.style.display = 'none'; // Hide the button when all images are visible
            }
        });

        // Open image in modal
        galleryItems.forEach(item => {
            item.querySelector('img').addEventListener('click', (e) => {
                modalImg.src = e.target.src;
                modal.classList.remove('hidden');
            });
        });

        // Close modal
        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>

<style>
    #image-modal {
        z-index: 1000;
    }

    #image-modal img {
        animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes fadeInDown {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  }
  @keyframes fadeInDown {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  }
</style>
