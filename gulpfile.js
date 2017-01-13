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

elixir(function(mix) {
    mix.sass([
    	'app.scss'
    ])
    .styles([
		'public/css/jquery/jquery-ui.min.css',
		'public/css/app.css'
	], 'public/css/all.css', 'public/css');
    
    mix.scripts([
		'jquery/jquery-ui.min.js',
		'app.js',
	], 'public/js/all.js', 'public/js');

	mix.sass([
    	'admin/auth.scss'
    ], 'public/admin/css/auth.css')
    .styles([
		'css/auth.css'
	], 'public/admin/css/auth_all.css', 'public/admin');
    
    mix.scripts([
		'js/auth.js'
	], 'public/admin/js/auth_all.js', 'public/admin');

	mix.sass([
    	'admin/app.scss'
    ], 'public/admin/css')
    .styles([
		'public/admin/css/app.css'
	], 'public/admin/css/all.css', 'public/admin/css');
    
    mix.scripts([
		'app.js'
	], 'public/admin/js/all.js', 'public/admin/js');

    mix.version(['css/all.css', 'js/all.js', 'admin/css/auth_all.css', 'admin/js/auth_all.js', 'admin/css/all.css', 'admin/js/all.js']);
});
