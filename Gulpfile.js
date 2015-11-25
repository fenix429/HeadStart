
var path = require('path');
var gulp = require('gulp');
var clean = require('gulp-clean');
var less = require('gulp-less');
var sourcemaps = require('gulp-sourcemaps');
var minifycss = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var phplint = require('phplint').lint;

var paths = {
	less: 'less/style.less',
	images: 'images/**/*',
	php: ['./**/*.php', '!./node_modules/**/*.php', '!./components/**/*.php'],
}

gulp.task('less', function() {
	return gulp.src(paths.less)
		.pipe(sourcemaps.init())
		.pipe(less({
			// Include Paths
			paths: [ path.join(__dirname, 'less', 'components') ]
		}))
		.pipe(minifycss())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('.'));
});

gulp.task('less-uncompressed', function() {
	return gulp.src(paths.less)
		.pipe(less({
			// Include Paths
			paths: [ path.join(__dirname, 'less', 'components') ]
		}))
		.pipe(gulp.dest('.'));
});

gulp.task('clean-images', function () {
  return gulp.src(['img/**/*.jpg', 'img/**/*.png', 'img/**/*.gif'], {read: false})
    .pipe(clean());
});

gulp.task('process-images', ['clean-images'], function() {
	return gulp.src(paths.images)
		.pipe(imagemin({
			progressive: true,
			use: [pngquant()]
		}))
		.pipe(gulp.dest('img'));
});

gulp.task('phplint', function (cb) {
  phplint(paths.php, {limit: 10}, function (err, stdout, stderr) {
	if (err) {
		cb(err)
		//process.exit(1)
	} else {
		cb()
	}
  })
});

gulp.task('watch', function() {
	gulp.watch(paths.php, ['phplint'])
	gulp.watch('less/**/*.less', ['less']);
	gulp.watch(paths.images, ['process-images']);
});

gulp.task('default', ['watch', 'phplint', 'less', 'process-images']);