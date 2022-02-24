<?php
    include 'Controller/Function/C-F-Timezone.php';
    include 'Controller/Function/C-F-Date-And-Time.php';
    include 'Controller/Config.php';
    include 'Controller/Function/C-F-Language.php';
    include IncludeFileByLanguage('Header',$_SESSION['Language']);
    include IncludeFileByLanguage('Style',$_SESSION['Language']);
    include IncludeFileByLanguage('Footer',$_SESSION['Language']);
    include IncludeFileByLanguage('Manage-Task',$_SESSION['Language']);
    include 'Controller/Function/C-F-AlertMessage.php';
    include 'Controller/Function/C-F-Length-Max.php';
    if (!$_SESSION['U_ID']) {
        header('location: ./ ');
        exit();
    }
?>

<?php include ("Links CSS In Head Area.php"); ?>

<?php include ("Layouts/Mamanage-Users-Test-Body.php"); ?>

<?php include ("Links Javascript In Footer Area.php"); ?>
<script src="/Javascript-Files/Main-Header.js" ></script>

