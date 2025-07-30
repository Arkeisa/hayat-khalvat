<style>
  /* Smooth background-image transition */
  #hero {
      transition: background-image 1s ease-in-out;
      position: relative; /* To enable pseudo-element layering */
      overflow: hidden; /* Prevent content overflow */
  }

  /* Pseudo-element for advanced animations */
  #hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
      opacity: 0; /* Initially invisible */
      transform: scale(1.2); /* Slight zoom effect */
      filter: blur(10px); /* Add a blur effect for transition */
      transition: opacity 1s ease, transform 1.5s ease, filter 1.5s ease; /* Smooth animations */
      z-index: 1; /* Layer it above the current background */
  }

  /* When fade class is added, reveal the new image with animations */
  #hero.fade::before {
      opacity: 1; /* Make the new image visible */
      transform: scale(1); /* Zoom back to normal */
      filter: blur(0); /* Remove the blur effect */
  }

  /* Ensure hero content stays above animations */
  .hero-content {
      position: relative;
      z-index: 2; /* Keeps content above pseudo-element */
      text-align: center;
  }
  .hero-content img {
        animation: logo-bounce 2s infinite ease-in-out; /* Add a subtle bounce animation to the logo */
    }

    @keyframes logo-bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
</style>

<div
id="hero"
class="hero h-screen bg-cover bg-center mt-14"
style="background-image: url('/images/1.JPG');">
<div class="hero-overlay bg-opacity-60"></div>
<div class="hero-content text-neutral-content text-center">
  <div class="max-w-md mx-auto">
      <img class="mx-auto h-56" src="/images/logo-white.png" alt="کافه لوگو">
    <h1 class="mb-5 text-5xl font-bold">خوش اومدی</h1>
    <p class="mb-5 text-2xl">
      کافه "حیات خلوت" جایی است برای استراحت و لذت بردن از لحظات آرامش‌بخش در فضایی دنج و دل‌انگیز. اینجا، ترکیب بی‌نظیری از طعم‌های خاص و محیطی آرام منتظر شماست.
    </p>
  </div>
</div>
</div>

<script>
// Array of image paths
const images = [
  '/images/1.JPG',
  '/images/2.JPG',
];

let currentIndex = 0; // Start from the first image
const heroElement = document.getElementById('hero'); // Get the hero element

// Function to preload images
const preloadImage = (src) => {
  return new Promise((resolve) => {
    const img = new Image();
    img.src = src;
    img.onload = resolve;
  });
};

// Function to change the background image
const changeBackgroundImage = async () => {
  const nextIndex = (currentIndex + 1) % images.length; // Get the next image index

  // Preload the next image
  await preloadImage(images[nextIndex]);

  // Temporarily show the new image in the pseudo-element for animations
  heroElement.style.setProperty('--next-image', `url(${images[nextIndex]})`);
  heroElement.classList.add('fade');

  // Set the new image to the pseudo-element
  heroElement.style.setProperty('background-image', `url(${images[nextIndex]})`);

  // Wait for the transition duration, then update the main background image
  setTimeout(() => {
    heroElement.style.backgroundImage = `url(${images[nextIndex]})`;
    heroElement.classList.remove('fade'); // Reset the fade effect
    currentIndex = nextIndex; // Update the current index
  }, 1500); // Match the CSS transition duration (1.5 seconds)
};

// Change the background image every 10 seconds
setInterval(changeBackgroundImage, 10000); // 10 seconds
</script>
