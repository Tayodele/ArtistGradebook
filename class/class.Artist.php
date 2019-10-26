<?php
include_once '../loader.php';

class Artist extends Generic {

    public $sName;
    public $iGrades;
    public $aGradesOvr;
    //1-14 1: F 13: A+ truncated
    //iLyric,iContent,iProd,iCareer,iInfluence,iOriginal,iOverall

    public $sTable = 'artist';
    public $sColumns = 'sName,iGrades,iLyric,iContent,iProd,iCareer,iInfluence,iOriginal,iOverall';
    
	public function build(){
        $aVals = ['"'.$this->sName.'"','"'.$this->iGrades.'"'];
        foreach($this->aGradesOvr as $key => $iGrade){
            array_push($aVals,'"'.$iGrade.'"');
        }
        return $aVals;
    }
    
    //Only instantiate objects that already exist!
    public function __construct($sName="",$aGradesOvr=[],$bExists=false) {
        $this->sName = $sName;
        if($bExists) {
            $aaArtist = $this->getAll([["sName",$sName]]);
            $this->iGrades = $aaArtist[0][2];
            $this->aGradesOvr = array(
                "iLyric" =>     $aaArtist[0][3],
                "iContent" =>   $aaArtist[0][4],
                "iProd" =>      $aaArtist[0][5],
                "iCareer" =>    $aaArtist[0][6],
                "iInfluence" => $aaArtist[0][7],
                "iOriginal" =>  $aaArtist[0][8],
                "iOverall" =>   $aaArtist[0][9]
            );
        } else {
            $this->iGrades = 0;
            $this->aGradesOvr = array(
                "iLyric" =>     $aGradesOvr["iLyric"],
                "iContent" =>   $aGradesOvr["iContent"],
                "iProd" =>      $aGradesOvr["iProd"],
                "iCareer" =>    $aGradesOvr["iCareer"],
                "iInfluence" => $aGradesOvr["iInfluence"],
                "iOriginal" =>  $aGradesOvr["iOriginal"],
                "iOverall" =>   $aGradesOvr["iOverall"]
            );
        }
    }

    public function getName(){
        return $this->sName;
    }

    public function getNumGrades(){
        return $this->iGrades;
    }

    public function getGradesOvr(){
        return $this->aGradesOvr;
    }

    public function resum(){
        $oUArtist = new UserArtist('',$_SESSION['sUserId'],[0,0,0,0,0,0]);
        $aaUArtists = $oUArtist->getAll([['sUserId',(string)$_SESSION['sUserId']],['sName',$this->sName]]);
        $aGradesOvr = array(
            "iLyric" =>     0,
            "iContent" =>   0,
            "iProd" =>      0,
            "iCareer" =>    0,
            "iInfluence" => 0,
            "iOriginal" =>  0,
            "iOverall" =>   0
        );
        foreach($aaUArtists as $aUArtist){
            $aGradesOvr["iLyric"]       +=    $aUArtist[3];
            $aGradesOvr["iContent"]     +=    $aUArtist[4];  
            $aGradesOvr["iProd"]        +=    $aUArtist[5];  
            $aGradesOvr["iCareer"]      +=    $aUArtist[6];  
            $aGradesOvr["iInfluence"]   +=    $aUArtist[7];  
            $aGradesOvr["iOriginal"]    +=    $aUArtist[8];  
            $aGradesOvr["iOverall"]     +=    $aUArtist[9];  
        }
        foreach($aGradesOvr as $iGrade)
            $iGrade = $iGrade/$this->iGrades;
        $this->aGradesOvr = $aGradesOvr;
        $this->update();
    }

}
?>