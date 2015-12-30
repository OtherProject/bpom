<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class home extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();

		global $app_domain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$sessionAdmin = new Session;
		$this->admin = $sessionAdmin->get_session();
		// $this->validatePage();
		$this->view->assign('app_domain',$app_domain);
	}
	public function loadmodule()
	{
		
		$this->models = $this->loadModel('marticle');
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		$this->view->assign('active','active');
		$data = $this->models->get_article();

		if ($data){
			foreach ($data as $key => $val){

				$data[$key]['created_date'] = dateFormat($val['created_date'],'article');

				$data[$key]['posted_date'] = dateFormat($val['posted_date'],'article');

				if($val['n_status'] == '1') {
					$data[$key]['n_status'] = 'Publish';
					$data[$key]['status_color'] = 'green';
				} else {
					$data[$key]['n_status'] = 'Unpublish';
					$data[$key]['status_color'] = 'red'; 
				}
			}
		}
		
		// pr($_SESSION);exit;
		$this->view->assign('data',$data);

		return $this->loadView('home');

	}

	public function frame(){

		$data = $this->models->get_frameList();
		// pr($data);
		$this->view->assign('data',$data);

		return $this->loadView('listFrame');
	}
	
	function ajax()
	{
		
		$id = _p('id');
		$n_status = _p('n_status');
		
		$data = $this->models->updateStatusFrame($id, $n_status);
		if ($data){
			print json_encode(array('status'=>true));
		}else{
			print json_encode(array('status'=>false));
		}

		exit;
	}

	function add()
	{	

		global $basedomain;
		/*
		typealbum 1 = slideshow
		galerytype 1 = slideshow
		*/
		$type = _g('type');
		$idparent = _g('idparent');
		$id = _g('id');

		if ($type == 2){

			if ($id){
				$slideshow['table'] = 'bpom_news_content_repo';
		      	$slideshow['condition'] = array('n_status'=>1, 'id'=>$id);
		      	$getData = $this->contentHelper->fetchData($slideshow);
				if ($getData)$this->view->assign('album',$getData[0]);
				
			}

			$category['table'] = 'bpom_news_content';
	      	$category['condition'] = array('n_status'=>1, 'categoryid'=>'1,2');
	      	$category['in'] = array('categoryid');
	      	$getCategory = $this->contentHelper->fetchData($category);
			if ($getCategory)$this->view->assign('albumcat',$getCategory);
			
			$this->view->assign('typealbum',1);
			$this->view->assign('gallerytype',1);
		}else{
			$type = 1;

			// edit album 
			if ($id){
				$slideshow['table'] = 'bpom_news_content';
		      	$slideshow['condition'] = array('n_status'=>1, 'categoryid'=>1, 'id'=>$id);
		      	$getData = $this->contentHelper->fetchData($slideshow);
				if ($getData)$this->view->assign('album',$getData[0]);
				
			}
		}

		if ($_POST['submit']){

			if ($_POST['n_status']) $_POST['n_status'] = 1;

			if ($_FILES['file_image']['name']){
				$upload = uploadFile('file_image',null,'image');
				
			}
			
			$idparent = $_POST['otherid'];
			$type = _p('type');
			if ($type==2){
				if ($upload) $_POST['files'] = $upload['full_name'];
				$save = $this->contentHelper->saveData($_POST,"_news_content_repo");
				if ($save) redirect($basedomain . "home/addFoto/?idparent={$idparent}");
			}else{

				if ($upload) $_POST['image'] = $upload['full_name'];
				$save = $this->contentHelper->saveData($_POST,"_news_content");
				if ($save) redirect($basedomain . "home/slideshow");
			}
			

		}

		$this->view->assign('type', $type);
		$this->view->assign('idparent', $idparent);

		return $this->loadView('home/add');
	}

	function addMerek()
	{	

		global $basedomain;
		/*
		typealbum 1 = slideshow
		galerytype 1 = slideshow
		*/
		$type = _g('type');
		$idparent = _g('idparent');
		$id = _g('id');

		if ($type == 2){

			if ($id){
				$slideshow['table'] = 'bpom_news_content_repo';
		      	$slideshow['condition'] = array('n_status'=>1, 'id'=>$id);
		      	$getData = $this->contentHelper->fetchData($slideshow);
				if ($getData)$this->view->assign('album',$getData[0]);
				
			}

			$category['table'] = 'bpom_news_content';
	      	$category['condition'] = array('n_status'=>1, 'categoryid'=>1);
	      	$getCategory = $this->contentHelper->fetchData($category);
			if ($getCategory)$this->view->assign('albumcat',$getCategory);
			
			$this->view->assign('typealbum',1);
			$this->view->assign('gallerytype',1);
		}else{
			$type = 1;

			// edit album 
			if ($id){
				$slideshow['table'] = 'bpom_news_content';
		      	$slideshow['condition'] = array('n_status'=>1, 'categoryid'=>1, 'id'=>$id);
		      	$getData = $this->contentHelper->fetchData($slideshow);
				if ($getData)$this->view->assign('album',$getData[0]);
				
			}
		}

		if ($_POST['submit']){

			if ($_POST['n_status']) $_POST['n_status'] = 1;

			if ($_FILES['file_image']['name']){
				$upload = uploadFile('file_image',null,'image');
				
			}
			
			$idparent = $_POST['otherid'];
			$type = _p('type');
			if ($type==2){
				if ($upload) $_POST['files'] = $upload['full_name'];
				$save = $this->contentHelper->saveData($_POST,"_news_content_repo");
				if ($save) redirect($basedomain . "home/addFoto/?idparent={$idparent}");
			}else{

				if ($upload) $_POST['image'] = $upload['full_name'];
				$save = $this->contentHelper->saveData($_POST,"_news_content");
				if ($save) redirect($basedomain . "home/merek");
			}
			

		}

		$this->view->assign('type', $type);
		$this->view->assign('idparent', $idparent);

		return $this->loadView('home/addMerek');
	}

	function addFoto()
	{
		$idparent = _g('idparent');
		$slideshow['table'] = 'bpom_news_content_repo';
      	$slideshow['condition'] = array('n_status'=>1, 'otherid'=>$idparent);
      	$getData = $this->contentHelper->fetchData($slideshow);
		// pr($getData);
		if ($getData){
			$this->view->assign('foto',$getData);
		}

		if ($_POST['submit']){

			if ($_POST['n_status']) $_POST['n_status'] = 1;

			$save = $this->contentHelper->saveData($_POST,"_news_content");
		}

		$this->view->assign('idparent', $idparent);
		return $this->loadView('home/listFoto');
	}

	function slideshow()
	{

		$slideshow['table'] = 'bpom_news_content';
      	$slideshow['condition'] = array('n_status'=>1, 'categoryid'=>'1,2');
      	$slideshow['in'] = array('categoryid');
      	$getData = $this->contentHelper->fetchData($slideshow);
		if ($getData){
			$this->view->assign('data',$getData);
		}

		return $this->loadView('home/slideshow');
	}

	function merek()
	{

		$slideshow['table'] = 'bpom_news_content';
      	$slideshow['condition'] = array('n_status'=>1, 'categoryid'=>3);
      	$getData = $this->contentHelper->fetchData($slideshow);
		if ($getData){
			$this->view->assign('data',$getData);
		}

		return $this->loadView('home/merek');
	}

	function delete()
	{

		global $basedomain;

		$id = _g('id');
		$req = _g('req');
		$idparent = _g('idparent');

		if ($req == 1) $link = 'home/slideshow';
		if ($req == 2) $link = "home/addFoto/?idparent={$idparent}";
		// else $link = 'struktur';

		$listTable = array('content'=>array(1), 'repo'=>array(2));
		if (in_array($req, $listTable['content'])) $table = "_news_content";
		else if (in_array($req, $listTable['repo'])) $table = "_news_content_repo";
		
		$data['id'] = $id;
		$data['n_status'] = 0;
		$save = $this->contentHelper->saveData($data,$table);
		if ($save){
			redirect($basedomain . $link);
		}
		
	}
}

?>
