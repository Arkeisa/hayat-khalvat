const mix = require('laravel-mix');
const path = require('path');

// Add Flowbite JS to the mix
mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
      require('tailwindcss'),
   ])
   .sourceMaps()
   .autoload({
      'flowbite': ['Flowbite']  // Automatically load Flowbite's JS
   });

// You can also add an alias for flowbite in case you need to import specific files
mix.webpackConfig({
    resolve: {
        alias: {
            'flowbite': path.resolve(__dirname, 'node_modules/flowbite'),
        },
    },
});