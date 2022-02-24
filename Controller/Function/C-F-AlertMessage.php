<?php
    function Message_Handling($Message, $Type, $Font = '', $Dir = ''){
        $Return_Error_Message = array();
        $Type_Message = array('Error','Success','Warning ','Secondary ' , 'Primary') ;
        $Font_Family = array('Kufi-Normal' , 'Arial');
        $Dir_Or_Align =  array('RTL','LTR','Center');
        $Message_Direction = '';
        $Message_Center = '';
        
        if (!in_array($Type,$Type_Message)) {
            $Return_Error_Message[] = '  <div class="alert alert-info  mt-3 text-center" role="alert" dir="ltr">
                        You Have Error In [ Message_Handling ] Function Type , Pleas Write The Correct Message Type .
                    </div>';
        }
        if (!empty($Dir)) {
            if (!in_array($Dir,$Dir_Or_Align)) {
                $Return_Error_Message[] = '  <div class="alert alert-info  mt-3 text-center" role="alert" dir="ltr">
                            You Have Error In [ Message_Handling ] Function Type , Pleas Write The Correct Dir .
                        </div>';
            }
        }
        if (!empty($Font)) {
            if (!in_array($Font,$Font_Family)) {
                $Return_Error_Message[] = '  <div class="alert alert-info  mt-3 text-center" role="alert" dir="ltr">
                            You Have Error In [ Message_Handling ] Function Type , Pleas Write The Correct Font .
                        </div>';
            }
        }
        if(empty($Return_Error_Message)) {
            if ($Type == 'Error') {
                $Alert_Type = 'danger';
            }
            if ($Type == 'Success') {
                $Alert_Type = 'success';
            }
            if ($Type == 'Warning') {
                $Alert_Type = 'warning';
            }
            if ($Type == 'Secondary') {
                $Alert_Type = 'secondary';
            }
            if ($Type == 'Primary') {
                $Alert_Type = 'primary';
            }
            if ($Dir == 'RTL') {
                $Message_Direction = 'dir="rtl"';
            }
            if ($Dir == 'LTR') {
                $Message_Direction = 'dir="ltr"';
            }
            if ($Dir == 'Center') {
                $Message_Center = 'text-center';
            }
            return '<div class="alert alert-' . $Alert_Type . ' ' . $Message_Center . ' ' . $Font . ' mt-3" role="alert" ' . $Message_Direction . '>' . $Message . '</div>';
        }else {
            foreach ($Return_Error_Message as $key => $value) {
                echo $value;
            }
        }
    }

    function Alert_Message($Array = array()){
        foreach ($Array as $key => $value) {
            echo $value;
        }
    }
?>
