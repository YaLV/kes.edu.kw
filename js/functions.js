(function($) {
  $.fn.enableScrollingImages = function() {
    el = $('ul.scrolling');
    imageCount = el.children('li').length;
    el.width(imageCount*1100);
    currentImage = 1;
    movingForward=true;
    setInterval(function() {
      if(movingForward) {
        if(currentImage==imageCount) {
          movingForward=false;
          currentImage--;
        } else {
          currentImage++;
        }
      } else {
        if(currentImage==1) {
          movingForward=true;
          currentImage++;
        } else {
          currentImage--;
        }
      }      
      newPosition = (0-(currentImage*1100))+1100;
      $('ul.scrolling').animate({left:newPosition+"px"},2000,"easeInOutQuart"); // 
    },8000);
  }
  
  $.fn.enableCrossFade = function() {
    setInterval(function() {
      currentIm = $('div.headerIm img.active');
      nextIm = (typeof currentIm.next()[0]=='undefined' ? currentIm.parent().children('img:first-child') : currentIm.next());
      currentIm.removeClass('active');
      nextIm.addClass('active');
    },8000);
  }
  
  $.fn.addVLE = function() {
    $('#at4-share').prepend('<a class="at4-share-btn VLEBTN" href="#"><span class="aticon at15nc at15t_VLE" title="Virtual Learning Center"></span></a>').ready(function() {
      $('.at4-share-btn.VLEBTN').unbind().click(function(e) { window.open('http://www.kes.edu.kw/VLENew/'); e.preventDefault(); return false;});
    });
  }
  
})(jQuery);