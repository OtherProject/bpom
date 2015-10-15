<?php
class importHelper extends Database {
	
	var $prefix = "bpom";
	var $user = "";
	function __construct()
	{
		$usersess = new Session();
		$userArr = $usersess->get_session();
		$this->user = $userArr['admin'];
	}

	function insertTmpData($data=array())
	{
		
		// pr($data);
		$fieldalias = array('No'=>'no',
							'Merek Rokok'=>'merek',
							'Nama Produsen/importir'=>'produsen',
							'No NPPBKC'=>'nppbkc',
							'Kode Status Impor/Lokal'=>'kode_status',
							'Alamat'=>'alamat',
							'Kota/Kab'=>'kota',
							'Provinsi'=>'prov',
							'No Telp'=>'telp',
							'No Fax'=>'fax',
							'Nama Pemilik/Direktur/Kuasa Hukum'=>'pemilik',
							'Jenis Rokok (SKM/ SKT/ CRT/ TIS)'=>'jenis_rokok',
							'Isi'=>'isi',
							'Satuan Kemasan (btg/bgks; bgks/slop; btg/slinder; gram/bgks)'=>'satuan_kemasan',
							'Bentuk Kemasan (persegi panjang; slop; slinder; bungkus TIS)'=>'bentuk_kemasan',
							'Jenis Gambar'=>'jenis_gambar',
							'Tulisan peringatan kesehatan'=>'tulisan_peringatan',
							'Panjang PHW Depan'=>'phw_depan',
							'Panjang Kemasan Depan'=>'kemasan_depan',
							'Luas PHW Pada Label Depan (%)'=>'luas_phw_depan',
							'Panjang PHW Belakang'=>'phw_belakang',
							'Panjang Kemasan Belakang'=>'kemasan_belakang',
							'Luas PHW Pada Label Belakang (%)'=>'luas_phw_belakang',
							'Kadar Nikotin Label (mg)'=>'nikotin',
							'Kadar Tar Label (mg)'=>'tar',
							'Sisi samping/atas'=>'sisi',
							'Tulisan'=>'tulisan',
							'Pernyataan "dilarang menjual atau memberi kepada anak dan perempuan hamil"'=>'dilarang_menjual',
							'Kode Produksi'=>'kode_produksi',
							'Tgl/Bln/Thn Produksi'=>'tgl_produksi',
							'Nama dan Alamat Produsen Pada Label'=>'alamat_produsen',
							'Pernyataan "tidak ada batas aman"'=>'tidak_aman',
							'Pernyataan "mengandung lebih dari 4000 zat kimia"'=>'zat_kimia',
							'Kata promotif dan menyesatkan'=>'kata_promotif',
							'Jenis Kata promotif dan menyesatkan'=>'jenis_kata_promotif',
							'Evaluasi Informasi Kesehatan MK/TMK'=>'evaluasi',
							'Kesimpulan Contoh Label MK/TMK'=>'kesimpulan_label',
							'Nama Laboratorium Pengujian'=>'lab',
							'Alamat Laboratorium'=>'alamat_lab',
							'No Telp Laboratorium'=>'telp_lab',
							'No Fax Laboratorium'=>'fax_lab',
							'Penanggungjawab Laboraturium'=>'account_lab',
							'Kode Produksi'=>'kode_produksi_lab',
							'Nomor/Kode Sampel'=>'kode_sampel',
							'Nomor Lap Hasil Uji/Sertifikat'=>'nomor_lab',
							'Tanggal pengujian'=>'tgl_uji',
							'Kadar Nikotin Pengujian (mg)'=>'nikotin_uji',
							'Kadar Tar Coresta/Tar ISO Pengujian (mg)'=>'tar_uji',
							'Kadar Tar SNI/ Tar Kretek Pengujian (mg)'=>'tar_sni_uji',
							'Jenis PHW yang Ditemukan di Peredaran'=>'phw_ditemukan'
							);

		$fieldaliasLK=array('nppbkc'=>'industriID',
							'produsen'=>'pabrikID',
							'merek'=>'merek',
							'jenis_rokok'=>'jenis',
							'isi'=>'isi',
							'satuan_kemasan'=>'satuan',
							'bentuk_kemasan'=>'bentuKemasan',
							'jenis_gambar'=>'jenisGambar',
							'tulisan_peringatan'=>'tulisanPeringatan',
							'luas_phw_depan'=>'luasDepan',
							'luas_phw_belakang'=>'luasBelakang',
							// 'tulisan'=>'suratPengantar',
							// 'pemilik'=>'namaDan_alamat',
							'kode_produksi'=>'kodeProduksi',
							'tgl_produksi'=>'tglProduksi',
							'nikotin'=>'kadarNikotin',
							'tar'=>'kadarTar',
							'dilarang_menjual'=>'pernyataanDilarang_menjual',
							'tidak_aman'=>'pernyataanTidak_aman',
							'zat_kimia'=>'pernyataanZat_kimia',
							'gambar_depan'=>'fotoDepan',
							'gambar_belakang'=>'fotoBelakang',
							'gambar_kiri'=>'fotoKiri',
							'gambar_kanan'=>'fotoKanan',
							'gambar_atas'=>'fotoAtas',
							'gambar_bawah'=>'fotoBawah',
							'keterangan'=>'kesimpulan',
							'evaluasi'=>'catatanDitolak',
							'alamat_produsen'=>'lokasiBeli',
							'tgl_uji'=>'tglBeli',
							'tahun_pengawsan'=>'tahunCukai',
							'harga_bungkus'=>'hargaBungkus',
							'harga_batang'=>'hargaBatang'
							);
		$index = 1;
		$aliasindex = array_keys($fieldalias);
		foreach ($data as $val) {
			$tmpField = array();
			$tmpData = array();
			foreach ($val as $key => $value) {
				if (in_array($key, $aliasindex)){

					if ($key == "Nama Produsen/importir"){
						$tmpField[] = "`".$fieldalias[$key]."`";
						$tmpField[] = "`badan`";
						$impData = explode(',', $value);
						$tmpData[] = "'".$impData[0]."'";
						$tmpData[] = "'".$impData[1]."'";
					}else{
						$tmpField[] = "`".$fieldalias[$key]."`";
						$tmpData[] = "'".$value."'";
					}
					
					$dataku[$fieldalias[$key]]=	"'".$value."'";
					$index++;
				}
			}

			$dataLK[]=$dataku;
			$index = 1;
			$tmpField[] = "`session`";
			$tmpData[] = "'".session_id()."'";
			$field = implode(',', $tmpField);
			$value = implode(',', $tmpData);
			$sql[] = "INSERT INTO tmp_import ({$field}) VALUES ({$value})";
		}

		/*
		$indexLK = 1;
		$aliasindexLK = array_keys($fieldaliasLK);
		foreach ($dataLK as $valLK) {
			$tmpFieldLK = array();
			$tmpDataLK = array();
			foreach ($valLK as $keyLK => $valueLK) {
				if (in_array($keyLK, $aliasindexLK)){
				$tmpFieldLK[] = "`".$fieldaliasLK[$keyLK]."`";
				$tmpDataLK[] = $valueLK;
				$indexLK++;
				}
			}
			$indexLK = 1;
			$fieldLK = implode(',', $tmpFieldLK);
			$valueLK = implode(',', $tmpDataLK);
			$sqlLK[] = "INSERT INTO bpom_pelaporan_kemasan ({$fieldLK}) VALUES ({$valueLK})";
		}
		*/

		// pr($sql);exit;
		$success = true;
		if ($sql){
			$no = 1;
			foreach ($sql as $value) {
				$res = $this->query($value);
				if (!$res) $success = false;
				if ($no == 100){
					sleep(1);
					$no = 0;
				}else{
					$no++;
				}
			}
		}

		/*
		$successLK = true;
		if ($sqlLK){
			$noLK = 1;
			foreach ($sqlLK as $valueLK) {
				$resLK = $this->query($valueLK);
				if (!$resLK) $successLK = false;
				if ($noLK == 100){
					sleep(1);
					$noLK = 0;
				}else{
					$noLK++;
				}
			}
		}*/
		if ($success) return true;
		return false;
	}

	
	function saveData($data=array())
	{

		
		$arrayField = array(5=>'tanggalBeli',
							6=>'lokasiBeli',
							7=>'jenisGambar',
							9=>'luasPeringatan_depan',
							10=>'luasPeringatan_belakang',
							11=>'warnaGambar',
							12=>'evaluasiPeringatan',
							13=>'kadarNikotin',
							14=>'kadarTar',
							15=>'kadarPenulisan_sisi',
							16=>'kadarTulisan',
							17=>'pernyataanUtama',
							18=>'kodeProduksi',
							19=>'tanggalProduksi',
							21=>'pernyataanBatas_aman',
							22=>'pernyataanZat_kimia',
							23=>'kataPromotif',
							24=>'evaluasiInformasi',
							25=>'kesimpulan',
							26=>'tahun',
							27=>'harga');
		foreach ($data['ids'] as $value) {
			$id[] = $value;
		}
		$sesID = session_id();
		$impID = implode(',', $id);
		pr($impID);
		$sql = "SELECT * FROM tmp_import WHERE session = '{$sesID}' AND no IN ({$impID})";
		pr($sql);
		$res = $this->fetch($sql,1);
		// pr($res);exit;
		if ($res){
			
			$impField = array();
			$impData = array();
			
			// pr($res);exit;
			$indexArr = array_keys($arrayField);
			pr($arrayField);
			pr($indexArr);
			foreach ($res as $value) {
				pr($value);
				// exit;

				$tmpField = array();
				$tmpData = array();

				foreach ($value as $key => $value) {
					pr($value);
					// exit;
					if ($key==2){
						$produsen = $this->checkData('bpom_product','merek',$value);
						if ($produsen){
							$tmpField[] = "produkID";
							$tmpData[] = $produsen['id'];
						}
						
					}
					
					
					if (in_array($key, $indexArr)){

						$tmpField[] = $arrayField[$key];

						if ($key==5){
							$expl = explode('-', $value);
							$impl = $expl[0].'-'.$expl[1].'-'.'20'.$expl[2];
							$tmpData[] = "'".date('Y-m-d',strtotime($impl))."'";
						}else{

							if ($key==18){

								$tmpData[] = "'".substr($value,3) ."'";
							}else{

								if ($key==19){
									if ($value=='Tidak Ada'){
										$tmpData[] = "'".$value."'";
									}else{
										
										$tmp = substr($value,5,10);
										$tmpData[] = "'".date('Y-m-d', strtotime($tmp))."'";
									}
									
								}else{
									$tmpData[] = "'".$value."'";
								}
								
							}
						}	
					}
					
				}
				$tmpField[] = "tanggalEvaluasi";
				$tmpField[] = "userid";
				$tmpField[] = "balaiID";
				$tmpField[] = "provinsi";
				$tmpField[] = "n_status";

				$tmpData[] = "'".date('Y-m-d H:i:s')."'";
				$tmpData[] = $this->user['id'];
				$tmpData[] = intval($data['balai']);
				$tmpData[] = "'".$data['provinsi']."'";
				$tmpData[] = 1;

				$mergeTmpField=array_merge($tmpField,$arrayField);
				
				pr($tmpData);
				pr($tmpField);
				pr($mergeTmpField);
				$impField = implode(',', $mergeTmpField);
				$impData = implode(',', $tmpData);

				$query[] = "INSERT INTO {$this->prefix}_evaluasi ({$impField}) VALUES ({$impData})";
				pr($query);
				exit;

			}

			sleep(1);

			if ($query){
				$success = true;
				foreach ($query as  $value) {
					logFile($value);
					$run = $this->query($value);
					if (!$run) $success = false;
				}

				if ($success){

					$del = "DELETE FROM tmp_import WHERE id IN ($impID)";
					$exec = $this->query($del);
					return true;
				}else return false;
			}
		}
		
		return false;
	}

	function getTmpData()
	{
		$sesID = session_id();
		$sql = "SELECT * FROM tmp_import WHERE session = '{$sesID}'";
		$res = $this->fetch($sql,1);
		if ($res){

			foreach ($res as $key => $value) {
				$newData[$value['merek']][] = $value;
			}
			return $newData;
		}	
		return false;
	}

	function checkData($tabel="bpom_product", $field="merek", $data="")
	{


		$sql = "SELECT * FROM {$tabel} WHERE {$field} = '{$data}'";
		// pr($sql);
		$res = $this->fetch($sql);
		if ($res) return $res;
		return false;
	}

	function lookupTable($data)
	{

		$table = $data['table'];
		$field = $data['field'];
		$condition = $data['condition'];

		$sql = array(
                    'table' =>"{$table}",
                    'field' => "*",
                    'condition' => "n_status = 1 {$filter}",
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
	}
	
}
?>