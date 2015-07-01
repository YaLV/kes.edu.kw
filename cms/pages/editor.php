<?
$contentID = get_reply("select id from menu where link='{$location->addr}'");

function rcd($data) {
    $p = strpos($data, ',');
    $d = substr($data, $p+1);
    return $d;
}

if(isPOST) {
  $sql = new sql;
  if($_POST['saveContent']==1) {
    $content = addslashes($_POST['pageContent']);
    $sql->query("replace into pageData values($contentID, '$content')");
    $this->variables['message'] = "Page Content Saved";
    $this->variables['messageType'] = "showSuccessToast";
    $this->variables['callback'] = "$('#content').animate({opacity:1});";
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
  } elseif($_POST['removeHeader']) {
    settype($_POST['removeHeader'],"int");
    $tables=Array("HeaderImages" => "pageImages","SchoolPictures" => "schoolPictures");
    if(array_key_exists($_POST['tab'],$tables)) {
      $sql->query("delete from {$tables[$_POST['tab']]} where id='{$_POST['removeHeader']}'");
      $this->variables['message'] = $_POST['tab']=='HeaderImages' ? "Header Image removed" : "School picture removed";
      $this->variables['messageType'] = "showSuccessToast";
      $this->variables['callback'] = "$('.img{$_POST['removeHeader']}').parent().remove()";
      $this->variables['result'] = "success";
    } else {
      $this->variables['message'] = "Error, not enough data";
      $this->variables['messageType'] = "showErrorToast";
      $this->variables['result'] = "success";
    }
  } else {
    $this->variables['message'] = "No Job specified";
    $this->variables['messageType'] = "showErrorToast";
    $this->variables['callback'] = "$('#content').animate({opacity:1});";
    $this->variables['result'] = "fail";
  } 
} else {
  $this->variables['action'] = "/cms/".$location->addr;
  $this->variables['section'] = $location->section;
  $this->variables['pageTitle'] = get_reply("select name from menu where id='$contentID'");
  $this->variables['pageContent'] = get_reply("select data from pageData where id='$contentID'");
  if($location->section=='Home') {
    $this->variables['comment'] = "(shown here is smaller size), size should be 1100x500";
  } else {
    $this->variables['comment'] = "(shown here is smaller size), size should be 700x233 or 3:1 aspect ratio";
  }
  $sql = new sql;
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

  if($contentID==1) {
    $sql->query("select id,image from schoolPictures where contentID='$contentID' order by id ASC");
    $imageContent=Array();
    while($sql->row()) {
      $imageContent[] = "<div style='float:left;height: 140px;width: 240px;text-align:center;'><img src='/SchoolPictures/{$sql->col('id')}.jpg' class='img{$sql->col('id')}' style='max-height:100px;'/><a href='{$this->variables['action']}' data-remove='{$sql->col('id')}' class='btn btn-danger btn-remove'>Remove</a></div>";
    }  
    if(count($imageContent)>0) {
      $ims = implode("\n",$imageContent);
    } else {
      $ims="";
    }  
    $this->variables['extraTabs']="<li><a href='#SchoolPictures' data-toggle='tab'>School Pictures</a></li>";
    $this->variables['extraTabContent']="<div id='SchoolPictures' class='tab-pane'>
      <div style='float:left;'></div>
      <div style='float:right;'>Options <form method='post' id='uploadPic' action='{action}'><input type='file' /></form></div>
      <div style='clear:both' class='clear'></div>
      $ims
    </div>";
  } 
}
?>