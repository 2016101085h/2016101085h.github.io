const mix = require('laravel-mix');

mix.styles([
    // 'resources/assets/plantilla/css/adminlte.css',

], 'public/css/plantilla.css')
mix.scripts([

        // 'resources/assets/plantilla/plugins/jquery/jquery.min.js',
        // 'resources/assets/plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js',
        // 'resources/assets/plugins/fastclick/fastclick.js',
        // 'resources/assets/plantilla/js/adminlte.min.js',
        // 'resources/assets/plantilla/js/demo.js',
        // 'resources/assets/plantilla/js/sweetalert2.all.min.js',





    ], 'public/js/plantilla.js')
    .js(['resources/js/app.js'], 'public/js/app.js');
