<?

if($auth->user) {
  $templates->load("menu","menu");
  switch($location->section) {
  
    case ((!empty($location->section) && get_reply("select link from menu where link='".$location->addr."'")==$location->addr) ? $location->section: !$location->section):
      $module = get_reply("select module from menu where link='".$location->addr."'");
      $templates->exec($module);    
      $templates->load($module,"content");
    break;
  
    case "logout":
      session_destroy();
    break;
        
    case "login":
      $location->direct("");
    break;
    
    case "loadMenu":
      $templates->display("menu");
      echo $templates->output;
      exit(); 
    break;

    case "files":
      $templates->exec("fileUpload");
      $templates->display("fileUpload");
      echo $templates->output;
      exit();
    break;

    case "loadContent":
      $templates->variables['content']="<h2 style='text-align:center;'>Welcome to KES administration</h2>";
      $templates->display("content");
      echo $templates->output;
      exit(); 
    break;
    
    default:
      if($location->page=='uploadMenuItem') {
        $templates->exec("uploadMenuItem");
        $templates->load("uploadMenuItem","content");
      } else {   
        $templates->variables['content']="<h2 style='text-align:center;'>Welcome to KES administration</h2>";
        $templates->load("menu","menu");
        $templates->load("content","content");
      }     
    break;
  }
}


if((isXML && isPOST) || count($_FILES)>0) {
  $templates->displayJSON();
} elseif(isXML) {
  if($location->section!='login') {
    $templates->display("content");
    echo $templates->output;
  } else {
    echo $templates->variables['content'];
  }
} else {
  $templates->display("index");
  echo $templates->output;
}

?>