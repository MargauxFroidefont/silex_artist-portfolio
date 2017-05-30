var gulp         = require( 'gulp' ),
	gulp_stylus  = require( 'gulp-stylus' ),
	gulp_plumber = require( 'gulp-plumber' );



gulp.task( 'css', function()
{
	return gulp.src( './web/assets/style/stylus/main.styl' )
		.pipe( gulp_plumber() )
		.pipe( gulp_stylus( { compress: true } ) )
		.pipe( gulp.dest( './web/assets/style/' ) );
} );



gulp.task( 'watch', function()
{
	gulp.watch( './web/assets/style/stylus/**', [ 'css' ] );
} );



gulp.task( 'default', [ 'css', 'watch' ] );
