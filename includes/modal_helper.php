<?php
    session_start();
    $sel = $_POST['sel'];
    if($sel == 'program'){
        $_SESSION['sel'] = 'PRG_ENROLLED';
        $eng_statement = $_SESSION['eng_statement'];
        $_SESSION['eng_statement'] = "$eng_statement and have completed a program";
    }
    elseif($sel == 'course'){
        $_SESSION['sel'] = 'CRS_ENROLLED';
        $eng_statement = $_SESSION['eng_statement'];
        $_SESSION['eng_statement'] = "$eng_statement and have completed a course";
    }
    else{
        $_SESSION['sel'] = 'CERT_EARNED';
        $eng_statement = $_SESSION['eng_statement'];
        $_SESSION['eng_statement'] = "$eng_statement and have completed a certificate";
    }
?>