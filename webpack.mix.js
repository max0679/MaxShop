const mix = require('laravel-mix');

/*
    для объединения потребуется node.js
    Объединение front-файлов - часть 1, видео 25 (laravel mix), часть 2, видео 2
	1) Скачать и установить NodeJS: https://nodejs.org/en/
	2) Переходим в папку проекта (C:\wamp64\www)
	3) Команда 'npm install' - в корне появится папка node_modules
 */

// npm run dev
//front

mix.styles([
    'resources/assets/common/css/icheck.css',
    'resources/assets/common/plugins/bootstrap-4/css/bootstrap.min.css',
    'resources/assets/common/plugins/bootstrap/css/bootstrap.min.css',
    'resources/assets/common/plugins/fontawesome/css/all.css',
    'resources/assets/front/css/custom/main.css',
    'resources/assets/front/css/custom/product.css',
    'resources/assets/front/css/custom/mtree.css',
    'resources/assets/front/css/custom/breadcrumbs.css',
    'resources/assets/front/css/custom/header.css',
    'resources/assets/front/css/custom/auth_and_reg.css',
], 'public/assets/front/css/front.css');


mix.scripts([
    'resources/assets/common/plugins/jquery/jquery.js',
    'resources/assets/common/plugins/jquery/velocity.min.js', // для аккордиона
    'resources/assets/common/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/front/js/mtree.js',
], 'public/assets/front/js/front.js');

mix.scripts([
    'resources/assets/front/js/custom/service/main.js',
], 'public/assets/front/js/custom/service/main.js');

mix.scripts([
    'resources/assets/front/js/custom/ui/main.js',
], 'public/assets/front/js/custom/ui/main.js');



mix.scripts([
    'resources/assets/front/js/custom/ui/home.js',
], 'public/assets/front/js/custom/ui/home.js');
mix.scripts([
    'resources/assets/front/js/custom/ui/all_products.js',
], 'public/assets/front/js/custom/ui/all_products.js');
mix.scripts([
    'resources/assets/front/js/custom/ui/search_products.js',
], 'public/assets/front/js/custom/ui/search_products.js');
mix.scripts([
    'resources/assets/front/js/custom/ui/single_category.js',
], 'public/assets/front/js/custom/ui/single_category.js');
mix.scripts([
    'resources/assets/front/js/custom/ui/single_product.js',
], 'public/assets/front/js/custom/ui/single_product.js');



mix.copyDirectory('resources/assets/front/webfonts', 'public/assets/front/webfonts');
mix.copyDirectory('resources/assets/front/img', 'public/assets/front/img');


// admin

mix.styles([
    'resources/assets/common/plugins/fontawesome/css/all.css',
    'resources/assets/admin/css/adminlte.css',
    'resources/assets/admin/css/custom/main.css'
], 'public/assets/admin/css/admin.css');

mix.scripts([
    'resources/assets/common/plugins/jquery/jquery.min.js',
    'resources/assets/common/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/js/adminlte.js',
    //'resources/assets/admin/js/demo.js'
], 'public/assets/admin/js/admin.js');

// покажет путь загружаемой картинки
mix.scripts([
    'resources/assets/admin/plugins/bs_custom_file/upload_file.js',
], 'public/assets/admin/js/upload_file.js');


// mix.scripts([
//     'resources/assets/admin/plugins/ckeditor5/build/ckeditor.js',
//     'resources/assets/admin/plugins/ckfinder/ckfinder/ckfinder.js',
//     'resources/assets/admin/plugins/ckfinder/ckfinder/config.js',
//     'resources/assets/admin/js/userscripts/for_ckfinder.js',
// ], 'public/assets/admin/plugins/ckeditor_ckfinder/ckeditor_ckfinder.js');
// mix.copyDirectory('resources/assets/admin/plugins/ckfinder/ckfinder/config.php', 'public/assets/admin/plugins/ckeditor_ckfinder/config.php');
mix.scripts([
    'resources/assets/admin/js/custom/ui/main.js',
], 'public/assets/admin/js/custom/ui/main.js');

mix.scripts([
    'resources/assets/admin/js/custom/ui/products.js',
], 'public/assets/admin/js/custom/ui/products.js');

mix.scripts([
    'resources/assets/admin/js/custom/for_ckfinder.js',
], 'public/assets/admin/js/custom/for_ckfinder.js');

mix.copyDirectory('resources/assets/admin/plugins/ckeditor5', 'public/assets/admin/plugins/ckeditor5');
mix.copyDirectory('resources/assets/admin/plugins/ckfinder', 'public/assets/admin/plugins/ckfinder');

mix.copyDirectory('resources/assets/common/plugins/fontawesome/webfonts', 'public/assets/admin/webfonts');
mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img');

mix.copyDirectory('resources/assets/common/img/no_image.png', 'public/assets/common/img/no_image.png');

mix.copyDirectory('resources/assets/admin/css/adminlte.css.map', 'public/assets/admin/css/adminlte.css.map');
mix.copyDirectory('resources/assets/admin/js/adminlte.js.map', 'public/assets/admin/js/adminlte.js.map');
