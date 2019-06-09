let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Js
mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/systems.js', 'public/js')
    .extract(['vue', 'vuetify']);

// Sass
mix.sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/systems.scss', 'public/css');

// Versioning
if (mix.inProduction()) {
    mix.version();
} else {
	mix.sourceMaps();
}
