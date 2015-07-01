<?
$currentID=get_reply("select id from menu where link='$currentAddress'");

$content = Array();
$sql = new sql;
$sql2 = new sql;

//include getcwd()."/modules/sideMenu.php";

$this->content=get_reply("select data from pageData where id='$currentID'");
$images = Array();
$active = "class='active'";
$sql->query("select id from pageImages where contentID='$currentID'");
while($sql->row()) {
  $image=$sql->col('id');
  $images[]="<img src='/HeaderImages/$image.jpg' $active />";
  unset($active);
} 

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


if(count($images)>0) {
  $this->sliderImages = "<div class='headerIm shadow'>".implode("\n",$images)."</div>";
} else {
  $this->sliderImages = '';
}
if(!$openSub) {
  $sql->query("select title,text,link from newsList where sectionID='$currentID' order by id DESC");
  while($sql->row()) {
    preg_match("/\<img[^\>].*src=[\'\"]([^\"\']*)[\'\"]/",$sql->col('text'),$image);
    if($image[1]) { $image[1] = str_replace("../","/",$image[1]); $newsImage = "<img src='{$image[1]}' style='max-height: 100px;max-width:100px;' />"; } else { $newsImage = "<img src='/images/noImage.jpg' style='max-height: 100px;max-width:100px;' />";}
    $text = substr(strip_tags($sql->col('text')),0,200)."...";
    $content[] = "<div class='newsItem'>
    <h4>{$sql->col('title')}</h4>
    <div class='newsImage'>$newsImage</div><div class='newsContent'>$text <div class='readmore'><a href='/$currentAddress/{$sql->col('link')}'>Read more</a></div></div>
    <div style='clear:both;'></div>
  </div>"; 
  }
} else {
  $link = preg_replace("/[^a-zA-Z0-9_]/","",$openSub);
  $sql->query("select title, text from newsList where link='$link' and sectionID='$currentID' order by id DESC");
  $sql->row();
  $text = preg_replace("/\.\.\//","/",$sql->col('text'));
  $content[] = "
    <h3>{$sql->col('title')}</h3>
    $text
  ";
}
$this->content = implode("\n",$content);          