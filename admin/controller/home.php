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
		if ($_POST['submit']){

			if ($_POST['n_status']) $_POST['n_status'] = 1;

			$save = $this->contentHelper->saveData($_POST,"_news_content");
		}
		return $this->loadView('home/add');
	}

	function addFoto()
	{
		if ($_POST['submit']){

			if ($_POST['n_status']) $_POST['n_status'] = 1;

			$save = $this->contentHelper->saveData($_POST,"_news_content");
		}
		return $this->loadView('home/add');
	}

	function slideshow()
	{

		$slideshow['table'] = 'bpom_news_content';
      	$slideshow['condition'] = array('n_status'=>1, 'categoryid'=>1);
      	$getData = $this->contentHelper->fetchData($slideshow);
		if ($getData){
			$this->view->assign('data',$getData);
		}

		return $this->loadView('home/slideshow');
	}
}

?>
