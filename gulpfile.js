const gulp = require('gulp');
const bs = require('browser-sync');
const wait = require('gulp-wait');

const sass = require('gulp-sass');

gulp.task('sass', () => {
    return gulp
        .src('./scss/main.scss')
        .pipe(wait(500))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./css'))
        .pipe(bs.stream());
});

gulp.task('bs', ['sass'], () => {
    bs.init({
        server: {
            baseDir: './'
        }
    });

    gulp.watch('./scss/**/*.scss', ['sass']);
    gulp.watch('./*.html').on('change', bs.reload);
});