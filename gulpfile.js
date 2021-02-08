const {
    src,
    series,
    dest,
    parallel,
    watch,
} = require('gulp');


const concat = require('gulp-concat');
const fileInclude = require('gulp-file-include');
const cleanCSS = require('gulp-clean-css');
const sass = require('gulp-sass');
const sourceMap = require('source-map');
var sourcemaps = require('gulp-sourcemaps');



function moveImg() {
    return src('app/assets/img/**/*').pipe(dest('dist/assets/img/'));
}

function concatJSAndMove() {
    return src('app/assets/js/**/*.js').pipe(concat('all.js')).pipe(dest('dist/assets/js/'));
}


function commonStyle() {
    return src('app/assets/style/all.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: "expanded" // nested巢狀  // compressed壓縮  //expanded 原本
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest('dist/assets/css/'))
}

function pageStyle() {
    return src('app/assets/style/pages/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: "nested"
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest('dist/assets/css/pages/'))
}


function includeHTML() {
    return src('app/*.html')
        .pipe(fileInclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(dest('dist/'));
}


exports.w = function watchFiles() {
    watch(['app/assets/style/**/*.scss', '!app/assets/style/pages/*.scss'], commonStyle);
    watch('app/assets/style/pages/*.scss', pageStyle);
    watch('app/**/*.html', includeHTML);
    watch('app/assets/img/**/*', moveImg);
    watch('app/assets/js/**/*.js', concatJSAndMove);
}

// 壓縮js

const uglify = require('gulp-uglify');

exports.minjs = function uglifyjs(){
    return src('dev/js/*.js')
    .pipe(uglify())
    .pipe(dest('js'))
}
