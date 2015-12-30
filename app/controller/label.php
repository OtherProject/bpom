<?php


class label extends Controller {
	
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

    
  	return $this->loadView('label/label');
  }
	
  function pengawasan(){

    global $CONFIG, $basedomain;

    
    return $this->loadView('label/pengawasan');
  }
	
  function galeri(){

    global $CONFIG, $basedomain;

    
    return $this->loadView('label/galeri');
  }
}

?>
