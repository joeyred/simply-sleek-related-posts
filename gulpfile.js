var plugin      = require('gulp-load-plugins')({
  rename: {
    'gulp-merge-media-queries': 'mmq'
  }
});
var gulp        = require('gulp');
var	browserSync = require('browser-sync').create();
var	sequence    = require('run-sequence');
var	del         = require('del');

// BrowserSync
var PORT = 3000;

// CSS Vendor Prefixer
var COMPATIBILITY = ['last 2 versions', 'ie >= 9'];

gulp.task('browserSync', function() {
	 browserSync.init({
		  port: PORT
	  , proxy: "wordpress-themes.dev"
	  , notify: true // boolean value, Toggle notifications of bsync activity
	  ,	open: false // toggle auotmatic opening of webpage upong bsync starting
    });
});

/*
 * PIPES
 */

/* Clean */
gulp.task('clean', function() {
	del(['css/app*.css*', 'js/app*.js*']);
});

/* Compile SCSS */
gulp.task('compileSass', function() {
	return gulp.src('src/scss/ssrp.scss')
		.pipe(plugin.sourcemaps.init())
		.pipe(plugin.sass({
			includePaths: 'src/scss'
		})
			.on('error', plugin.sass.logError)
		)
		.pipe(plugin.mmq({
			log: true
		}))
		.pipe(plugin.autoprefixer({
			browsers: COMPATIBILITY
		}))
		.pipe(plugin.sourcemaps.write('./'))
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream({ // Inject Styles
			match: '**/*.css' // Force source map exclusion *This fixes reloading issue on each file change*
		}));
});

/* Concatinate Main JS Files */
gulp.task('concatScripts', function() {
	return gulp.src('src/js/**.js')
	.pipe(plugin.sourcemaps.init())
	.pipe(plugin.concat('ssrp.js'))
	.pipe(plugin.sourcemaps.write('./'))
	.pipe(gulp.dest('js'));
});

gulp.task('minifyStyles', function() {
	return gulp.src('css/ssrp.css')
	.pipe(plugin.cleanCss())
	.pipe(gulp.dest('css'));
});

gulp.task('minifyScripts', function() {
	return gulp.src('js/ssrp.js')
	.pipe(plugin.uglify())
	.pipe(gulp.dest('js'));
});

/* Watch Task */
gulp.task('watch', ['browserSync'], function() {
	gulp.watch('src/scss/**/*.scss', ['compileSass']);
	gulp.watch('**/*.php').on('change', browserSync.reload);
	gulp.watch('src/js/*.js', ['concatScripts']).on('change', browserSync.reload);
});

/* Development Task */
gulp.task('dev', function(cb) {
	sequence(
		'clean',
		'compileSass',
		'concatScripts',
		cb
	);
});

/* Production Task */
gulp.task('pro', function(cb) {
	sequence(
		'clean',
		'compileSass',
		'concatScripts',
		'minifyStyles',
		'minifyScripts',
		cb
	);
});

gulp.task('default', function(){
	gulp.start( 'watch', ['dev'] );
});
