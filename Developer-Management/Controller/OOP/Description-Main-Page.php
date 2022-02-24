<?php

class DECMain{
    static function MainPage($PAGE_TITLE,$PAGE_NAME){
return '
<?php
    include \'Controller/Function/C-F-Timezone.php\';
    include \'Controller/Function/C-F-Date-And-Time.php\';
    include \'Controller/Config.php\';
    include \'Controller/Function/C-F-Language.php\';
    include IncludeFileByLanguage(\'Header\',$_SESSION[\'Language\']);
    include IncludeFileByLanguage(\'Style\',$_SESSION[\'Language\']);
    include IncludeFileByLanguage(\'Footer\',$_SESSION[\'Language\']);
    include IncludeFileByLanguage(\'' . $PAGE_NAME . '\',$_SESSION[\'Language\']);
    include \'Controller/Function/C-F-AlertMessage.php\';
    include \'Controller/C-' . $PAGE_NAME . '.php\';

    if (!$_SESSION[\'U_ID\']) {
        header(\'location: ./ \');
    }
?>
<!DOCTYPE html>
<html lang="<?php echo strtolower($_SESSION[\'Language\']); ?>" dir="<?php echo $Direction?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $System_Name;?> | ' . $PAGE_TITLE . ' </title>
    <!-- Start The Links Files -->
    <?php include ("Links CSS In Head Area.php"); ?>
    <link rel="stylesheet" href="CSS-Files/Style-' . $PAGE_NAME . '.css">
    <!-- End The Links Files -->
</head>

<body>

    <!-- Start The Header -->
    <?php include ("Layouts/Header.php"); ?>
    <!-- End The Header-->

    <?php include ("Layouts/' . $PAGE_NAME . '-Body.php"); ?>

    <!-- Start The Footer -->
    <?php include ("Layouts/Footer.php"); ?>
    <!-- End The Footer-->

    <!-- Start The Links Files -->
    <?php include ("Links Javascript In Footer Area.php"); ?>
    <script type="text/javascript" src="Javascript-Files/Main-' . $PAGE_NAME . '.js"></script>
    <!-- End The Links Files -->
</body>

</html>';
    }
}