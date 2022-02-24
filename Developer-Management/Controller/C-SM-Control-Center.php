<?php

require_once('Controller/OOP/Description-Main-Page.php');

$Alert_Message = array();

if (isset($_POST['New_Page'])) {
    $Input_Page_Name = $_POST['Input_Page_Name'];

    if (!empty($Input_Page_Name)) {
        $String_Reblace = ucwords(strtolower(str_replace(array('\'','"',',' , ';', '<', '>',' ','.','-','_','+'),' ',$Input_Page_Name)));

        if ($String_Reblace == 'Index') {
            $Page_Name = 'index';
        }else {
            $Page_Name = $String_Reblace;
        }

        $Exploade_String = implode('-',explode(' ' , $Page_Name));
        $Scan_Dir_Page = preg_grep('~\.(php)$~',scandir('../'));
        $Scan_Dir_CSS = preg_grep('~\.(css)$~',scandir('../CSS-Files/'));
        $Scan_Dir_JS = preg_grep('~\.(js)$~',scandir('../Javascript-Files/'));
        $Scan_Dir_Body = preg_grep('~\.(php)$~',scandir('../Layouts/'));
        $Scan_Dir_Controller = preg_grep('~\.(php)$~',scandir('../Controller/'));
        $Scan_Dir_AR = preg_grep('~\.(php)$~',scandir('../AR/'));
        $Scan_Dir_EN = preg_grep('~\.(php)$~',scandir('../EN/'));


        $Check_Main_Page = in_array($Exploade_String  . '.php' , $Scan_Dir_Page);
        $Check_Style_CSS = in_array('Style-' . $Exploade_String  . '.css', $Scan_Dir_CSS);
        $Check_Main_JS = in_array('Main-' . $Exploade_String  . '.js', $Scan_Dir_JS);
        $Check_Page_Body = in_array($Exploade_String  . '-Body.php', $Scan_Dir_Body);
        $Check_Controller = in_array('C-' . $Exploade_String  . '.php', $Scan_Dir_Controller);
        $Check_AR = in_array('AR-' . $Exploade_String  . '.php', $Scan_Dir_AR);
        $Check_EN = in_array('EN-' . $Exploade_String  . '.php', $Scan_Dir_EN);



        if (empty($Check_Main_Page)) {
            $MyFile = fopen('../' . $Exploade_String . '.php','w');
            $Text = DECMain::MainPage($String_Reblace,$Exploade_String);
            fwrite($MyFile, $Text);
            $Alert_Message['Success'][] = 'Success, Your [ Main Page ] Page Is Created .';
        }else {
            $Alert_Message['Error'][] = 'Sorry, Your [ Main Page ] File Is Alredy Exist , You Must Be Change The Nake Name';
        }
        if (empty($Check_Style_CSS)) {
            fopen('../CSS-Files/Style-' . $Exploade_String . '.css','w');
            $Alert_Message['Success'][] = 'Success, Your [ Style CSS ] Is Created .';
        }else {
            $Alert_Message['Error'][] = 'Sorry, Your Style [ CSS ] File Is Alredy Exist';
        }
        if (empty($Check_Main_JS)) {
            fopen('../Javascript-Files/Main-' . $Exploade_String . '.js','w');
            $Alert_Message['Success'][] = 'Success, Your [ Main Javascript ] Is Created .';
        }else {
            $Alert_Message['Error'][] = 'Sorry, Your Main [ Javascript ] File Is Alredy Exist';
        }
        if (empty($Check_Page_Body)) {
            fopen('../Layouts/'.$Exploade_String . '-Body.php','w');
            $Alert_Message['Success'][] = 'Success, Your [ Layout Body ] Page Is Created .';
        }else {
            $Alert_Message['Error'][] = 'Sorry, Your [ Body ] File Is Alredy Exist';
        }
        if (empty($Check_Controller)) {
            fopen('../Controller/C-'.$Exploade_String . '.php','w');
            $Alert_Message['Success'][] = 'Success, Your [ Controller ] Page Is Created .';
        }else {
            $Alert_Message['Error'][] = 'Sorry, Your [ Controller ] File Is Alredy Exist';
        }
        if (empty($Check_AR)) {
            fopen('../AR/AR-'.$Exploade_String . '.php','w');
            $Alert_Message['Success'][] = 'Success, Your [ Arabic ] Page Is Created .';
        }else {
            $Alert_Message['Error'][] = 'Sorry, Your [ Arabic ] File Is Alredy Exist';
        }
        if (empty($Check_EN)) {
            fopen('../EN/EN-'.$Exploade_String . '.php','w');
            $Alert_Message['Success'][] = 'Success, Your [ English ] Page Is Created .';
        }else {
            $Alert_Message['Error'][] = 'Sorry, Your [ English ] File Is Alredy Exist';
        }
    }else {
        $Alert_Message['Error'][] = 'Sorry, You Must Be Write The Page Name And Take Sure The Input Faild Is Not Empty';
    }
}





// echo '<pre>';
// print_r($sedsdsd);
// echo '</pre>';
// $Alert_Message['Success'][] = $Exploade_String  . '.php';
?>