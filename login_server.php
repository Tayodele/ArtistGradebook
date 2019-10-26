<?php
include 'loader.php';
session_ini();

switch($_GET['sAction']) {
    case 'load_user':
        $_SESSION['sStatus'] = $_GET['sStatus'];
        $_SESSION['sUserId'] = $_GET['iId'];
        $_SESSION['bExpired'] = false;
        $aaData['sStatus'] = 'success';
        $aaData['sMessage'] = '';
    break;
    default:
        $aaData['sStatus'] = 'failure';
        $aaData['sMessage'] = 'No valid commands given';
    break;
}

echo json_encode($aaData);

?>