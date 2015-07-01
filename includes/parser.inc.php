<?
$addre=$_GET['address'];
$currentAddress = preg_replace("/[^a-zA-Z0-9-_\/]/","",$addre);
include getcwd()."/includes/sql.inc.php";
@list($section,$subsection,$subsubSection,$contentID) = explode("/",$currentAddress);
$addr = explode("/",$currentAddress);
if($subsubSection && $section=='NewsAndEvents') {
  if($contentID) {
    $currentAddress = "$section/$subsection/$subsubSection";
    $openSub = $contentID;
  } else {
    if(get_reply("select id from menu where link='$section/$subsection/$subsubSection'")) {
      $currentAddress = "$section/$subsection/$subsubSection";
    } else {
      $currentAddress = "$section/$subsection";
      $openSub = $subsubSection;
    }
  }
}

if(!$section) {
  header("location:/Home");
  exit();
}

include getcwd()."/includes/modules.inc.php";

switch($section) {
  case (get_reply("select link from menu where link='$currentAddress'")==$currentAddress ? $section : !$section):
    $module = get_reply("select module from menu where link='$currentAddress'");
    $modules->exec("menu");
    $modules->exec($module);  
    if($section=='Home') {
      $contentClass="mainWindow";
    } else {
      $wrapper1="<div class='wrapper'>";
      $wrapper2="</div>";
      $contentClass="pageWindow";
    }    
  break; 
  
  case "file":
    settype($subsection,"int");
    if($subsection) {
      $sql = new sql;
      $sql->query("select name,file from files where id='$subsection'");
      $sql->row();
      $name = $sql->col("name");
      $file = base64_decode($sql->col("file"));
      //$size = strlen($file);
      header("Content-Type:application/octet-stream");
      header('Content-Disposition: attachment; filename="' . $fileName . '"');
      echo $file;
      exit();
    } else {
      echo "aaaa";
    }
  break;
  
  case "HeaderImages":
  case "SchoolPictures":
  case "menuImage":
    $mime['JPEG'] = "image/jpeg";
    $mime['GIF'] = "image/gif";
    $mime['PNG'] = "image/png";
    $image = explode(".",$subsection);
    $tables=Array("HeaderImages" => "pageImages", "menuImage" => "pageImages","SchoolPictures" => "schoolPictures");
    $table = $tables[$section];
    $image = base64_decode(get_reply("select image from $table where id='{$image[0]}'"));
    $image_buffer = $image;
    $fileinfo = finfo_open();
    $mimet = finfo_buffer($fileinfo, $image_buffer);
    preg_match("/(JPEG|PNG|GIF)/i",$mimet,$mimetpye);
    header("Content-Type: ".$mime[strtoupper($mimetype)]);
    echo $image;
    exit();
  break;   
    
  default:
    ob_start();
      readfile(getcwd()."/templates/404");
    $content = ob_get_clean();
  break;
}
?>