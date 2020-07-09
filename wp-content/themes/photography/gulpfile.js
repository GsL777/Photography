var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('styles', function () {
    gulp.src('assets/sass/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./assets/css/'));
});

gulp.task('default', ['styles'], function () {
    gulp.watch('assets/sass/**/*.scss', ['styles']);
});