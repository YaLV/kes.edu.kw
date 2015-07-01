<?
if(isset($_GET['new'])) {
  include getcwd()."/index_new.php";
  exit();
}

session_start();
include getcwd()."/includes/conf.inc.php";
$extraClass=($subsection ? "hasMenu" : "");
?>
<!DOCTYPE html>  
<html lang="eng">  
  <head>  
    <meta charset="utf-8" />  
  	<title>Kuwait English school</title>
 	<meta name="author" content="Ya" />
	<base href='/' />
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/style.css" rel="stylesheet" media="screen">
    <link href='/css/scrollbar.css'>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src='/js/maps.js'></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/functions.js"></script>
    <script src='/js/scrollbar.js'></script>
    <script src="/js/main.js"></script>
    <!-- AddThis Smart Layers BEGIN -->
    <!-- Go to http://www.addthis.com/get/smart-layers to customize -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-524016de0c9daea1"></script>
    <script type="text/javascript">
      addthis.layers({
        'theme' : 'transparent',
        'share' : {
          'position' : 'left',
          'numPreferredServices' : 5   
        },   
      });
      var checkInterval = setInterval(function() {
        if($('#at4-share').length>0) {
          clearInterval(checkInterval);
          $().addVLE();          
        }
      },100);
    </script>
    <!-- AddThis Smart Layers END -->    
  	<!--[if IE]>  
  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link href="/css/style-ie.css" rel="stylesheet" media="screen">
  	<![endif]-->  
  </head>  
  <body>
    <section id='header'>

      <div class='header'>
        <a href='/' class='logo'>&nbsp;</a>
        <div class='topline'>
          <div class='productName'>Kuwait English School</div>
          <div class='search'>
            <form method='post'>
              <input type='text' />
              <button class='search'></button>
            </form>
          </div>
        </div>
        <div class='nav navbar popout'>
          <ul class='nav popout'>
            <?=$modules->menu;?>
          </ul>
        </div>
        <div class='clear'></div>
      </div>
      <?=$modules->sliderImages;?>      
    </section>                               
    <section id='content' class='<?=$contentClass;?>'>
      <?=$wrapper1;?>
      <?=$modules->menuItems;?>
      <div class='content <?=$extraClass;?>'>
        <?=$modules->headerImages;?> 
        <?=$modules->content;?>
        <!--iframe frameborder=0 style='width:100%;height:500px;' src='http://www.zeemaps.com/pub?group=678592'> </iframe-->
      <?=$wrapper2;?>
      <div style='clear:both'></div>
      </div>
    </section> 
  </body>
</html>    