const { mix } = require('laravel-mix');

mix
	.js('resources/assets/js/app.js', 'public/assets/js').version()
	.combine([
		'node_modules/materialize-css/dist/css/materialize.css',
		'resources/assets/bower_components/bootstrap/dist/css/bootstrap.css',
		'resources/assets/bower_components/bootstrap/dist/css/bootstrap-theme.css',
		'resources/assets/bower_components/font-awesome/css/font-awesome.css',
		'resources/assets/bower_components/open-sans/css/open-sans.css',
		'resources/assets/bower_components/simple-line-icons/css/simple-line-icons.css',
		'resources/assets/bower_components/simple-line-icons/css/simple-line-icons.css',
		'resources/assets/bower_components/ladda/dist/ladda-themeless.min.css',
		'resources/assets/css/components.css',
		'resources/assets/css/darkblue.css',
		'resources/assets/css/layout.css',
		'resources/assets/css/plugins.css',
		'resources/assets/css/todo.css',
	], 'public/assets/css/vendor.css')

	.combine(['resources/assets/css/login.css'], 'public/assets/css/login.css').version()
	
	.copy('resources/assets/bower_components/bootstrap/dist/fonts', 'public/assets/fonts')
	.copy('resources/assets/bower_components/font-awesome/fonts', 'public/assets/fonts')
	.copy('resources/assets/bower_components/open-sans/fonts', 'public/assets/fonts')
	.copy('resources/assets/bower_components/simple-line-icons/fonts', 'public/assets/fonts')
	.copy('node_modules/material-design-icons-iconfont/dist/fonts', 'public/assets/fonts')

	.copy('resources/assets/img', 'public/assets/img')

	.sass('resources/assets/sass/app.sass', 'public/assets/css').version();
