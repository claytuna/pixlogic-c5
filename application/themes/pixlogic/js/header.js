var scrollPos;

$(document).ready(function(){
  var mainHeader = '#main-header';
  
  /*show/hide fixed menu*/
  $(window).scroll(function(){
    if($(window).scrollTop() > 90) {
      $(mainHeader).addClass('header--isFixed');
    } else {
      $(mainHeader).removeClass('header--isFixed');
    }
  });

  /*mobile menu toggle*/
  $('#main-nav-toggle').bind('click', function(e){
    e.preventDefault();
    if($(mainHeader).hasClass('header--isNavOpen')){
      $(mainHeader).removeClass('header--isNavOpen');
    } else {
      $(mainHeader).addClass('header--isNavOpen');
    }
  });
});
