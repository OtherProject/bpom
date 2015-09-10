<?php
class userHelper extends Database {
	
    var $date;
    var $salt;
    var $token;

    function __construct()
    {
        $session = new Session;
        $getSessi = $session->get_session();
        $this->user = $getSessi['default'];

        $this->prefix = "bpom";
        $this->date = date('Y-m-d H:i:s');
        $this->salt = 'ovancop2014';
        $this->token = substr(str_shuffle('QWERTYUIOPLKJHGFDSAZXCVBNM1234567890qwertyuioplkjhgfdsazxcvbnm'),0,30);
    }
    
    function createAccount($data=false)
    {

        $saveIndustri = $this->saveIndustri($data);
        
        if (!$saveIndustri)return false;


        $field = array('industri_id','name','last_name','description','StreetName','phone_number','email'); 

        foreach ($data as $key => $value) {
            
            if (in_array($key, $field)){
                $tmpF[] = $key;
                $tmpV[] = "'".$value."'";
            }
        }

        $tmpF[] = "industri_id";
        $tmpF[] = "register_date";
        $tmpF[] = "usertype";
        $tmpF[] = "email_token";
        $tmpF[] = "salt";
        $tmpF[] = "password";

        $tmpV[] = $saveIndustri;
        $tmpV[] = "'".$this->date."'";
        $tmpV[] = 1;
        $tmpV[] = "'".$this->token."'";
        $tmpV[] = "'".$this->salt."'";
        $tmpV[] = "'YOUR PASSWORD'";


        $impField = implode(',', $tmpF);
        $impData = implode(',', $tmpV);

        $sql = "INSERT IGNORE INTO social_member ({$impField}) VALUES ({$impData})";
        // pr($sql);
        $res = $this->query($sql);
        if ($res){
            
            $data['token'] = $this->token;
            return $data;
        } 
        return false;

    }

    function saveIndustri($data=false)
    {
        $field = array('namaIndustri','namaPimpinan','noKTP','jenisKelamin','alamatPimpinan'); 

        foreach ($data as $key => $value) {
            
            if (in_array($key, $field)){
                $tmpF[] = $key;
                $tmpV[] = "'".$value."'";
            }
        }

        
        $tmpF[] = "createDate";
        $tmpF[] = "n_status";
        

        $tmpV[] = "'".$this->date."'";
        $tmpV[] = 1;
        

        $impField = implode(',', $tmpF);
        $impData = implode(',', $tmpV);

        $sql = "INSERT IGNORE INTO {$this->prefix}_industri ({$impField}) VALUES ({$impData})";
        
        $res = $this->query($sql);
        $id = $this->insert_id();
        if ($id) return $id;
        return false;
    }

    
    
    /**
     * @todo get data user/person
     * 
     * @param $data = 
     * @param $field =  field name
     */
    function getUserData($field=false,$data=false){
        if($data==false){
            
            $data = $this->user['id'];
        }
       
        $sql = "SELECT * FROM `social_member` WHERE `id` = '".$data."' ";
        $res = $this->fetch($sql);  
        if(empty($res)){return false;}
        return $res; 
    }
    
    function getCategory()
    {

        $sql = "SELECT *
                FROM {$this->tblprefix}_category
                WHERE n_status =1
                LIMIT 0 , 30";

        $res = $this->fetch($sql,1);  
        if ($res)return $res; 
        return false;
    }
    
    function saveAccount()
    {
        
        $run = $this->save("update", "social_member", $_POST, "id = {$_POST['id']}");
        if ($run) return true;
        return false;
    }
}
?>