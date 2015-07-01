<?

$currentID=get_reply("select id from menu where link='$currentAddress'");
$currentName = get_reply("select name from menu where id='$currentID'");
$cid=$currentID;
while($cid) {
  $prevId = get_reply("select childrenOf from menu where id='$cid'");
  if($prevId) {
    $prevName[] = get_reply("select name from menu where id='$prevId'");
  }
  $cid = $prevId;
}

if(count($prevName)==0) {
  $prevName[]="Welcome Message";
}

if($currentName=='Home') {
  $currentName = "News";
}

$this->sectionSubName = $currentName;
krsort($prevName);
$this->sectionName = implode(" -> ",$prevName);

$this->content=str_replace("//","/",str_replace("../","/",get_reply("select data from pageData where id='$currentID'")));

if($currentID==1) {
  $sql = new sql;
  
  // School News
  $newsElement[] = "<h3>School News</h3>";
  $sql->query("select title,link,time from newsList where sectionID='1610' order by id DESC limit 3");
  while($sql->row()) {
    $date = date("d M",$sql->col('time'));
    $title = $sql->col('title');
    $link = $sql->col('link');
    $newsElement[] = "<article><a href='/$link'><div class='newsDate'>$date</div><div class='newsTitle'>$title</div><div class='clear'></div></a></article>";
  }

  $newsElement[] = "<h3>Honour Board</h3>";
  $sql->query("select title,link,time from newsList where sectionID='1630' order by id DESC limit 3");
  while($sql->row()) {
    $date = date("d M",$sql->col('time'));
    $title = $sql->col('title');
    $link = $sql->col('link');
    $newsElement[] = "<article><a href='/$link'><div class='newsDate'>$date</div><div class='newsTitle'>$title</div><div class='clear'></div></a></article>";
  }

  
  $news = implode("<div class='seperator'></div>",$newsElement);

  $this->content = "<div class='home'>{$this->content}</div>";
  $this->content.="<div class='right'>$news</div>";

  $x=0;
  $sql->query("select id from pageImages where contentID='$currentID'");
  while($sql->row()) {
    $image=$sql->col('id');
    $hoverIm = isset($hover[$x]) ? $hover[$x] : "";
    $images[]="<li>$hoverIm<img src='/HeaderImages/$image.jpg' /></li>";
    $x++;
  } 
  
  $this->sliderImages = "<div class='shadow'>
      <div class='scrollingImages shadow'>
        <ul class='scrolling'>
          ".implode("\n",$images)."
        </ul>                 
      </div>
    </div>";
  /*  
  $moreContent[] = "<div class='dividerLine'></div>"; 
  $moreContent[] = "<div class='dividedContent'><h4>We Aim To Inspire, Challange and Enourage</h4><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<div class='noImage'></div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>"; 
  $moreContent[] = "<div class='dividerLine'></div>"; 
  $moreContent[] = "<div class='dividedContent'><h4>We Aim To Inspire, Challange and Enourage</h4><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <div class='noImage'></div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>"; 
  $moreContent[] = "<div class='dividerLine'></div>"; 
  $moreContent[] = "<div class='dividedContent'><h4>We Aim To Inspire, Challange and Enourage</h4><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<div class='noImage'></div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>"; 
  $moreContent[] = "<div class='dividerLine'></div>"; 
  $this->moreContent = implode("",$moreContent);
  */  
} else {
  $sql = new sql;
  $sql->query("select id from pageImages where contentID='$currentID'");
  $images = Array();
  $active = "class='active'"; 
  while($sql->row()) {
    $image=$sql->col('id');
    $images[]="<img src='/HeaderImages/$image.jpg' $active />";
    unset($active);
  } 
  if(count($images)>0) {
    $this->sliderImages = "<div class='headerIm shadow'>
            ".implode("\n",$images)."
      </div>";
  }
}

$this->footerContent = "
        <div class='logo'></div>
        <div class='footerText'><h1>I aim to Inspire, Challange and Encourage</h1></div>
      <div class='clear'></div>
      <br /><br />
";

?>