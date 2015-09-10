<?php
class contentHelper extends Database {

	function __construct()
	{
		$this->prefix = "bpom";
		$session = new Session();
		$this->user = $session->get_session();
	}



	function saveDataIndustri($data, $debug=false)
	{

		
		// pr($_POST);
		// exit;
		foreach ($data as $key => $value) {
			$$key = $value;
		}

		$sql = array(
                    'table' =>"{$this->prefix}_industri",
                    'field' => "npwp = '{$npwp}', namaPimpinan = '{$namaPimpinan}',noKTP = '{$noKTP}',
                    			jenisKelamin = '{$jenisKelamin}',alamatPimpinan = '{$alamatPimpinan}',
                    			provinsi = '{$provinsi}',kecamatan = '{$kecamatan}',desa = '{$desa}',
                    			kodePos = '{$kodePos}',jalanRTRW = '{$jalanRTRW}',noTelepon = '{$noTelepon}',
                    			noFax = '{$noFax}',email = '{$email}'",
                    'condition' => "id = {$id}",
                );
        $result = $this->lazyQuery($sql,$debug,2);
        if ($result) return $result;
        return false;
	}

	function saveDataPabrik($data, $debug=false)
	{
		foreach ($data as $key => $value) {
			$$key = $value;
		}

		$createDate = date('Y-m-d H:i;s');
		$n_status = 1;

		if ($id){

			$sql = array(
	                    'table' =>"{$this->prefix}_industri_pabrik",
	                    'field' => "indusrtiID = '{$indusrtiID}', provinsi = '{$provinsi}',kecamatan = '{$kecamatan}',
	                    			desa = '{$desa}',kodePos = '{$kodePos}',
	                    			namaJalan = '{$namaJalan}',noNPPBKC = '{$noNPPBKC}',n_status = '{$n_status}'",
	                    'condition' => "id = {$id}",
	                );
	        $result = $this->lazyQuery($sql,$debug,2);
		}else{
			$sql = array(
	                    'table' =>"{$this->prefix}_industri_pabrik",
	                    'field' => "indusrtiID, provinsi ,kecamatan, desa, kodePos,
	                    			namaJalan,noNPPBKC,createDate,n_status",
	                    'value' => "'{$indusrtiID}', '{$provinsi}', '{$kecamatan}','{$desa}','{$kodePos}','{$namaJalan}',
	                    			'{$noNPPBKC}', '{$createDate}',$n_status ",
	                );
	        $result = $this->lazyQuery($sql,$debug,1);
		}
		
        if ($result) return $result;
        return false;
	}

	function saveDataKemasan($data, $debug=false)
	{
		foreach ($data as $key => $value) {
			$$key = $value;
		}

		$createDate = date('Y-m-d H:i;s');
		$n_status = 1;

		
		$sql = array(
                    'table' =>"{$this->prefix}_pelaporan_kemasan",
                    'field' => "industriID, pabrikID, merek ,jenis, isi, bentuKemasan,
                    			jenisGambar,tulisanPeringatan,createDate,n_status",
                    'value' => "'{$industriID}','{$pabrikID}', '{$merek}', '{$jenis}','{$isi}','{$bentuKemasan}','{$jenisGambar}',
                    			'{$tulisanPeringatan}', '{$createDate}',$n_status ",
                );
        $result = $this->lazyQuery($sql,$debug,1);
		
		
        if ($result) return $result;
        return false;
	}

	function saveDataNikotin($data, $debug=false)
	{
		foreach ($data as $key => $value) {
			$$key = $value;
		}

		$createDate = date('Y-m-d H:i;s');
		$n_status = 1;

		
		$sql = array(
                    'table' =>"{$this->prefix}_pelaporan_nikotin",
                    'field' => "industriID, pabrikID, merek ,jenis, isiKemasan, kodeProduksi,
                    			kodeSample,labID, noSertifikat, tanggalUji, kadarNikotin,
                    			kadarTar, kadarKretek, createdDate,n_status",
                    'value' => "'{$industriID}', '{$pabrikID}', '{$merek}', '{$jenis}','{$isiKemasan}',
                    			'{$kodeProduksi}','{$kodeSample}','{$labID}','{$noSertifikat}',
                    			'{$tanggalUji}','{$kadarNikotin}','{$kadarTar}', '{$kadarKretek}','{$createDate}',$n_status ",
                );
        $result = $this->lazyQuery($sql,$debug,1);
		
		
        if ($result) return $result;
        return false;
	}

