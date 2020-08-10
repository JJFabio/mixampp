/**
 *
 * Gulp task recipe to produce production ready files for a WordPress theme
 * @author Frank Schrijvers
 * @version 1.0
 * @link https://twitter.com/wpstudiowp
 *
 */

'use strict';

//* Store paths
var PATHS = {
	js: 	'./assets/js/',
	scss: 	'./assets/scss/',
	img: 	'./imgages/',
	build: {
		js: './build/js/',
		css: './build/css/'
	}
}

//* Load and define dependencies
var gulp 			= require( 'gulp' ),
	scss 			= require( 'gulp-sass' ),
	prefix		 	= require('gulp-autoprefixer'),
	imagemin		= require( 'gulp-imagemin' ),
 	uglify 			= require( 'gulp-uglify' ),
	rename 			= require( 'gulp-rename' ),
	sort 			= require( 'gulp-sort' ),
	wpPot 			= require( 'gulp-wp-pot' ),
	zip 			= require( 'gulp-zip' ),
	browserSync 	= require('browser-sync').create(),
	taskLoader  	= [ 'scripts', 'scss', 'imagemin', 'watch', 'browser-sync'  ];




//* Gulp task to combine JS files, minify, and output to bundle.min.js
gulp.task( 'scripts', function() {

	gulp.src( PATHS.js + '**/*.js' )
		.pipe( uglify() )
		.pipe( rename({ extname: '.min.js' }))
		.pipe( gulp.dest( PATHS.build.js ) );

});

//* Gulp task to compile, minify, and output stylesheet in place of old uncompressed version
gulp.task( 'scss', function() {

	gulp.src( PATHS.scss + 'style.scss' )
		.pipe(prefix( { browsers: ['last 2 versions'], cascade: false } ) )
		.pipe( scss( { outputStyle: '' } ) )
		.pipe( gulp.dest( './' ) );

});

//* Compress images
gulp.task( 'imagemin', function() {

	gulp.src( PATHS.img + '*' )
		.pipe( imagemin() )
		.pipe( gulp.dest( 'img' ) );

});

//* Watch files
gulp.task( 'watch', function() {

	gulp.watch( PATHS.js + '**/*.js', ['scripts'] );
	gulp.watch( PATHS.scss + '**/*.scss', ['scss'] ) .on('change', browserSync.reload);

});

//* ZIP theme
gulp.task( 'package-theme', function() {

	gulp.src( ['./**/*', '!./node_modules/', '!./gulpfile.js', '!./package.json' ] )
		.pipe( zip( __dirname.split("/").pop() + '.zip' ) )
		.pipe( gulp.dest( './' ) );

});

//* Translate theme
gulp.task( 'translate-theme', function() {

	gulp.src( [ './**/*.php' ] )
		.pipe( sort() )
		.pipe( wpPot({
			domain: "seasons-pro",
			headers: false
		}))
		.pipe( gulp.dest( './translation/' ));

});

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "seasons.dev"
    });
});

//* Load tasks
gulp.task( 'default', taskLoader );