var scrollPos;

$(document).ready(function(){
  console.log('scroll here!');
  $(window).scroll(function(){
    console.log($(window).scrollTop(), $(window).scrollTop() > 90);
    if($(window).scrollTop() > 90) {
      $('#main-header').addClass('header--isFixed');
    } else {
      $('#main-header').removeClass('header--isFixed');
    }
  });
});
