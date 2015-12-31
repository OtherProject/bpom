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

    $this->log('surf', 'list berita');
	$label['table'] = 'bpom_news_content';
    $label['condition'] = array('n_status'=>1, 'categoryid'=>0, 'articleType'=>14);
    $label['oderby'] = "id DESC";
    $getData = $this->contentHelper->fetchDatas($label);
    // pr($getData);
    if ($getData){
      foreach ($getData as $key => $value) {
        if ($value['posted_date']){
          $getData[$key]['changeDate'] = changeDate($value['posted_date']);
        }
        if ($value['content']){
          $getData[$key]['content'] = html_entity_decode($value['content']);
        }
        
      }
    }


    // pr($getData);
    $this->view->assign('data',$getData);	
    return $this->loadView('label/pengawasan');
  }

  function detailLabel(){

    global $CONFIG, $basedomain;

    $id = _g('id');
    $label['table'] = 'bpom_news_content';
    $label['condition'] = array('n_status'=>1, 'id'=>$id);
    $label['oderby'] = "id DESC";
    $label['limit'] = 4;
    $getData = $this->contentHelper->fetchDatas($label);

    $labelAll['table'] = 'bpom_news_content';
    $labelAll['condition'] = array('n_status'=>1, 'categoryid'=>0, 'articleType'=>14);
    $labelAll['limit'] = 4;
    $getDataAll = $this->contentHelper->fetchDatas($labelAll);
    // $getDataAll = $this->contentHelper->getArticle();
    // pr($getData);
    if ($getData){
      foreach ($getData as $key => $value) {
        if ($value['posted_date']){
          $getData[$key]['changeDate'] = changeDate($value['posted_date']);
        }
        if ($value['content']){
          $getData[$key]['content'] = html_entity_decode($value['content']);
        }
        
      }
    }

    $this->view->assign('data',$getData); 
    $this->view->assign('dataAll',$getDataAll); 

    return $this->loadView('label/detail-label');
  }

  function search()
  {

    $news['req'] = _p('req');
    $search = $this->contentHelper->searchNews($news, 14);
    $getData = $this->contentHelper->getArticle(false,0,14);
    // pr($getData);
    if ($search)$this->view->assign('news',$search);
    if ($getData)$this->view->assign('data',$getData);

    return $this->loadView('label/label-search');
  }

  function galeri(){

    global $CONFIG, $basedomain;

    
    return $this->loadView('label/galeri');
  }
  function galerijenis(){

    global $CONFIG, $basedomain;

    
    return $this->loadView('label/galeri-jenis');
  }
   function gallerymerek(){

    global $CONFIG, $basedomain;

    
    return $this->loadView('label/galeri-merek');
  }
   function gallerymerekD(){

    global $CONFIG, $basedomain;

    
    return $this->loadView('label/galeri-merek-detail');
  }
}

?>
