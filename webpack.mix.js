const mix = require('laravel-mix');

mix.js(
    'resources/js/app.js', //add new row
    'resources/js/demo.js', //add new row
    'public/js'
    )
    .vue({ version: 3 }) // sử dụng phiên bản vue 3 thì thêm dòng này
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
