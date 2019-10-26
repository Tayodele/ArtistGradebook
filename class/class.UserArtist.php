<?php
include_once '../loader.php';

class UserArtist extends Generic {

    public $sName;
    public $aGrades;
    public $sUserId;
    public $oArtist;
    //1-14 1: F 1: A+ truncated
    //iLyric,iContent,iProd,iCareer,iInfluence,iOriginal,iOverall

    public $sTable = 'userartist';
    public $sColumns = 'sName,sUserId,iLyric,iContent,iProd,iCareer,iInfluence,iOriginal,iOverall';
    
	public function build(){
        $aVals = ['"'.$this->sName.'"','"'.$this->sUserId.'"'];
        foreach($this->aGrades as $key => $iGrade){
            array_push($aVals,'"'.$iGrade.'"');
        }
        return $aVals;
    }
    
    public function __construct($sName,$sUserId,$aGrades,$bExisting = false) {
        $this->sName = $sName;
        $this->sUserId = $sUserId;
        $this->aGrades = array(
            "iLyric" => $aGrades["iLyric"],
            "iContent" => $aGrades["iContent"],
            "iProd" => $aGrades["iProd"],
            "iCareer" => $aGrades["iCareer"],
            "iInfluence" => $aGrades["iInfluence"],
            "iOriginal" => $aGrades["iOriginal"],
            "iOverall" => $aGrades["iOverall"]
        );
        if($bExisting)
            $this->getArtist();
    }

    //get artist from db that can be used to update overall scores
    public function getArtist() {
        $aaUArt = $this->getAll([["sName",$this->sName],['sUserId',$this->sUserId]]);
        $this->iId = $aaUArt[0][0];
        $this->oArtist = new Artist();
        $aaArtist = $this->oArtist->getAll([["sName",$this->sName]]);
        $this->oArtist->iId = $aaArtist[0][0];
        $this->oArtist->sName = $aaArtist[0][1];
        $this->oArtist->iGrades = $aaArtist[0][2];
        $this->oArtist->aGradesOvr = array(
            "iLyric" =>     $aaArtist[0][3],
            "iContent" =>   $aaArtist[0][4],
            "iProd" =>      $aaArtist[0][5],
            "iCareer" =>    $aaArtist[0][6],
            "iInfluence" => $aaArtist[0][7],
            "iOriginal" =>  $aaArtist[0][8],
            "iOverall" =>   $aaArtist[0][9]
        );
    }

    public function getGrades(){
        return $this->aGrades;
    }

    public function setGrades($aGrades){
        $this->aGrades = $aGrades;
    }

    public function getName(){
        return $this->sName;
    }

    public function getUserId(){
        return $this->sUserId;
    }

    //update overall artist scores based on your scores
    public function updateScores(){
        if(!isset($this->oArtist)){
            $this->oArtist = new Artist($this->sName,$this->aGrades);
            $this->oArtist->iGrades++;
            $this->oArtist->create();
        }
        else {
            $this->oArtist->iGrades++;
            foreach($this->aGrades as $key => $iGrade) {
                $iOldA = $this->oArtist->aGradesOvr[$key]*($this->oArtist->iGrades - 1);
                $this->oArtist->aGradesOvr[$key] = (($iGrade + ($iOldA*($this->oArtist->iGrades - 1)))/$this->oArtist->iGrades) -
                                                        (($this->oArtist->iGrades-2)*($iOldA/$this->oArtist->iGrades));
            }
            $this->oArtist->update();
        }
    }
}
?>