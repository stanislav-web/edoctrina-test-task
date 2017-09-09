var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');


gulp.task('scripts', function() {
    return gulp.src(['src/assets/js/*'])
        .pipe(concat('all.js'))
        .pipe(uglify())
        .pipe(gulp.dest('build/js'));
});

gulp.task('css', function() {
    return gulp.src(['src/assets/css/*'])
        .pipe(concat('all.css'))
        .pipe(gulp.dest('build/css'));
});

gulp.task('img', function() {
    gulp.src('src/img/*')
        .pipe(imagemin())
        .pipe(gulp.dest('build/img'))
});

gulp.task('default', [ 'scripts', 'img', 'css']);