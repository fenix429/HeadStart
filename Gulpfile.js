
var path = require('path');
var del = require('del');
var gulp = require('gulp');
var notify = require('gulp-notify');
var notifier = require('node-notifier');
var plumber = require('gulp-plumber');
var runSequence = require('run-sequence');
var livereload = require('gulp-livereload');
var less = require('gulp-less');
var sourcemaps = require('gulp-sourcemaps');
var minifycss = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var phplint = require('phplint').lint;
var zip = require('gulp-zip');

var paths = {
	less: 'less/style.less',
	images: ['raw_images/**/*.jpg', 'raw_images/**/*.png', 'raw_images/**/*.gif'],
	php: ['./**/*.php', '!./node_modules/**/*.php', '!./components/**/*.php'],
	build: [
		'./**/*', '!./{node_modules,node_modules/**}', '!./{less,less/**}', '!./{raw_images,raw_images/**}', '!./{build,build/**}',
		'!*.sublime-+(project|workspace)', '!sftp-config?(-alt?).json', '!package.json', '!Gulpfile.js', '!.bowerrc', '!bower.json',
		'!codesniffer.ruleset.xml', '!./**/.gitignore', '!./**/{.git,.git/**}', '!./**/.DS_Store'
	]
}

var onError = function(err) {
	notify.onError({
		title: 'Gulp: Failure!',
		message: 'Error: <%= error.message %>'
	})(err);

	this.emit('end');
};

gulp.task('clean-images', function () {
	return del([
		'img/**/*.jpg',
		'img/**/*.png',
		'img/**/*.gif'
	]);
});

gulp.task('process-images', ['clean-images'], function() {
	return gulp.src(paths.images)
		.pipe(plumber({errorHandler: onError}))
		.pipe(imagemin({
			progressive: true,
			use: [pngquant()]
		}))
		.pipe(gulp.dest('img'))
		.pipe(livereload())
		.pipe(notify({
			title: 'Gulp: Success!',
			message: 'Images Optimized',
			onLast: true
		}));
});

gulp.task('less', function() {
	return gulp.src(paths.less)
		.pipe(plumber())
		.pipe(less({
			// Include Paths
			paths: [ path.join(__dirname, 'less', 'components') ]
		}))
		.pipe(gulp.dest('.'))
		.pipe(livereload())
		.pipe(notify({
			title: 'Gulp: Success!',
			message: 'Less Compiled'
		}));
});

gulp.task('less-minified', function() {
	return gulp.src(paths.less)
		.pipe(plumber({errorHandler: onError}))
		.pipe(sourcemaps.init())
		.pipe(less({
			// Include Paths
			paths: [ path.join(__dirname, 'less', 'components') ]
		}))
		.pipe(minifycss())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('.'))
		.pipe(livereload())
		.pipe(notify({
			title: 'Gulp: Success!',
			message: 'Less Compiled'
		}));
});

gulp.task('less-build', ['process-images'], function() {
	return gulp.src(paths.less)
		.pipe(plumber({errorHandler: onError}))
		.pipe(less({
			// Include Paths
			paths: [ path.join(__dirname, 'less', 'components') ]
		}))
		.pipe(minifycss())
		.pipe(gulp.dest('.'))
		.pipe(livereload())
		.pipe(notify({
			title: 'Gulp: Success!',
			message: 'Less Compiled'
		}));
});

gulp.task('phplint', function (cb) {
  phplint(paths.php, {limit: 10}, function (err, stdout, stderr) {
	if (err) {
		notifier.notify({
			title: 'Gulp: Failure!',
			message: 'Error: ' + err.message,
			icon: path.join(__dirname, 'node_modules', 'gulp-notify', 'assets', 'gulp-error.png')
		});
		
		cb(err);
		//process.exit(1);
	} else {
		notifier.notify({
			title: 'Gulp: Success!',
			message: 'PHPLint found no errors.',
			icon: path.join(__dirname, 'node_modules', 'gulp-notify', 'assets', 'gulp.png')
		});

		cb();
	}
  })
});

gulp.task('watch', function() {
	livereload.listen();
	gulp.watch(paths.images, ['process-images']);
	gulp.watch(paths.php).on( 'change', function( file ) {
		livereload.changed( file );
	} );
	gulp.watch('less/**/*.less', ['less']);
	gulp.watch(paths.php, ['phplint']);
});

gulp.task('build', ['process-images', 'less-build'], function() {
	var archiveFile = __dirname.split(path.sep).pop() + '.zip';

	del.sync(['build/**']);

	return gulp.src(paths.build, { base: "." })
		.pipe(plumber())
		.pipe(zip(archiveFile))
		.pipe(gulp.dest('build'));
});

gulp.task('default', function(cb){
	runSequence('phplint', 'process-images', 'less', 'watch', cb);
});
