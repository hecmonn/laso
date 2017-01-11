///////REQUIRES/////
////////////////////
var gulp=require('gulp'),
    compass=require('gulp-compass'),
    gutil=require('gulp-util');

var sassSource='components/sass/*.sass';
///////TASKS////////
////////////////////
gulp.task('testing',function(){
     console.log('hey from gulp');
});

gulp.task('compass',function(){
    gulp.src(sassSource)
    .pipe(compass({
        sass:'components/sass',
        images:'builds/development/assets/images',
        style:'expanded'
    }))
    .on('error',gutil.log)
    .pipe(gulp.dest('builds/development/public/css'));
});

/////WATCH////////
//////////////////
gulp.task('watch',function(){
    gulp.watch(sassSource,['compass']);
});

///DEFAULT///////
/////////////////
gulp.task('default',['compass']);
