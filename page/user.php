<?php
include_once '../loader.php';
session_ini();
$oUArtist = new UserArtist('',$_SESSION['sUserId'],[0,0,0,0,0,0]);
$aaUArtists = $oUArtist->getAll([['sUserId',(string)$_SESSION['sUserId']]]);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="page/pages.css">
<body>
<div class="container mt-3">
<table class="table table-dark summary">
    <tr>
    <th><h3>Artist</h3></th>
    <th><h3>Vocal Ability</h3></th>
    <th><h3>Content</h3></th>
    <th><h3>Production</h3></th>
    <th><h3>Career Success</h3></th>
    <th><h3>Influence</h3></th>
    <th><h3>Originality</h3></th>
    <th><h3>Overall</h3></th>
    </tr>
    <?php
        foreach($aaUArtists as $key => $aUArtist){
            echo '<tr>';
            echo '<td onclick="window.location.href=\'https://mypages.iit.edu/~tayodele/ArtistGradebook/newartist?edit=Yes&Artist='.$aUArtist[1].'\'"><h4>'.$aUArtist[1].'</h4></td>';
            echo '<td><h4>'.gradeAssoc($aUArtist[3]).'</h4></td>';
            echo '<td><h4>'.gradeAssoc($aUArtist[4]).'</h4></td>';
            echo '<td><h4>'.gradeAssoc($aUArtist[5]).'</h4></td>';
            echo '<td><h4>'.gradeAssoc($aUArtist[6]).'</h4></td>';
            echo '<td><h4>'.gradeAssoc($aUArtist[7]).'</h4></td>';
            echo '<td><h4>'.gradeAssoc($aUArtist[8]).'</h4></td>';
            echo '<td><h4>'.gradeAssoc($aUArtist[9]).'</h4></td>';
            echo '</tr>';
        }
    ?>
</table>

<button class='btn btn-dark pagebutton' onclick="window.location.href='https://mypages.iit.edu/~tayodele/ArtistGradebook/cover'">Back to Gradebook</button>
</div>
</body>