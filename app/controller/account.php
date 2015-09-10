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

    if (!$this->isUserOnline()) {redirect($basedomain);exit;}
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
    $getUserData = $this->userHelper->getUserData();
    $this->view->assign('user',$getUserData);	
    $this->view->assign('data',$getIndustri[0]);  

    /*
    if (_p('submit')){
      $saveData = $this->userHelper->saveAccount();
      if ($saveData)redirect($basedomain . 'account');
    }*/
    return $this->loadView('account');
  }
	
  function profile()
  {
    global $basedomain;

    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);
    $getUserData = $this->userHelper->getUserData();
    $this->view->assign('user',$getUserData); 
    $this->view->assign('data',$getIndustri[0]);  

    if (_p('submit')){
      $saveData = $this->userHelper->saveAccount();
      if ($saveData)redirect($basedomain . 'account/industri');
    }
    return $this->loadView('account-profil');
  }

	function industri(){

    global $CONFIG, $basedomain;

   
    
    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);

    $getProv = $this->contentHelper->getLokasi();
    $this->view->assign('user',$this->user);  
    $this->view->assign('data',$getIndustri[0]);  
    $this->view->assign('lokasi',$getProv); 

    $getCurrentKab = $this->contentHelper->getKab($getIndustri[0]['provinsi']);
    $getCurrentProv = $this->contentHelper->getLokasi($getCurrentKab[0]['parent']);

    if ($getCurrentKab){
      $this->view->assign('kabupaten',$getCurrentKab[0]);  
      $this->view->assign('provinsi',$getCurrentProv[0]);  
    }
    
    if ($_POST){
    
      $saveData = $this->contentHelper->saveDataIndustri($_POST);
      if ($saveData) reload($basedomain.'account/preview');
    }
    return $this->loadView('account-industri');
  }

  function preview()
  {
    global $CONFIG, $basedomain;

   
    
    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);

    $getProv = $this->contentHelper->getLokasi();
    $this->view->assign('user',$this->user);  
    $this->view->assign('data',$getIndustri[0]);  
    $this->view->assign('lokasi',$getProv); 

    $getCurrentKab = $this->contentHelper->getKab($getIndustri[0]['provinsi']);
    $getCurrentProv = $this->contentHelper->getLokasi($getCurrentKab[0]['parent']);

    if ($getCurrentKab){
      $this->view->assign('kabupaten',$getCurrentKab[0]);  
      $this->view->assign('provinsi',$getCurrentProv[0]);  
    }
    
    return $this->loadView('account-industri-preview');
  }

  function pabrik()
  {

    global $basedomain;

    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);
    $this->view->assign('datapabrik',$getIndustri[0]); 
    $getPabrik = $this->contentHelper->getPabrik(false,$getIndustri[0]['id']);
    if ($getPabrik){

      foreach ($getPabrik as $key => $value) {
        $tmp = $this->contentHelper->getKab($value['provinsi']);
        $getPabrik[$key]['alamatPabrik'] = $tmp[0];
      }
      // pr($getPabrik);
      $this->view->assign('pabrik',$getPabrik);  
    }


    $getProv = $this->contentHelper->getLokasi();
    $this->view->assign('user',$this->user);  
    // $this->view->assign('data',$getIndustri[0]);  
    $this->view->assign('lokasi',$getProv); 

    if ($_POST){
      
      $_POST['indusrtiID'] = $getIndustri[0]['id'];
      $saveData = $this->contentHelper->saveDataPabrik($_POST);
      if ($saveData){

        if(!empty($_FILES)){
          if($_FILES['fileNPPBKC']['name'] != ''){
            $image = uploadFile('fileNPPBKC',null,'document');
            if ($image['status']){
              $image['id'] = $_POST['id'];
              $updateData = $this->contentHelper->updateDataPabrik($image);
              if ($updateData) reload($basedomain.'account/pabrik');
            }else{
              echo "<script>alert('File type not allowed');</script>";
              reload($basedomain.'account/pabrik');
            }
          }

        }

        reload($basedomain.'account/pabrik');
      }

    }

    $this->view->assign('id',0);  
    if (isset($_GET['id'])){

      $getIndustri = $this->contentHelper->getIndustri($id_industri);
      $this->view->assign('datapabrik',$getIndustri[0]); 
      $getPabrik = $this->contentHelper->getPabrik($_GET['id']);
      if ($getPabrik){

        foreach ($getPabrik as $key => $value) {
          $unserial = unserialize($value['data']);
          $getPabrik[$key]['origFile'] = $unserial['origFile'];

          $tmp = $this->contentHelper->getKab($value['provinsi']);
          $getPabrik[$key]['alamatPabrik'] = $tmp[0];
          $tmpKab = $this->contentHelper->getKab($value['provinsi']);
          $getPabrik[$key]['getCurrentKab'] = $tmpKab[0];
          $tmpProv = $this->contentHelper->getLokasi($tmpKab[0]['parent']);
          $getPabrik[$key]['getCurrentProv'] = $tmpProv[0];

          $getPabrik[$key]['nomor_NPPBKC'] = $tmpProv[0];
        }

        
        $this->view->assign('currentid',_g('id'));
        $this->view->assign('data',$getPabrik[0]);  
      }

      $this->view->assign('id',$_GET['id']);  
    }


    return $this->loadView('account-pabrik');
  }



  function pelaporan()
  {
    global $basedomain;
    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);

    $this->view->assign('listindustri',$getIndustri); 
    
    $getPelaporanKemasan = $this->contentHelper->getPelaporanKemasan(false,$getIndustri[0]['id']);
    $this->view->assign('laporankemasan',$getPelaporanKemasan); 

    $getPabrik = $this->contentHelper->getPabrik(false,$getIndustri[0]['id']);
    if ($getPabrik){

        foreach ($getPabrik as $key => $value) {
          $tmp = $this->contentHelper->getKab($value['provinsi']);
          $getPabrik[$key]['alamatPabrik'] = $tmp[0];
          $tmpKab = $this->contentHelper->getKab($value['provinsi']);
          $getPabrik[$key]['getCurrentKab'] = $tmpKab[0];
          $tmpProv = $this->contentHelper->getLokasi($tmpKab[0]['parent']);
          $getPabrik[$key]['getCurrentProv'] = $tmpProv[0];
        }

        
        // pr($getPabrik);
        $this->view->assign('listpabrik',$getPabrik);  
    }

    $getProduk = $this->contentHelper->getProduk();
    $this->view->assign('produk',$getProduk);  
    
    $getTUlisan = $this->contentHelper->getTulisanPeringatan(false);
    $this->view->assign('tulisan',$getTUlisan);

    if ($_POST){

      $saveData = $this->contentHelper->saveDataKemasan($_POST);
      if ($saveData){

        if(!empty($_FILES)){
          

            $foto = array('fotoDepan','fotoBelakang','fotoKanan','fotoKiri','fotoAtas','fotoBawah','suratPengantar');
            foreach ($foto as $key => $value) {

              if($_FILES[$value]['name'] != ''){
                $image = uploadFile($value,null,'image');
                if ($image){
                  $dataImage[$value] =  $image;
                }
              }
            }
          $dataImage['pabrikID'] = $_POST['pabrikID'];
          $updateData = $this->contentHelper->updateDataKemasan($dataImage);
          if ($updateData) reload($basedomain.'account/pelaporan');


        }
        reload($basedomain.'account/pelaporan');
      }
    }

    if (isset($_GET['id'])){

      $getPabrik = $this->contentHelper->getPabrik($id);
      if ($getPabrik){
        $getIndustri = $this->contentHelper->getIndustri($getPabrik[0]['indusrtiID']);
        

        $data['ind'] = $getIndustri[0];
        $data['pabrik'] = $getPabrik[0];
      }

      $id_industri = $this->user['industri_id'];
      $getIndustri = $this->contentHelper->getIndustri($id_industri);

      $getPelaporanKemasan = $this->contentHelper->getPelaporanKemasan($_GET['id']);
      $this->view->assign('laporankemasandetail',$getPelaporanKemasan[0]); 
    }

    return $this->loadView('account-pelaporan');
  }

  function pelaporan_nikotin()
  {

    global $basedomain;
    $id_industri = $this->user['industri_id'];
    $getIndustri = $this->contentHelper->getIndustri($id_industri);

    $this->view->assign('listindustri',$getIndustri); 
    
    $getPelaporanNikotin = $this->contentHelper->getPelaporanNikotin(false,$getIndustri[0]['id']);
    $this->view->assign('laporannikotin',$getPelaporanNikotin); 

    $getLab = $this->contentHelper->getLab();
    $this->view->assign('lab',$getLab); 

    $getPabrik = $this->contentHelper->getPabrik(false,$getIndustri[0]['id']);
    if ($getPabrik){

        foreach ($getPabrik as $key => $value) {
          $tmp = $this->contentHelper->getKab($value['provinsi']);
          $getPabrik[$key]['alamatPabrik'] = $tmp[0];
          $tmpKab = $this->contentHelper->getKab($value['provinsi']);
          $getPabrik[$key]['getCurrentKab'] = $tmpKab[0];
          $tmpProv = $this->contentHelper->getLokasi($tmpKab[0]['parent']);
          $getPabrik[$key]['getCurrentProv'] = $tmpProv[0];
        }

        
        
        $this->view->assign('listpabrik',$getPabrik);  
    }

    $getProduk = $this->contentHelper->getProduk();
    $this->view->assign('produk',$getProduk);  
    
    if ($_POST){
      $saveData = $this->contentHelper->saveDataNikotin($_POST);
      if ($saveData){

        if(!empty($_FILES)){
          

            $foto = array('sertifikat');
            foreach ($foto as $key => $value) {

              if($_FILES[$value]['name'] != ''){
                $image = uploadFile($value,null,'image');
                if ($image){
                  $dataImage[$value] =  $image;
                }
              }
            }
          
          $dataImage['pabrikID'] = $_POST['pabrikID'];
          $dataImage['industriID'] = $_POST['industriID'];
          $updateData = $this->contentHelper->updateDataNikotin($dataImage);
          if ($updateData) reload($basedomain.'account/pelaporan_nikotin');


        }
        reload($basedomain.'account/pelaporan_nikotin');
      }
    }

    if (isset($_GET['id'])){

      $getPabrik = $this->contentHelper->getPabrik($id);
      if ($getPabrik){
        $getIndustri = $this->contentHelper->getIndustri($getPabrik[0]['indusrtiID']);
        

        $data['ind'] = $getIndustri[0];
        $data['pabrik'] = $getPabrik[0];
      }

      $id_industri = $this->user['industri_id'];
      $getIndustri = $this->contentHelper->getIndustri($id_industri);

      $getPelaporanNikotin = $this->contentHelper->getPelaporanNikotin($_GET['id']);
      $this->view->assign('kemasanedit',$getPelaporanNikotin[0]); 
    }
    return $this->loadView('account-pelaporan-nikotin');
  }

  function pelaporanDetail()
  {


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

      $data = $this->contentHelper->getPelaporanKemasan($_GET['id']);
      
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
        $this->view->assign('kemasan',$data[0]);
      }

      $id = $data[0]['pabrikID'];
      $getPabrik = $this->contentHelper->getPabrik($id);
      $getIndustri = $this->contentHelper->getIndustri($data[0]['industriID']);

   

      $this->view->assign('ind',$getIndustri[0]);
      $this->view->assign('pabrik',$getPabrik[0]);

      $id_industri = $this->user['industri_id'];
      $getIndustri = $this->contentHelper->getIndustri($id_industri);


    return $this->loadView('account-pelaporan-detail');
  }

  function ajaxPabrik()
  {

    $id = _p('kode_wilayah');
    if ($id){
      $getPabrik = $this->contentHelper->getPabrik($id);
      if ($getPabrik){
        $getIndustri = $this->contentHelper->getIndustri($getPabrik[0]['indusrtiID']);
        
        $data['ind'] = $getIndustri[0];
        $data['pabrik'] = $getPabrik[0];
        print json_encode(array('status'=>true, 'res'=>$data));
      }else{
        print json_encode(array('status'=>false));
      }
    }else{
      print json_encode(array('status'=>false));
    }
    
    
    exit;
  }

  function ajaxLab()
  {

    $id = _p('kode_wilayah');
    if ($id){
      $getLab = $this->contentHelper->getLab($id);
      if ($getLab){
        
        print json_encode(array('status'=>true, 'res'=>$getLab[0]));
      }else{
        print json_encode(array('status'=>false));
      }
    }else{
      print json_encode(array('status'=>false));
    }
    
    
    exit;
  }

  function ajax()
  {

    $id = _p('kode_wilayah');
    $getKab = $this->contentHelper->getKab(false, $id);

    if ($getKab){
      print json_encode(array('status'=>true, 'res'=>$getKab));
    }else{
      print json_encode(array('status'=>false));
    }
    
    exit;
  }

  function ajax_getMerek()
  {
    $keyword = _p('keyword');
    $getProduk = $this->contentHelper->getProduk(false, $keyword);
    // pr($getProduk);exit;
    if ($getProduk){
      echo '<ul id="country-list">';
      foreach ($getProduk as $key => $value) {
        ?>
        <li onClick="selectCountry('<?php echo $value["merek"]; ?>', '<?php echo $value["id"]; ?>');"><?php echo $value["merek"]; ?></li>
        <?php
      }
      echo '</ul>';
    }
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
}

?>
