<?
$contentID = get_reply("select id from menu where link='{$location->addr}'");
function rcd($data) {
  $p = strpos($data, ',');
  $d = substr($data, $p+1);
  return $d;
}

if(isPOST) {
  if($_POST['save']) {
    $sql = new sql;
    $link = $this->createLink($_POST['title']);
    $content = addslashes($_POST['newsContent']);
    if($_POST['id']) {
      $query = "update newsList set text = '$content', title = '".strip_tags($_POST['title'])."', link='$link' where id='{$_POST['id']}'"; 
    } else {
      $time = time(); 
      $query = "insert into newsList values(NULL,'".strip_tags($_POST['title'])."','{$_POST['newsContent']}','$link',$contentID,$time)"; 
    }
    $sql->query($query);
    $this->variables['message'] = "News Item saved";
    $this->variables['messageType'] = "showSuccessToast";
    $this->variables['callback'] = "$('#content').animate({opacity:0},function() { $().loadContent('{$location->addr}'); });";
    $this->variables['result'] = "success";
  } elseif($_POST['removeItem']) {
    if(isset($_GET['removeTitle'])) {
      $sql = new sql;
      settype($_GET['removeTitle'],'int');
      $sql->query("delete from newsList where id='{$_GET['removeTitle']}'");
      $this->variables['message'] = "News Item removed";
      $this->variables['messageType'] = "showSuccessToast";
      $this->variables['callback'] = "$('#content').animate({opacity:0},function() { $().loadContent('{$location->addr}'); });";
      $this->variables['result'] = "success";
    }
  } elseif($_POST['removeHeader']) {
    $sql = new sql;
    settype($_POST['removeHeader'],"int");
    $sql->query("delete from pageImages where id='{$_POST['removeHeader']}'");
    $this->variables['message'] = "Header Image removed";
    $this->variables['messageType'] = "showSuccessToast";
    $this->variables['callback'] = "$('.img{$_POST['removeHeader']}').parent().remove()";
    $this->variables['result'] = "success";
  } elseif(count($_FILES)>0) {
    if($_FILES['HeaderImages']['tmp_name']!='') {
      $file = file_get_contents($_FILES['HeaderImages']['tmp_name']);  
      $id=get_reply("insert into pageImages values(NULL,'".rcd($file)."','1',$contentID);select last_insert_id() from pageImages");
      $this->variables['message'] = "Header Image saved";
      $this->variables['messageType'] = "showSuccessToast";
      $this->variables['callback'] = "$().appendImage($id,'HeaderImages')";
      $this->variables['result'] = "success";
      unset($this->variables['menuItems']);
      unset($this->variables['menu']);
      unset($this->variables['content']);
    } elseif($_FILES['SchoolPictures']['tmp_name']!='') {
      $file = file_get_contents($_FILES['SchoolPictures']['tmp_name']);  
      $id=get_reply("insert into schoolPictures values(NULL,'".rcd($file)."','1',$contentID);select last_insert_id() from pageImages");
      $this->variables['message'] = "School picture saved";
      $this->variables['messageType'] = "showSuccessToast";
      $this->variables['callback'] = "$().appendImage($id,'SchoolPictures')";
      $this->variables['result'] = "success";
      unset($this->variables['menuItems']);
      unset($this->variables['menu']);
      unset($this->variables['content']);
    }
  }
} else {
  $sql = new sql;
  $this->variables['dis']="";
  $this->variables['action'] = "/cms/".$location->addr;
  $this->variables['section'] = $location->section;
  $this->variables['pageTitle'] = get_reply("select name from menu where id='$contentID'");
  if(!isset($_GET['addNew']) && !isset($_GET['editTitle'])) {
    $sql->query("select id,title,text from newsList where sectionID='$contentID'");
    while($sql->row()) {
      $this->variables['id'] = $sql->col('id');
      $this->variables['title'] = $sql->col('title');
      $this->variables['text'] = substr(strip_tags($sql->col('text')), 0, 100);
      $this->load('contentListItem','content');
      $listItems[] = $this->variables['content'];
    }
    $this->variables['listContent']=implode("\n",$listItems);
    $this->variables['newsTitleArrow']="";
    $this->variables['comment'] = "(shown here is smaller size), size should be 700x233 or 3:1 aspect ratio";
    $sql->query("select id,image from pageImages where contentID='$contentID' order by id ASC");
    $imageContent=Array();
    while($sql->row()) {
      $imageContent[] = "<div style='float:left;height: 140px;width: 240px;text-align:center;'><img src='/HeaderImages/{$sql->col('id')}.jpg' class='img{$sql->col('id')}' style='max-height:100px;'/><a href='{$this->variables['action']}' data-remove='{$sql->col('id')}' class='btn btn-danger btn-remove'>Remove</a></div>";
    }  
    if(count($imageContent)>0) {
      $this->variables['imageContent'] = implode("\n",$imageContent);
    } else {
      $this->variables['imageContent']="";
    }  
    $this->load('contentList', 'currentContent');
  } else {
    if(isset($_GET['editTitle']) && !empty($_GET['editTitle'])) {
      $sql = new sql;
      settype($_GET['editTitle'],'int');
      $sql->query("select title,text from newsList where sectionID='$contentID' and id='{$_GET['editTitle']}'");
      $sql->row();
      $this->variables['newsTitle']=$sql->col('title');
      $this->variables['newsContent']=$sql->col('text');
      $this->variables['edit']="<input type='hidden' name='id' value='{$_GET['editTitle']}' />";
      $this->variables['newsTitleArrow']=" -> <strong>".$this->variables['newsTitle']."</strong>";
    } else {
      $this->variables['edit']="";
      $this->variables['newsTitle']="";
      $this->variables['newsTitleArrow']=" -> <strong>New</strong>";
      $this->variables['newsContent']="";
    }
    $this->variables['dis']="class='disabled'";
    $this->load('contentEditor','currentContent');      
  }
}


?>