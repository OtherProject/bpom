<?php


class register extends Controller {
	
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
    $this->session = new Session();
    }
	
	function loadmodule()
	{
    $this->loginHelper = $this->loadModel('loginHelper');
    $this->contentHelper = $this->loadModel('contentHelper');
    $this->userHelper = $this->loadModel('userHelper');
	}
	function index(){

		global $CONFIG, $basedomain;

		// $getData = $this->contentHelper->getArticle();
    // pr($getData);
    $this->view->assign('data',$getData);	

  	return $this->loadView('register');
  }
	
	function save()
  {

    global $basedomain;

    $token = str_shuffle(qwertyasdfgzxcvb123456789);
    $saveAccount = $this->userHelper->createAccount($_POST);
    if ($saveAccount){
      redirect($basedomain.'register/status/?token='.$token);
    }else{
      redirect($basedomain.'register/status/?token=');
    }
  }

  function status()
  {

    $token = _g('token');
    $this->view->assign('status',true);
    return $this->loadView('register-status');
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

	function validate()
  {

    global $basedomain;
        $data = _g('ref');
        
        // exit;
        logFile($data);
        if ($data){

            $coba = array('email'=>'o.pulu@yahoo.com', 'token'=>'1234');
            $enc = encode(serialize($coba));

            // pr($enc);
            
            $decode = unserialize(decode($data));
           
            // check if token is valid
            // pr($decode);

            $getToken = $this->loginHelper->getEmailToken($decode['email']);

            if ($getToken['email_token']==$decode['token']){
              
              redirect($basedomain.'register/accountValid/?ref='.$data);
            }else{
              pr('Token mismatch');
            }

        }
       
    }

    function accountValid()
    {
      
      global $basedomain;
        $token = _p('token');
        if ($token){
            
            $decode = unserialize(decode($token));
            $getToken = $this->loginHelper->getEmailToken($decode['email'],1);
            if ($getToken['email_token']==$decode['token']){


            }else{
              pr('Token Mismatch');
              exit;
            }

            // pr($_POST);
            $data['password'] = _p('password');
            $data['id'] = $getToken['id'];
            $data['email'] = $decode['email'];

            $updateAccount = $this->loginHelper->updateUserAccount($data);
            if ($updateAccount){
               
                logFile('account user '.$data['email']. ' created');

                $this->session->set_session($getToken);

                redirect($basedomain.'account');
                // $this->view->assign('validate','Validate account success');
                
            }else{
                
                logFile('update n_status user '.$data['email'].' failed');
            }
        }


        $ref = _g('ref');
        $decode = unserialize(decode($ref));
        if ($decode){
          $getToken = $this->loginHelper->getEmailToken($decode['email'],1);
          if ($getToken['email_token']==$decode['token']){

            if ($getToken['verified']>0){
              redirect($basedomain);
            }
            $getInd = $this->contentHelper->getIndustri($getToken['industri_id']);
            // pr($getInd);
            $this->view->assign('token',$ref);  
            $this->view->assign('data',$getInd[0]);  
          }
        }
        $this->view->assign('enterAccount',true);  
        return $this->loadView('register-validate');
    }
}

?>
