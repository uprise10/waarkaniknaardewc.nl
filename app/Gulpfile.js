/* Needed gulp config */
var gulp = require('gulp');
var sass = require('gulp-sass');
var cssnano = require('gulp-cssnano');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var notify = require('gulp-notify');
var imagemin = require('gulp-imagemin');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var plumber = require('gulp-plumber');
var browserSync = require('browser-sync');
var reload = browserSync.reload;

var wpThemeDir = 'www/wp-content/themes/brunen';
var wpPluginDir = 'www/wp-content/plugins/brunen';
var src = wpThemeDir + '/assets/_src';
var dist = wpThemeDir + '/assets';

var paths = {
    css_src: src + '/css/**/*.scss',
    css_dist: dist + '/css/',

    js_src: [
        src + '/js/vendor/*.js',
        src + '/js/main.js'
    ],
    js_dist: dist + '/js',

    img_src: src + '/images/**/*',
    img_dist: dist + '/images',

	php_src: [wpThemeDir + '/*.php', wpThemeDir + '/**/*.php', wpPluginDir + '/*.php', wpPluginDir + '/**/*.php']
};

/* Scripts task */
gulp.task('scripts', function() {
    return gulp.src(paths.js_src)
        .pipe(concat('main.js'))
        .pipe(gulp.dest(paths.js_dist))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify().on('error', function(e) {
            console.log(e);
        }))
        .pipe(gulp.dest(paths.js_dist));
});

/* Sass task */
gulp.task('sass', function() {
    gulp.src(paths.css_src)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', handleErrors))
        .pipe(autoprefixer('last 2 version', 'ie 9', 'ios 6', 'android 4'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(paths.css_dist))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssnano({
            zindex: false
        }))
        .pipe(gulp.dest(paths.css_dist))
        .pipe(reload({stream: true}))
});

/* Minify images */
gulp.task('imagemin', function() {
    return gulp.src(paths.img_src)
        .pipe(imagemin([
			imagemin.gifsicle({interlaced: true}),
			imagemin.jpegtran({progressive: true}),
			imagemin.optipng({optimizationLevel: 5}),
			imagemin.svgo({plugins: [{removeViewBox: true}]})
		], {
			verbose: true
		}))
        .pipe(gulp.dest(paths.img_dist));
});

/* Reload task */
gulp.task('bs-reload', function() {
    browserSync.reload();
});


/* Prepare Browser-sync for localhost */
gulp.task('browser-sync', function() {
    browserSync.init([paths.css_src, paths.js_src, paths.img_dist], {
        open: false,
		injectChanges: true,
        proxy: 'loc.brunen.nl',
		notify: false,
		https: false,
        ghostMode: {
            clicks: true,
            scroll: true,
            links: true,
            forms: true
        },
		reloadDelay: 1000,
		watchOptions: {
			debounceDelay: 1000
		}
    });
});

/* Watch scss, js and html files, doing different things with each. */
gulp.task('default', ['sass', 'scripts', 'browser-sync'], function() {
    /* Watch scss, run the sass task on change. */
    gulp.watch([paths.css_src], ['sass', 'bs-reload']);
    /* Watch app.js file, run the scripts task on change. */
    gulp.watch([paths.js_src], ['scripts', 'bs-reload']);

    /* Watch .php files, run the bs-reload task on change. */
    gulp.watch([paths.php_src], ['bs-reload']);
});

function handleErrors() {
    var args = Array.prototype.slice.call(arguments);

    // Send error to notification center with gulp-notify
    notify.onError({
        title: "Compile Error",
        message: "<%= error.message %>"
    }).apply(this, args);

    this.emit('end');
}