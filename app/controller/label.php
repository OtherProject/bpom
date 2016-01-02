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

    $jenis = _g('req');
    $merek['table'] = 'bpom_news_content';
    $merek['condition'] = array('n_status'=>1, 'categoryid'=>3, 'jenis'=>$jenis);
    $getData = $this->contentHelper->fetchDatas($merek);
    // pr($getData);
    if ($getData){

      $this->view->assign('merek',$getData);
    }
    return $this->loadView('label/galeri-jenis');
  }
  
  function galleryjenisD(){

    global $CONFIG, $basedomain;

    
    return $this->loadView('label/galeri-jenis-detail');
  }
  
  function gallerymerek(){

    global $CONFIG, $basedomain;
    
    // pr($getData);


    if (isset($_POST['submit'])){
      $merek['req'] = _p('merek');
      $getData = $this->contentHelper->searchMerek($merek);
    }else{
      $merek['table'] = 'bpom_news_content';
      $merek['condition'] = array('n_status'=>1, 'categoryid'=>3);
      $getData = $this->contentHelper->fetchDatas($merek);
    }

    if ($getData){

      $this->view->assign('merek',$getData);
    }
    
    return $this->loadView('label/galeri-merek');
  }
   function galleryDetail(){

    global $CONFIG, $basedomain;

    $otherid = _g('id');
    $merek['table'] = 'bpom_news_content_repo';
    $merek['condition'] = array('n_status'=>1, 'otherid'=>$otherid);
    $getData = $this->contentHelper->fetchDatas($merek);
    // pr($getData);
    if ($getData){

      $merekContent['table'] = 'bpom_news_content';
      $merekContent['condition'] = array('n_status'=>1, 'id'=>$otherid);
      $getDataAlbum = $this->contentHelper->fetchDatas($merekContent);
      if ($getDataAlbum){

        $unserial = unserialize($getDataAlbum[0]['tags']);
        $this->view->assign('album',$unserial);
        $this->view->assign('master',$getDataAlbum[0]);
      }
      $this->view->assign('merek',$getData);
    }
    // pr($unserial);
      
    return $this->loadView('label/galeri-merek-detail');
  }
}

?>
