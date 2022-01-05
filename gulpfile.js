const {
  src,
  series,
  dest,
  parallel,
  watch
} = require('gulp');

const concat = require('gulp-concat');
const fileInclude = require('gulp-file-include');
const sass = require('gulp-sass');
const sourceMap = require('source-map');
const sourcemaps = require('gulp-sourcemaps');
const clean = require('gulp-clean');
const browserSync = require('browser-sync').create();
const reload = browserSync.reload; //browser的方法 更新後~

function moveImg() {
  return src('app/assets/img/**/*').pipe(dest('dist/assets/img/'));
}

function concatJSAndMove() {
  return src('app/assets/js/**/*.js').pipe(concat('all.js')).pipe(dest('dist/assets/js/'));
}

function moveJS() {
  return src('app/assets/js/**/*.*').pipe(dest('dist/assets/js/'));
}

function movePHP() {
  return src('app/assets/php/**/*.php').pipe(dest('dist/assets/php/'));
}

function moveBackendFiles() {
  return src('app/backend/**/*.php').pipe(dest('dist/backend'));
}

function moveUploadFiles() {
  return src('app/upload/**/*').pipe(dest('dist/upload'));
}

function commonStyle() {
  return src('app/assets/style/all.scss')
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: 'expanded', // nested巢狀  // compressed壓縮  //expanded 原本
      }).on('error', sass.logError)
    )
    .pipe(sourcemaps.write())
    .pipe(dest('dist/assets/css/'));
}

function pageStyle() {
  return src('app/assets/style/pages/*.scss')
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: 'nested',
      }).on('error', sass.logError)
    )
    .pipe(sourcemaps.write())
    .pipe(dest('dist/assets/css/pages/'));
}


function pluginStyle() {
  return src('app/assets/style/plugin/bootstrap.scss')
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: 'nested',
      }).on('error', sass.logError)
    )
    .pipe(sourcemaps.write())
    .pipe(dest('dist/assets/css/plugin/'));
}
exports.p = pluginStyle

function includeHTML() {
  return src('app/*.html')
    .pipe(
      fileInclude({
        prefix: '@@',
        basepath: '@file',
      })
    )
    .pipe(dest('dist/'));
}

function includePHP() {
  return src('app/backend/*')
    .pipe(
      fileInclude({
        prefix: '@@',
        basepath: '@file',
      })
    )
    .pipe(dest('dist/backend'));
}




function killDist() {
  return src('dist', {
    read: false,
    allowEmpty: true,
  }).pipe(
    clean({
      force: true,
    })
  );
}

exports.kill = killDist;

exports.u = series(killDist, parallel(moveImg, moveJS, movePHP, moveUploadFiles, moveBackendFiles, commonStyle, pageStyle, pluginStyle, includePHP, includeHTML));

exports.browser = function browsersync() {
  browserSync.init({
    // files: "**",
    // port: 3001,
    // notify: false, //禁用瀏覽器的通知元素
    // browser: "chrome",
    server: {
      baseDir: './dist', //跟目錄設定
      index: 'factory.html', //需更改成自己頁面的名稱
      injectChanges: false,
    },
  });
  //與browser同步
  watch(['app/assets/style/**/*.scss', '!app/assets/style/pages/*.scss'], commonStyle).on('change', reload);
  watch('app/assets/style/pages/*.scss', pageStyle).on('change', reload);
  watch('app/**/*.html', includeHTML).on('change', reload);
  watch('app/assets/img/**/*', moveImg).on('change', reload);
  watch('app/assets/js/**/*.*', moveJS).on('change', reload);
  watch('app/assets/php/**/*.php', movePHP).on('change', reload);
  watch('app/backend/**/*.php', moveBackendFiles).on('change', reload);
};

exports.w = function watchFiles() {
  watch(['app/assets/style/**/*.scss', '!app/assets/style/pages/*.scss'], commonStyle);
  watch('app/assets/style/pages/*.scss', pageStyle);
  watch('app/**/*.html', includeHTML);
  watch('app/assets/img/**/*', moveImg);
  watch('app/assets/js/**/*.js', moveJS);
  watch('app/assets/php/**/*.php', movePHP);
  watch('app/backend/**/*.php', moveBackendFiles);
};

//----package
// const cleanCSS = require('gulp-clean-css');
// const imagemin = require('gulp-imagemin');

// exports.img = function compressImg() {
//     return src('app/assets/img/**/*')
//         .pipe(imagemin())
//         .pipe(rename(function (path) {
//             path.basename += "-mini"
//         }))
//         .pipe(dest('images'))
// }