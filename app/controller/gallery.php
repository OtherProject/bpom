<?php


class gallery extends Controller {
	
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

		// $getData = $this->contentHelper->getArticle();
    // pr($getData);
    $this->view->assign('data',$getData);	

  	return $this->loadView('gallery/gallery');
  }
  function detail(){

    global $CONFIG, $basedomain;

    // $getData = $this->contentHelper->getArticle();
    // pr($getData);
    $this->view->assign('data',$getData); 

    return $this->loadView('gallery/detail-gallery');
  }
	
	
}

?>
