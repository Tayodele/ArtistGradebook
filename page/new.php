<?php
include '../loader.php';
session_ini();

if($_GET['bEdit'] == '1') {
    $_SESSION['bEdit'] = false;
    createNew(true);
}
else if(isset($_GET['Existing']))
    createNew();

if(isset($_GET['edit']))
    $_SESSION['bEdit'] = true;
else    
    $_SESSION['bEdit'] = false;

function compareNew($sArtist){
    $oNew = new Artist('',[0,0,0,0,0,0]);
    $aaArtists = $oNew->getAll([]);
    foreach($aaArtists as $aArtist){
        if(strtolower($sArtist) == strtolower($aArtist[1]))
            return true;
    }
    return false;
}

function gradeExists($sArtist){
    $oUArtist = new UserArtist($sArtist,$_SESSION['sUserId'],$aGrades);
    $aaUArtist = $oUArtist->getAll([['sName',$sArtist],['sUserId',$_SESSION['sUserId']]]);
    if(isset($aaUArtist[0][2]))
        return true;
    return false;
}

function createNew($bEdit = false) { 
    $flag = false;
    if(!isset($_SESSION['sUserId'])){
        session_ini();
        $_SESSION['bExpired'] = true;
        header('Location: https://mypages.iit.edu/~tayodele/ArtistGradebook/cover');
        exit();
    }

    $aGrades = [
        "iLyric"        => (int)$_GET["iLyric"],
        "iContent"      => (int)$_GET["iContent"],
        "iProd"         => (int)$_GET["iProd"],
        "iCareer"       => (int)$_GET["iCareer"],
        "iInfluence"    => (int)$_GET["iInfluence"],
        "iOriginal"     => (int)$_GET["iOriginal"]
    ];
    foreach($aGrades as $key => $iGrade) {
        if(!is_int($iGrade) || $iGrade == 0) {
            $flag = true;
            break;
        }
    }
    $aGrades['iOverall'] = round(array_sum($aGrades)/6);
    if(!$flag && $bEdit) {
        //update UserArtist
        $oUArtist = new UserArtist($_GET['Existing'],$_SESSION['sUserId'],$aGrades,true);
        $oUArtist->update();
        //update Main Artist Grade
        $oUArtist->oArtist->resum();
        header('Location: https://mypages.iit.edu/~tayodele/ArtistGradebook/user');
        exit();
    }
    if(gradeExists($_GET['New_Artist']) || gradeExists($_GET['Existing'])){
        header('Location: https://mypages.iit.edu/~tayodele/ArtistGradebook/newartist?Dup=Y');
        exit();
    }
    if($_GET['Existing'] == 'Artist' && !$flag) {
        // Create New
        $bExisting = compareNew(trim($_GET['New_Artist']));
        $oUArtist = new UserArtist(trim($_GET['New_Artist']),$_SESSION['sUserId'],$aGrades,$bExisting);
        $oUArtist->updateScores();
        $oUArtist->create();
        header('Location: https://mypages.iit.edu/~tayodele/ArtistGradebook/user');
        exit();
    }
    else if(!$flag) {
        //fetch Existing
        $oUArtist = new UserArtist($_GET['Existing'],$_SESSION['sUserId'],$aGrades,true);
        $oUArtist->updateScores();
        $oUArtist->create();
        header('Location: https://mypages.iit.edu/~tayodele/ArtistGradebook/user');
        exit();
    }
    else {
        echo 'Please select a grade for every category.';
    }
}

 ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="page/pages.css">
