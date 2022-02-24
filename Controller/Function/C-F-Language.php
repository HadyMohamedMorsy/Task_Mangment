<?php

    // $LANGUAGE_SYSTEM = 'EN';
    if (!isset($_SESSION['Language']) or empty($_SESSION)) {
        $_SESSION['Language'] = 'EN';
    }
    if (isset($_POST['English'])) {
        $_SESSION['Language'] = 'EN';
        header("Refresh:0");
    }
    if (isset($_POST['Arabic'])) {
        $_SESSION['Language'] = 'AR';
        header("Refresh:0");
    }

    
    function IncludeFileByLanguage($PAGE_NAME,$LANGUAGE){
        return $LANGUAGE . '/' . $LANGUAGE . '-' . $PAGE_NAME . '.php';
    }
?>