{{-- <div class="container mx-auto px-4 py-8 max-w-5xl mt-28">
    <!-- Video Section -->
    <div class="bg-black rounded-lg overflow-hidden shadow-lg">
      <video id="video-player" class="w-full" controls>
        <source src="https://aspb2.cdn.asset.aparat.com/aparat-video/75bc4c8a3cda13be091331d2612c16e315295946-720p.mp4?wmsAuthSign=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbiI6IjY0NWMwZThkNTZiNGFiMmYwODk3ZTM5YWE2YzVkMGY4IiwiZXhwIjoxNzMzMDA4NDA3LCJpc3MiOiJTYWJhIElkZWEgR1NJRyJ9.zYV2KF-YXjSF_wF_Z6zNn2hwSRvDdAEBK3gcNjdOCoA" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>

    <!-- Video Details -->
    <div class="mt-4">
      <!-- Video Title -->
      <h1 class="text-xl font-bold">اموزش کلد بلو</h1>

      <!-- Video Stats -->
      <div class="flex items-center text-gray-500 text-sm mt-2">
        <span>123,456 views</span>
        <span class="mx-2">•</span>
        <span>Uploaded on Nov 30, 2024</span>
      </div>

      <!-- Interaction Buttons -->
      <div class="flex items-center justify-between mt-4">
        <!-- Likes/Dislikes -->
        <div class="flex space-x-4">
          <button class="flex items-center text-gray-500 hover:text-blue-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-1">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9l-6 6m0 0l6 6m-6-6h12"></path>
            </svg>
            <span>Like</span>
          </button>
          <button class="flex items-center text-gray-500 hover:text-blue-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-1">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9l6 6m0 0l-6 6m6-6H4"></path>
            </svg>
            <span>Dislike</span>
          </button>
        </div>

        <!-- Share Button -->
        <button class="flex items-center text-gray-500 hover:text-blue-500 transition">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l4-4m0 0l-4-4m4 4H9"></path>
          </svg>
          <span>Share</span>
        </button>
      </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-8">
      <h2 class="text-lg font-semibold">Comments</h2>
      <div class="mt-4 space-y-4">
        <div class="flex space-x-4">
          <img src="https://via.placeholder.com/50" alt="Avatar" class="rounded-full w-12 h-12">
          <div>
            <p class="font-semibold">John Doe</p>
            <p class="text-sm text-gray-500">This video is amazing! Keep it up!</p>
          </div>
        </div>
        <div class="flex space-x-4">
          <img src="https://via.placeholder.com/50" alt="Avatar" class="rounded-full w-12 h-12">
          <div>
            <p class="font-semibold">Jane Smith</p>
            <p class="text-sm text-gray-500">Very helpful, thanks for sharing!</p>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <div class="min-h-screen bg-gray-900 flex flex-col items-center justify-center relative px-4">
    <!-- Background Image -->
    <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center opacity-30"
        style="background-image: url('/images/comingsoon.png');">
    </div>
    
    <!-- Main Heading -->
    <h1 class="text-5xl md:text-7xl text-white font-bold mb-8 z-10">به زودی آموزش شروع میشه!</h1>
    
    <!-- Typing Animation -->
    <p id="typing-text" class="text-white text-2xl md:text-2xl"></p>
  </div>
  
  <script>
    // List of texts to cycle through
    const texts = [
      "به زودی با یک تجربه‌ای شگفت‌انگیز بازمی‌گردیم! منتظر باشید",
      "در حال آماده‌سازی بهترین آموزش‌های دنیای قهوه برای شما هستیم! ",
      "با عطر قهوه و طعمی از دانش، به زودی کنار شما خواهیم بود!",
      "طعم واقعی قهوه، زمانی کشف می‌شود که هنر و علم در یک فنجان جمع شوند!",
      "همراه شما در مسیر موفقیت",
      "به زودی ویدئوهای آموزشی در دسترس خواهد بود",
      "شگفتی‌های آموزشی در راه است!",
      "برای شروعی نو آماده شوید.",
      "تحولی نوین در یادگیری آنلاین",
      "به زودی همراه شما خواهیم بود!"
    ];
  
    let index = 0; // Current text index
    let charIndex = 0; // Current character index
    const textElement = document.getElementById('typing-text');
    
    function typeText() {
      if (charIndex < texts[index].length) {
        // Add one character at a time
        textElement.textContent += texts[index][charIndex];
        charIndex++;
        setTimeout(typeText, 100); // Typing speed (100ms per character)
      } else {
        // Wait for a while before deleting the text
        setTimeout(deleteText, 2000); // Wait 2 seconds before deleting
      }
    }
  
    function deleteText() {
      if (charIndex > 0) {
        // Remove one character at a time
        textElement.textContent = texts[index].substring(0, charIndex - 1);
        charIndex--;
        setTimeout(deleteText, 50); // Deleting speed (50ms per character)
      } else {
        // Move to the next text
        index = (index + 1) % texts.length; // Loop through the texts
        setTimeout(typeText, 500); // Start typing the next text after a short delay
      }
    }
  
    // Start the typing animation
    typeText();
  </script>
  