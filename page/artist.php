<?php 
include('../loader.php');
$oArtist = new Artist($_GET['Artist'],[],true);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="page/pages.css">
<body>
<div class="container mt-3">
<h1 class="mb-3"><?php echo $oArtist->sName; ?></h1>
<table class="table table-dark">
    <tr>
    <td><h3>Vocal Ability</h3></td>
    <td><h3>Content</h3></td>
    <td><h3>Production</h3></td>
    <td><h3>Career Success</h3></td>
    <td><h3>Influence</h3></td>
    <td><h3>Originality</h3></td>
    <td><h3>Overall</h3></td>
    </tr>
    <?php
        echo '<tr>';
        echo '<td><h4>'.gradeAssoc((int)round($oArtist->aGradesOvr["iLyric"])).'</h4></td>';
        echo '<td><h4>'.gradeAssoc((int)round($oArtist->aGradesOvr["iContent"])).'</h4></td>';
        echo '<td><h4>'.gradeAssoc((int)round($oArtist->aGradesOvr["iProd"])).'</h4></td>';
        echo '<td><h4>'.gradeAssoc((int)round($oArtist->aGradesOvr["iCareer"])).'</h4></td>';
        echo '<td><h4>'.gradeAssoc((int)round($oArtist->aGradesOvr["iInfluence"])).'</h4></td>';
        echo '<td><h4>'.gradeAssoc((int)round($oArtist->aGradesOvr["iOriginal"])).'</h4></td>';
        echo '<td><h4>'.gradeAssoc((int)round($oArtist->aGradesOvr["iOverall"])).'</h4></td>';
        echo '</tr>';
    ?>
    
    <h3># of Grades: <?php echo $oArtist->iGrades; ?></h3>
</table>

<button class='pagebutton btn btn-dark' onclick="window.location.href='https://mypages.iit.edu/~tayodele/ArtistGradebook/newartist?Artist=<?php echo $_GET['Artist']; ?>'">Grade Artist</button>
<button class='pagebutton btn btn-dark' onclick="window.location.href='https://mypages.iit.edu/~tayodele/ArtistGradebook/cover'">Back to Gradebook</button>
</div>
</body>