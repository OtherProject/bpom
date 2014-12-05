<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

class pelaporan extends Controller {
	
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
		
		$this->contentHelper = $this->loadModel('contentHelper');
	}
	
	public function index(){
		
		$data = $this->contentHelper->getDataEvaluasi();
		// pr($data);
		if ($data){
			
			$this->view->assign('data',$data);
		}
		
		if ($_POST['status']){

			if (count($_POST['ids']>0)){

				$id = implode(',', $_POST['ids']);

				$status = intval($_POST['status']);
				$approve = $this->contentHelper->validateData($id, $status);
				if ($approve){
					echo "<script>window.location.href='".$basedomain."evaluasi'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}
			
		}
		
		// pr($data);exit;
		

		return $this->loadView('pelaporan');

	}

	function ajaxGetLokasiPabrik()
  	{

	    $getIndustri = _p('idIndustri');
	    $getPabrik = $this->contentHelper->getPabrik(false,$getIndustri);
	    if ($getPabrik){

	        foreach ($getPabrik as $key => $value) {
	          $tmp = $this->contentHelper->getKab($value['provinsi']);
	          $getPabrik[$key]['alamatPabrik'] = $tmp[0];
	          $tmpKab = $this->contentHelper->getKab($value['provinsi']);
	          $getPabrik[$key]['getCurrentKab'] = $tmpKab[0];
	          $tmpProv = $this->contentHelper->getLokasi($tmpKab[0]['parent']);
	          $getPabrik[$key]['getCurrentProv'] = $tmpProv[0];
	        }

	        if ($getPabrik){
	          print( json_encode(array('status'=>true, 'res'=>$getPabrik)));
	        }else{
	          print( json_encode(array('status'=>false)));
	        }
	        
	        exit;
	        // $this->view->assign('listpabrik',$getPabrik);  
	    }
	 }

	function addKemasan()
	{

		$getIndustri = $this->contentHelper->getIndustri(false);
		// pr($getIndustri);
	    $this->view->assign('listindustri',$getIndustri); 
		return $this->loadView('pelaporan/pelaporan-kemasan-add');
	}

	function kemasan()
	{

		// pr($this->admin);
		if ($this->admin['admin']['type']==1) $dataArr['n_status'] = '1,2,3';
		if ($this->admin['admin']['type']==2) $dataArr['n_status'] = '2';
		if ($this->admin['admin']['type']==3) $dataArr['n_status'] = '1';

		$data = $this->contentHelper->getLaporanKemasanList($dataArr);
		// pr($data);
		if ($data){
			
			$this->view->assign('data',$data);
		}
		
		if ($_POST['status']){

			if (count($_POST['ids']>0)){

				$id = implode(',', $_POST['ids']);

				$status = intval($_POST['status']);
				$approve = $this->contentHelper->validateData($id, $status);
				if ($approve){
					echo "<script>window.location.href='".$basedomain."evaluasi'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}
			
		}
		
		// pr($data);exit;
		
		$this->view->assign('admin',$this->admin['admin']);

		return $this->loadView('pelaporan/pelaporan-kemasan');    
	}

	function nikotin()
	{

		if ($this->admin['admin']['type']==1) $dataArr['n_status'] = '1,2,3';
		if ($this->admin['admin']['type']==2) $dataArr['n_status'] = '2';
		if ($this->admin['admin']['type']==3) $dataArr['n_status'] = '1';
		$data = $this->contentHelper->getLaporanNikotin($dataArr);
		// pr($data);
		if ($data){
			
			$this->view->assign('data',$data);
		}
		
		if ($_POST['status']){

			if (count($_POST['ids']>0)){

				$id = implode(',', $_POST['ids']);

				$status = intval($_POST['status']);
				$approve = $this->contentHelper->validateData($id, $status);
				if ($approve){
					echo "<script>window.location.href='".$basedomain."evaluasi'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}
			
		}
		
		// pr($data);exit;
		

		return $this->loadView('pelaporan/pelaporan-nikotin');    
	}


	function detailkemasan()
	{
		global $basedomain;

		$id = _g('id');

		$dataArr['id'] = $id;
		if ($this->admin['admin']['type']==1) $dataArr['n_status'] = '1,2,3';
		if ($this->admin['admin']['type']==2) $dataArr['n_status'] = '2';
		if ($this->admin['admin']['type']==3) $dataArr['n_status'] = '1';

		if (isset($_GET['view'])){
			if ($this->admin['admin']['type']==2) $dataArr['n_status'] = '3';
			if ($this->admin['admin']['type']==3) $dataArr['n_status'] = '2';

			$this->view->assign('disableData',true);
		}

		$tulisanPeringatan = array(1 => 'Merokok Membunuhmu',
									2 => 'Merokok dekat anak berbahayan bagi mereka',
									3 => 'Merokok sebabkan kanker mulut',
									);
		$bentukKemasan = array(1 => 'Kotak persegi panjang',
								2 => 'Kotak slop',
								3 => 'Slinder'
								);
		$isiKemasan = array(1 => '10 bks/slop',
							2 => '10 btg/bks',
							2 => '10 slider/slop',
							2 => '12 btg/bks',
							2 => '50 btg/slinder',
							);
		$jenisRokok = array(1 => 'SKT',
							2 => 'SKM',
							);
		
		$data = $this->contentHelper->getLaporanKemasan($dataArr);
		$getTUlisan = $this->contentHelper->getTulisanPeringatan(false);
		$this->view->assign('tulisan',$getTUlisan);

		if ($data){
			foreach ($data as $key => $value) {
				$data[$key]['d_tulisanPeringatan'] = $tulisanPeringatan[$value['tulisanPeringatan']];
				$data[$key]['d_bentukKemasan'] = $bentukKemasan[$value['bentuKemasan']];
				$data[$key]['d_isiKemasan'] = $isiKemasan[$value['isi']];
				$data[$key]['d_jenisRokok'] = $jenisRokok[$value['jenis']];

				if ($this->admin['admin']['type']==2){
					$data[$key]['dataDisabled'] = 'disabled';
				}else{
					$data[$key]['dataDisabled'] = '';
				}
			}
			$this->view->assign('data',$data[0]);
		}
		// pr($data);
		$this->view->assign('id',$id);
		

		if (isset($_POST['idPelaporan'])){

			// pr($_POST);
			// exit;
			// $checkBoxCount = count($_POST['pelaporanKemasan']);
			// if ($checkBoxCount == 7){

				$dataArr['id'] = $_POST['idPelaporan'];

				if (isset($_POST['reject'])){
					if ($this->admin['admin']['type']==2) $_POST['n_status'] = '1';
				}else{
					if ($this->admin['admin']['type']==2) $_POST['n_status'] = '3';
					if ($this->admin['admin']['type']==3) $_POST['n_status'] = '2';
				}
				

				// $dataArr['n_status'] = 2;
				// $update = $this->contentHelper->updateStatusKemasan($dataArr);

				// pr($_POST);
				
				$update = $this->contentHelper->evaluasiKemasan($_POST);
				
				if ($update){
					echo "<script>window.location.href='".$basedomain."pelaporan/kemasan'</script>";
					// redirect($basedomain.'evaluasi');
				}
			// }
		}

		if (isset($_GET['id'])){
			
			if (isset($_GET['act'])){
				$dataArr['id'] = $_GET['id'];
				$dataArr['n_status'] = 0;
				$update = $this->contentHelper->updateStatusKemasan($dataArr);
				if ($update){
					echo "<script>window.location.href='".$basedomain."pelaporan/kemasan'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}

			
		
		}

		
		$slider = $this->loadView('pelaporan/slider');
		$this->view->assign('slider',$slider);

		$this->view->assign('admin',$this->admin['admin']);

		return $this->loadView('pelaporan/pelaporan-kemasan-detail');
	}

	function detailnikotin()
	{
		global $basedomain;

		$id = _g('id');

		$dataArr['id'] = $id;
		$dataArr['n_status'] = 1;

		$tulisanPeringatan = array(1 => 'Merokok Membunuhmu',
									2 => 'Merokok dekat anak berbahayan bagi mereka',
									3 => 'Merokok sebabkan kanker mulut',
									);
		$bentukKemasan = array(1 => 'Kotak persegi panjang',
								2 => 'Kotak slop',
								3 => 'Slinder'
								);
		$isiKemasan = array(1 => '10 bks/slop',
							2 => '10 btg/bks',
							2 => '10 slider/slop',
							2 => '12 btg/bks',
							2 => '50 btg/slinder',
							);
		$jenisRokok = array(1 => 'SKT',
							2 => 'SKM',
							);
		
		$data = $this->contentHelper->getLaporanNikotin($dataArr);
		

		if ($data){
			foreach ($data as $key => $value) {

				$data[$key]['namaProvinsi'] = $this->contentHelper->getLokasi($value['provinsi']);
				$data[$key]['d_tulisanPeringatan'] = $tulisanPeringatan[$value['tulisanPeringatan']];
				$data[$key]['d_bentukKemasan'] = $bentukKemasan[$value['bentuKemasan']];
				$data[$key]['d_isiKemasan'] = $isiKemasan[$value['isiKemasan']];
				$data[$key]['d_jenisRokok'] = $jenisRokok[$value['jenis']];
			}
			$this->view->assign('data',$data[0]);
		}
		// pr($data);
		$this->view->assign('id',$id);
		

		if (isset($_POST['idPelaporan'])){

			// pr($_POST);
			$checkBoxCount = count($_POST['pelaporanKemasan']);
			// if ($checkBoxCount == 14){

				$dataArr['id'] = $_POST['idPelaporan'];
				$dataArr['n_status'] = 2;
				$update = $this->contentHelper->updateStatusNikotin($dataArr);
				if ($update){
					echo "<script>window.location.href='".$basedomain."pelaporan/nikotin'</script>";
					// redirect($basedomain.'evaluasi');
				}
			// }
		}

		if (isset($_GET['id'])){
			
			if (isset($_GET['act'])){
				$dataArr['id'] = $_GET['id'];
				$dataArr['n_status'] = 0;
				$update = $this->contentHelper->updateStatusKemasan($dataArr);
				if ($update){
					echo "<script>window.location.href='".$basedomain."pelaporan/nikotin'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}

			
		
		}

		return $this->loadView('pelaporan/pelaporan-nikotin-detail');
	}

	public function iklanmlr(){
		
		$data = $this->contentHelper->getDataEvaluasi();
		// pr($data);
		if ($data){
			
			$this->view->assign('data',$data);
		}
		
		if ($_POST['status']){

			if (count($_POST['ids']>0)){

				$id = implode(',', $_POST['ids']);

				$status = intval($_POST['status']);
				$approve = $this->contentHelper->validateData($id, $status);
				if ($approve){
					echo "<script>window.location.href='".$basedomain."evaluasi'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}
			
		}
		
		// pr($data);exit;
		

		return $this->loadView('evaluasi');

	}


	public function iklantv(){
		
		$data = $this->contentHelper->getDataEvaluasi();
		// pr($data);
		if ($data){
			
			$this->view->assign('data',$data);
		}
		
		if ($_POST['status']){

			if (count($_POST['ids']>0)){

				$id = implode(',', $_POST['ids']);

				$status = intval($_POST['status']);
				$approve = $this->contentHelper->validateData($id, $status);
				if ($approve){
					echo "<script>window.location.href='".$basedomain."evaluasi'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}
			
		}
		
		// pr($data);exit;
		

		return $this->loadView('evaluasi');

	}

	public function iklanphw(){
		
		$data = $this->contentHelper->getDataEvaluasi();
		// pr($data);
		if ($data){
			
			$this->view->assign('data',$data);
		}
		
		if ($_POST['status']){

			if (count($_POST['ids']>0)){

				$id = implode(',', $_POST['ids']);

				$status = intval($_POST['status']);
				$approve = $this->contentHelper->validateData($id, $status);
				if ($approve){
					echo "<script>window.location.href='".$basedomain."evaluasi'</script>";
					// redirect($basedomain.'evaluasi');
				}
			}
			
		}
		
		// pr($data);exit;
		

		return $this->loadView('evaluasi');

	}

	public function detail(){

		global $basedomain;

		$id = _g('id');
		$data = $this->contentHelper->getDataEvaluasi($id);
		// pr($data);
		// $this->view->assign('data',$data[0]);
		$this->view->assign('id',$id);
		if ($_POST['id']){

			$update = $this->contentHelper->updateDataEvaluasi($_POST);
			if ($update){
				$this->view->assign('status',true);
			}else{
				$this->view->assign('status',false);
			}
		}


		if (isset($_GET['act'])){
			if (intval($_GET['act'])>0){


				$approve = $this->contentHelper->validateData($id,$_GET['act']);
				if ($approve){
					echo "<script>window.location.href='".$basedomain."evaluasi'</script>";
					// redirect($basedomain.'evaluasi');
				}else{
					$this->view->assign('status',false);
				}
			}
		}

		return $this->loadView('pelaporan-detail');
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
}

?>
