/**
 * Gulp modules
 */
var gulp        = require('gulp'),
    concat      = require('gulp-concat-css'),
    minify      = require('gulp-minify-css'),
    uglify      = require('gulp-uglifyjs'),
    autoprefixer = require('gulp-autoprefixer');

/**
 * Build params
 */
var build = {
    destination : {
        sources : './build/dist/'
    },
    tpl : {
        js          : './src/assets/js/**/*.js',
        css         : './src/assets/css/*.css',
        png         : './src/assets/img/*.png',
    },
    min : {
        js : 'main.min.js',
        css : 'main.min.css'
    }
};

// Add task by default. Required always!
gulp.task('default', function() {

    // run all tasks
    gulp.start('js', 'css', 'png');

});

// Watcher

gulp.task('watch', function() {
    //watch changes above tests

    gulp.watch([
        build.tpl.js,
        build.tpl.css
    ], function() {
        // rebuild watching tasks
        gulp.start('js', 'css', 'png');

    });
});

// Build js
gulp.task('js', function() {

    return gulp.src(build.tpl.js)
        .pipe(uglify(build.min.js, {
            outSourceMap: true
        }))
        .pipe(gulp.dest(build.destination.sources));
});

// Build png images
gulp.task('png', function() {

    return gulp.src(build.tpl.png)
        .pipe(gulp.dest(build.destination.sources));
});

// Build styles
gulp.task('css', function () {
    return gulp.src(build.tpl.css)
        .pipe(concat(build.min.css))
        .pipe(minify())
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(gulp.dest(build.destination.sources));
});