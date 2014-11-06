<?php


class account extends Controller {
	
	var $models = FALSE;
	var $view;

	
	function __construct()
	{
		global $basedomain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$this->view->assign('basedomain',$basedomain);
    $userdata = $this->isUserOnline();
    $this->user = $userdata['default'];
    $browsertype = $this->checkBrowser();
    $this->view->assign('browsertype',$browsertype);

    }
	
	function loadmodule()
	{
    $this->userHelper = $this->loadModel('userHelper');
    $this->contentHelper = $this->loadModel('contentHelper');
	}
	
  function index(){

		global $CONFIG, $basedomain;

   
		
    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);
    $this->view->assign('user',$this->user);	
    $this->view->assign('data',$getIndustri[0]);  

     // pr($getIndustri);
  	return $this->loadView('account');
  }
	
	function industri(){

    global $CONFIG, $basedomain;

   
    
    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);

    $getProv = $this->contentHelper->getLokasi();
    // pr($getIndustri);
    $this->view->assign('user',$this->user);  
    $this->view->assign('data',$getIndustri[0]);  
    $this->view->assign('lokasi',$getProv); 

     // pr($getIndustri);
    return $this->loadView('account-industri');
  }

  function pabrik()
  {

    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);
    $this->view->assign('datapabrik',$getIndustri[0]); 
    // pr($getIndustri);
    return $this->loadView('account-pabrik');
  }

  function ajax()
  {

    $id = _p('kode_wilayah');
    $getKab = $this->contentHelper->getKab($id);
    if ($getKab){
      print json_encode(array('status'=>true, 'res'=>$getKab));
    }else{
      print json_encode(array('status'=>false));
    }
    
    exit;
  }

  function formRegister()
  {
    global $basedomain;
   
   if(!$this->user) {redirect($basedomain."home/connect");exit;} 
    $getUserInfo = $this->loginHelper->getUserInfo();
    if ($getUserInfo['verified']>0){
      redirect($basedomain.'uploadfoto/pilihframe');
    }

    $this->view->assign('user',$this->user);
    return $this->loadView('form');
  }

  function inputForm()
  {

    global $basedomain;

    $inputData=$this->contentHelper->registerUser($_POST); 
    if ($inputData)redirect($basedomain.'uploadfoto/pilihframe');

  }

  function postToSocmed()
  {
    FacebookSession::setDefaultApplication($CONFIG['fb']['appId'], $CONFIG['fb']['secret']);
        $helper = new FacebookRedirectLoginHelper($basedomain.'home/index/?get=true');
        $session = false;
        if(isset($_GET['get'])){
          $session = $helper->getSessionFromRedirect();
          
          /* Buat posting message */
          
          // $post = (new FacebookRequest(
         //      $session, 'POST', '/me/feed',array ('message' => 'This is a test message from bot',)
         //    ))->execute()->getGraphObject();


          $album = (new FacebookRequest(
                      $session,'GET','/me/albums'
                    ))->execute()->getGraphObject();
             
            
            // pr($album);
        }else{
          $loginUrl = $helper->getLoginUrl(array('scope' => 'user_photos,publish_actions',)); 
      $this->view->assign('accessUrlFb',$loginUrl);
        }
        

        // pr($post);
        

  }

	function loginSocmed()
  {

    global $CONFIG, $basedomain;

    
  }
  function thanks(){
    return $this->loadView('thanks');

  }

  function privacy(){
     return $this->loadView('privacy');

  }

  function debuging()
  {
    $email = _g('email');
    if ($email==""){print(json_encode(false));exit;}
    $debug = $this->loginHelper->debuging($email);
    if($debug){
      print(json_encode(true));
    }else{
      print(json_encode(false));
    }

    exit;
  }
}

?>
