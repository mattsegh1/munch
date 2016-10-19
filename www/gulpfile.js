var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/*
 vendor/jquery.min.js',
 'vendor/bootstrap.min.js',
 'vendor/chart.min.js',
 */

elixir(function(mix) {
    mix.sass('app.scss')
        .scripts([
            'charts.js',
            'utilities.js',
        ])
        .copy('resources/assets/js/vendor','public/js/vendor')
        .copy('resources/assets/img','public/img')
});