	function updateDataKemasan($data, $debug=false)
	{
		$files = $data['full_name'];
		$id = $data['id'];
		if ($id) $id = $id;
		else $id = $this->insert_id();

		$fotoDepan = $data['fotoDepan']['full_name'];
		if ($fotoDepan) $field[] = "fotoDepan = '{$fotoDepan}'";
		$fotoBelakang = $data['fotoBelakang']['full_name'];
		if ($fotoBelakang) $field[] = "fotoBelakang = '{$fotoBelakang}'";
		$fotoKanan = $data['fotoKanan']['full_name'];
		if ($fotoKanan) $field[] = "fotoKanan = '{$fotoKanan}'";
		$fotoKiri = $data['fotoKiri']['full_name'];
		if ($fotoKiri) $field[] = "fotoKiri = '{$fotoKiri}'";
		$fotoAtas = $data['fotoAtas']['full_name'];
		if ($fotoAtas) $field[] = "fotoAtas = '{$fotoAtas}'";
		$fotoBawah = $data['fotoBawah']['full_name'];
		if ($fotoBawah) $field[] = "fotoBawah = '{$fotoBawah}'";
		$suratPengantar = $data['suratPengantar']['full_name'];
		if ($suratPengantar) $field[] = "suratPengantar = '{$suratPengantar}'";

		if ($field){
			$impF = implode(',', $field);
			$sql = array(
		                'table' =>"{$this->prefix}_pelaporan_kemasan",
		                'field' => "{$impF}",
		                'condition' => "id = {$id}",
		            );
		    $result = $this->lazyQuery($sql,$debug,2);
		    if ($result) return true;
		}
		
        return false;
	}

	function updateDataNikotin($data, $debug=false)
	{
		$files = $data['full_name'];
		$id = $data['id'];
		
		if ($id) $id = $id;
		else $id = $this->insert_id();

		$sertifikat = $data['sertifikat']['full_name'];
		if ($sertifikat) $field[] = "sertifikat = '{$sertifikat}'";
		

		$impF = implode(',', $field);
		$sql = array(
	                'table' =>"{$this->prefix}_pelaporan_nikotin",
	                'field' => "{$impF}",
	                'condition' => "id = {$id}",
	            );
	    $result = $this->lazyQuery($sql,$debug,2);
	    if ($result) return true;
        return false;
	}


