$(document).ready(function(){
  onResize();
  $(window).resize(function() { onResize(); } );
  $().enableScrollingImages();
  $().enableCrossFade();
  topLocation = $('.popout .nav').offset().top;
  leftPosition = $('.popout .nav').offset().left-100; 
  $(window).scroll(function(){
    scrollLocation=$(this).scrollTop();
    if(scrollLocation>topLocation) {
      $('.popout').css({left: leftPosition}).addClass("floating");
    } else {
      $('.popout').css({left: "0px"}).removeClass("floating");
    }    
  });
});

function onResize() {
  h = $(window).height()-112;
  h = ($('.scrollingImages').length>0 ? h-500 : h);
  $("section#content").css("min-height",h);
}