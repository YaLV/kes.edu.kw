<?

$pw = "$6$Qav/qugk$Ua8tubx6WkLo/J7NYSWk2hivs7tqRHzfDiVkPphJHfSJylxtHYZeY06hWSh2ubBzIJJ35yFiCmAeCidzU333F1";

class auth {
  
  public $user,$userString;
  private $loginData;
  
  public function __construct() {
    global $language,$templates,$location;
    if(isPOST && !isset($_SESSION['user']) && !$_SESSION['user']) {
      if(!empty($_POST['username']) && !empty($_POST['password'])) {
        if($this->userExists() && $this->passwordExists()) {
          $_SESSION['user']=$this->loginData['userID'];
          $templates->variables = $language->getMessage("successLogin");
          $templates->variables['callback'] = "loginSuccess()";
          $templates->variables['result'] = "success";
        } else {                             
          $templates->variables = $language->getMessage("wrongLogin");
          $templates->variables['result'] = "fail";
        }
      } else {
        $templates->variables = $language->getMessage("noLoginData");
        $templates->variables['result'] = "fail";
      }
    } else {
      if(!isset($_SESSION['user']) && !$_SESSION['user']) {
        $templates->load("login","content");
        $templates->variables['menu']="";
      } elseif($_SESSION['user']) {
        $this->createUserString();
      }
    }                              
  }
  
  private function userExists() {
    $this->loginData['userID']=1;
    if($_POST['username']=='Ya') {
     return true;
   } else {
	return false;
   }
  }
  
  private function passwordExists() {
    global $pw;
    if(crypt($_POST['password'],$pw)==$pw) { 
      return true;
    } else {
      return false;
    }
  }

  private function createUserString() {
    $this->userString="Logged in";
    $this->user = $_SESSION['user'];
  }
  
}


$auth = new auth;
?>