	function getPelaporanKemasan($id=false, $industriID=false, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND k.id = '{$id}'";
		if ($industriID) $filter .= "AND k.industriID = '{$industriID}'";
		if ($pabrikID) $filter .= "AND k.pabrikID = '{$pabrikID}'";

		$sql = array(
                    'table' =>"{$this->prefix}_pelaporan_kemasan AS k, {$this->prefix}_product AS p, 
                    			{$this->prefix}_industri_pabrik AS i, {$this->prefix}_industri AS ind",
                    'field' => "k.*, p.merek, p.jenis, i.noNPPBKC, i.namaJalan, ind.namaPimpinan,
                    			ind.kodePos, ind.noFax",
                    'condition' => "1 {$filter}",
                    'joinmethod' => 'LEFT JOIN',
                	'join' => 'k.merek=p.id, k.pabrikID = i.id, k.industriID = ind.id'
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}

	function getPelaporanNikotin($id=false, $industriID=false, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND k.id = '{$id}'";
		if ($industriID) $filter .= "AND k.industriID = '{$industriID}'";
		if ($pabrikID) $filter .= "AND k.pabrikID = '{$pabrikID}'";

		$sql = array(
                    'table' =>"{$this->prefix}_pelaporan_nikotin AS k, {$this->prefix}_product AS p, 
                    			{$this->prefix}_industri_pabrik AS i, {$this->prefix}_industri AS ind",
                    'field' => "k.*, p.merek, p.jenis, i.noNPPBKC, i.namaJalan, ind.namaPimpinan,
                    			ind.kodePos, ind.noFax",
                    'condition' => "1 {$filter}",
                    'joinmethod' => 'LEFT JOIN',
                	'join' => 'k.merek=p.id, k.pabrikID = i.id, k.industriID = ind.id'
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}

	function updateDataPabrik($data, $debug=false)
	{
		$files = $data['full_name'];
		$id = $data['id'];
		if ($id) $id = $id;
		else $id = $this->insert_id();

		$sql = array(
	                'table' =>"{$this->prefix}_industri_pabrik",
	                'field' => "files = '{$files}'",
	                'condition' => "id = {$id}",
	            );
	    $result = $this->lazyQuery($sql,$debug,2);
	    if ($result) return true;
        return false;
	}

	function getIndustri($id=false,$all=false, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND id = '{$id}'";
		
		if ($all){
			$sql = array(
                    'table' =>"{$this->prefix}_industri",
                    'field' => "*",
                );
		}else{
			$sql = array(
                    'table' =>"{$this->prefix}_industri",
                    'field' => "*",
                    'condition' => "1 {$filter}",
                );
		}
		
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}

	function getPabrik($id=false, $indusrtiID=false, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND id = '{$id}'";
		if ($indusrtiID) $filter .= "AND indusrtiID = '{$indusrtiID}'";

		$sql = array(
                    'table' =>"{$this->prefix}_industri_pabrik",
                    'field' => "*",
                    'condition' => "1 {$filter}",
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}

	function getProduk($id=false, $keyword=false, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND id = '{$id}'";
		if ($keyword) $filter .= "AND merek LIKE '%{$keyword}%'";

		$sql = array(
                    'table' =>"{$this->prefix}_product",
                    'field' => "*",
                    'condition' => "1 {$filter}",
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}

	function getLab($id=false, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND id = '{$id}'";
		
		$sql = array(
                    'table' =>"{$this->prefix}_lab",
                    'field' => "*",
                    'condition' => "1 {$filter}",
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}

	function getLokasi($id=false,$debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND kode_wilayah = '{$id}'";
		$sql = array(
                    'table' =>"tbl_wilayah",
                    'field' => "*",
                    'condition' => "parent = 0 {$filter} ORDER BY nama_wilayah"
                );
        $result = $this->lazyQuery($sql, $debug);
        if ($result) return $result;
        return false;
	}

	function getKab($id=false, $parent=false, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND kode_wilayah = '{$id}'";
		if ($parent) $filter .= "AND parent = '{$parent}'";

		$sql = array(
                    'table' =>"tbl_wilayah",
                    'field' => "*",
                    'condition' => " 1 {$filter} ORDER BY nama_wilayah"
                );
        $result = $this->lazyQuery($sql, $debug);
        if ($result) return $result;
        return false;
	}

	function getTulisanPeringatan($id=false,$debug=false)
	{
		$filter = "";

		if ($id) $filter .= "AND kode_wilayah = '{$id}'";
		$sql = array(
                    'table' =>"{$this->prefix}_peringatan_kesehatan",
                    'field' => "*",
                    'condition' => "1 {$filter}"
                );
        $result = $this->lazyQuery($sql, $debug);
        if ($result) return $result;
        return false;
	}

	function getArticle($id=false, $categoryid=0, $articleType=0, $limit=10, $debug=false)
	{

		$filter = "";

		if ($id) $filter .= "AND id = '{$id}'";
		
		$sql = array(
                    'table' =>"{$this->prefix}_news_content",
                    'field' => "*",
                    'condition' => "categoryid = {$categoryid} AND articleType = {$articleType} AND n_status = 1 {$filter} ORDER BY posted_date DESC",
                    'limit' => $limit
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}
}
?>
