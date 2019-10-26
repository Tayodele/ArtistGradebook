<?php
include_once '../loader.php';

class User extends Generic {

    public $sEmail;
    private $sPass;

    public $sTable = 'user';
    public $sColumns = 'sEmail,sPass';
    
	public function build(){
		return ['"'.$this->sEmail.'"','"'.$this->sPass.'"'];
    }
    
    public function __construct($sEmail,$sPassRaw,$bExists) {
        $this->sEmail = $sEmail;
        $this->sPass = passEncrypt($sPassRaw);
        if($bExists)
            $this->iId = $this->getAll([["sEmail",$sEmail]])[0][0];
    }

    public function getEmail(){
        return $this->sEmail;
    }

    public function setEmail($sEmail) {
        $this->sEmail = $sEmail;
    }

    //boolean for passwds
    public function checkPasswd($sPassRaw) {
        if($sPassRaw == $this->passDecrypt($this->$sPass))
            return true;
        else    
            return false;
    }

    //scramble passwds in db pull key from db
    private function passEncrypt($sPassRaw) {

    }

    //unscramble passwds in db pull key from db
    private function passDecrypt($sPassRaw) {

    }
}
?>