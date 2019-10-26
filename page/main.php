<?php
include('../loader.php');
session_ini();

$oArtist = new Artist('',[0,0,0,0,0,0,0]);
$aaArtists = $oArtist->getAll([]);
$aaGradeRanks = [
  'A+' => [],
  'A' => [],
  'A-' => [],
  'B+' => [],
  'B' => [],
  'B-' => [],
  'C+' => [],
  'C' => [],
  'C-' => [],
  'D+' => [],
  'D' => [],
  'D-' => [],
  'F' => []
];
foreach($aaArtists as $aArtist){
  array_push($aaGradeRanks[gradeAssoc((int)round($aArtist[sizeof($aArtist) - 1]))],$aArtist[1]);
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="fb_login.js"></script>
<link rel="stylesheet" href="page/pages.css">
<body>
<div class="container mt-3">
<div class="mb-3">
<h1>Artist's Gradebook</h1> 
<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>
<h3 <?php if(isset($_SESSION['bExpired']) && $_SESSION['bExpired'] == false) echo 'hidden'; ?> >Please login to grade.</h3>
</div>

<table class="table table-dark table-hover" id="gradebook">
    <tr id="A+">
    <td><h3>A+</h3></td>
    <?php
      foreach($aaGradeRanks['A+'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="A">
    <td><h3>A</h3></td>
    <?php
      foreach($aaGradeRanks['A'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="A-">
    <td><h3>A-</h3></td>
    <?php
      foreach($aaGradeRanks['A-'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="B+">
    <td><h3>B+</h3></td>
    <?php
      foreach($aaGradeRanks['B+'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="B">
    <td><h3>B</h3></td>
    <?php
      foreach($aaGradeRanks['B'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="B-">
    <td><h3>B-</h3></td>
    <?php
      foreach($aaGradeRanks['B-'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="C+">
    <td><h3>C+</h3></td>
    <?php
      foreach($aaGradeRanks['C+'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="C">
    <td><h3>C</h3></td>
    <?php
      foreach($aaGradeRanks['C'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="C-">
    <td><h3>C-</h3></td>
    <?php
      foreach($aaGradeRanks['C-'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="D+">
    <td><h3>D+</h3></td>
    <?php
      foreach($aaGradeRanks['D+'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="D">
    <td><h3>D</h3></td>
    <?php
      foreach($aaGradeRanks['D'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="D-">
    <td><h3>D-</h3></td>
    <?php
      foreach($aaGradeRanks['D-'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
    <tr id="F">
    <td><h3>F</h3></td>
    <?php
      foreach($aaGradeRanks['F'] as $sArtist){
        echo '<td><p onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/artist?Artist='.$sArtist.'\'">'.$sArtist.'</p></td>';
      }
    ?>
    </tr>
</table>
<button class='pagebutton btn btn-dark' id='newb' onclick="window.location.href='https://mypages.iit.edu/~tayodele/ArtistGradebook/newartist'" <?php if($_SESSION['sStatus'] != 'connected') echo 'hidden'; ?> >Grade'a'Artist</button>
<div>
</body>
