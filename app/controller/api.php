<?php


class api extends Controller {
	
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
    $this->loginHelper = $this->loadModel('loginHelper');
    $this->contentHelper = $this->loadModel('contentHelper');
	}
	function index(){

		global $CONFIG, $basedomain;

    $limit = array(0,1);
		$getData = $this->contentHelper->getArticle();
    if ($getData){
      foreach ($getData as $key => $value) {
        if ($value['posted_date']){
          $getData[$key]['changeDate'] = changeDate($value['posted_date']);
        }
        if ($value['content']){
          $getData[$key]['content'] = html_entity_decode($value['content']);
        }
        
      }

      foreach ($limit as $value) {
        $newData[] = $getData[$value];
      }
    }

    

    // pr($newData);
    $this->view->assign('data',$newData);	

  	return $this->loadView('home');
  }
	
	
  function getIndustri()
  {

    $getIndustri = $this->contentHelper->getIndustri();
    // pr($getIndustri);
    echo json_encode(array('status'=>1, 'data'=>$getIndustri));
    exit;
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

  function test()
  {
    $send = sendGlobalMail('ovan89@gmail.com','trinata.webmail@gmail.com','test');
    pr($send);
  }
}

?>