<body>
<div class="container mt-3">
<h3 <?php if(!isset($_GET['Dup'])) echo 'hidden'; ?> >You already graded that artist</h3>
<form method="get" target="_self">
    <h3 class="mb-3"> <?php if($_SESSION['bEdit'] == true) echo 'Edit '; ?> Artist</h3>
    <input hidden type="text" name="bEdit" value="<?php if($_SESSION['bEdit'] == true) echo '1'; else echo '0' ?>"/>
    <div class="form-group row">
        <label class="col-sm-1 col-form-label col-form-label-sm" for="colFormLabelSm"><h4>Existing Artist</h4></label>
    <div class="col-auto my-3">
        <select class="custom-select mr-sm-2" name="Existing" id="Existing">
        <option <?php if(!isset($_GET['Artist'])) echo 'selected'; ?>>Artist</option>
        <?php 
        $oNew = new Artist('',[0,0,0,0,0,0]);
        $aaArtists = $oNew->getAll([]);
        foreach($aaArtists as $aArtist){
            if(isset($_GET['Artist']) && $_GET['Artist'] == $aArtist[1])
                echo '<option selected value="'.$aArtist[1].'">'.$aArtist[1].'</option>';
            else
                echo '<option value="'.$aArtist[1].'">'.$aArtist[1].'</option>';
        }
        ?>
        </select>
    </div>
    <label <?php if($_SESSION['bEdit'] == true) echo 'hidden'; ?> for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm"><h4>New Artist</h4></label>
    <div class="col-auto my-3" <?php if($_SESSION['bEdit'] == true) echo 'hidden'; ?> >
      <input type="text" class="form-control form-control-medium" name="New_Artist" id="New_Artist" placeholder="New Artist's Name">
    </div>
    <div class="col-auto my-3">
        <label class="mr-sm-2 sr-only mt-2" for="iLyric">Delivery</label>
        <select require class="custom-select mr-sm-2 mt-2" name="iLyric" id="iLyric">
        <option selected>Delivery</option>
        
        <option value="13">A+</option>
        <option value="12">A</option>
        <option value="11">A-</option>
        <option value="10">B+</option>
        <option value="9">B</option>
        <option value="8">B-</option>
        <option value="7">C+</option>
        <option value="6">C</option>
        <option value="5">C-</option>
        <option value="4">D+</option>
        <option value="3">D</option>
        <option value="2">D-</option>
        <option value="1">F</option>
        </select>
        <label class="mr-sm-2 sr-only mt-2" for="iContent">Content</label>
        <select require class="custom-select mr-sm-2 mt-2" name="iContent" id="iContent">
        <option selected>Content</option>
        
        <option value="13">A+</option>
        <option value="12">A</option>
        <option value="11">A-</option>
        <option value="10">B+</option>
        <option value="9">B</option>
        <option value="8">B-</option>
        <option value="7">C+</option>
        <option value="6">C</option>
        <option value="5">C-</option>
        <option value="4">D+</option>
        <option value="3">D</option>
        <option value="2">D-</option>
        <option value="1">F</option>
        </select>
        <label class="mr-sm-2 sr-only mt-2" for="iProd">Production</label>
        <select require class="custom-select mr-sm-2 mt-2" name="iProd" id="iProd">
        <option selected>Production</option>
        
        <option value="13">A+</option>
        <option value="12">A</option>
        <option value="11">A-</option>
        <option value="10">B+</option>
        <option value="9">B</option>
        <option value="8">B-</option>
        <option value="7">C+</option>
        <option value="6">C</option>
        <option value="5">C-</option>
        <option value="4">D+</option>
        <option value="3">D</option>
        <option value="2">D-</option>
        <option value="1">F</option>
        </select>
        <label class="mr-sm-2 sr-only mt-2" for="iCareer">Career Success</label>
        <select require class="custom-select mr-sm-2 mt-2" name="iCareer" id="iCareer">
        <option selected>Career Success</option>
        
        <option value="13">A+</option>
        <option value="12">A</option>
        <option value="11">A-</option>
        <option value="10">B+</option>
        <option value="9">B</option>
        <option value="8">B-</option>
        <option value="7">C+</option>
        <option value="6">C</option>
        <option value="5">C-</option>
        <option value="4">D+</option>
        <option value="3">D</option>
        <option value="2">D-</option>
        <option value="1">F</option>
        </select>
        <label class="mr-sm-2 sr-only mt-2" for="iInfluence">Influence</label>
        <select require class="custom-select mr-sm-2 mt-2" name="iInfluence" id="iInfluence">
        <option selected>Influence</option>
        
        <option value="13">A+</option>
        <option value="12">A</option>
        <option value="11">A-</option>
        <option value="10">B+</option>
        <option value="9">B</option>
        <option value="8">B-</option>
        <option value="7">C+</option>
        <option value="6">C</option>
        <option value="5">C-</option>
        <option value="4">D+</option>
        <option value="3">D</option>
        <option value="2">D-</option>
        <option value="1">F</option>
        </select>
        <label class="mr-sm-2 sr-only mt-2" for="iOriginal">Originality</label>
        <select require class="custom-select mr-sm-2 mt-2" name="iOriginal" id="iOriginal">
        <option selected>Originality</option>
        
        <option value="13">A+</option>
        <option value="12">A</option>
        <option value="11">A-</option>
        <option value="10">B+</option>
        <option value="9">B</option>
        <option value="8">B-</option>
        <option value="7">C+</option>
        <option value="6">C</option>
        <option value="5">C-</option>
        <option value="4">D+</option>
        <option value="3">D</option>
        <option value="2">D-</option>
        <option value="1">F</option>
        </select>
        
    </div>
  </div>

    <button class='pagebutton btn btn-dark' type="submit">Submit</button>
</form>

<button class='pagebutton btn btn-dark' onclick="window.location.href='https://mypages.iit.edu/~tayodele/ArtistGradebook/user'">Past Grades</button>
<button class='pagebutton btn btn-secondary' onclick="window.location.href='https://mypages.iit.edu/~tayodele/ArtistGradebook/cover'">Back</button>

</div>
</body>