<?php
    $Alert_Message  = array();

    if (isset($_POST['Login_BTN'])) {
        $Input_Username = filter_var($_POST['Input_Username'],FILTER_SANITIZE_STRING);
        $Input_Password = md5(sha1($_POST['Input_Password']));
        
        if (empty($Input_Username)) {
            $Alert_Message[] = Message_Handling($Username_Faild_Empty,'Error',$Font);
        }
        if (empty($Input_Password)) {
            $Alert_Message[] = Message_Handling($Password_Faild_Empty,'Error',$Font);
        }

        if (empty($Alert_Message)) {
            $QUERY = 'SELECT * FROM users WHERE U_Username = "'.$Input_Username.'"';
            $RESULT = mysqli_query($Connection,$QUERY);
            $ROW  = mysqli_fetch_array($RESULT, MYSQLI_ASSOC);
            $COUNT  = mysqli_num_rows($RESULT);
            if ($COUNT > 0) {
                if ($Input_Password === $ROW['U_Password']) {
                    if ($ROW['U_Status'] == 'Active') {
                        foreach ($ROW as $key => $value) {
                            $_SESSION[$key] = $value;
                        }
                        $QUERY_Permission = 'SELECT * FROM user_permission WHERE U_P_User_ID = "'.$ROW['U_ID'].'" AND Status = "Active"';
                        $RESULT_Permission = mysqli_query($Connection,$QUERY_Permission);
                        $COUNT_Permission  = mysqli_num_rows($RESULT_Permission);
                        if ($COUNT_Permission > 0) {
                        while($row = $RESULT_Permission->fetch_assoc() ){
                            $_SESSION[$row['P_Selector_page']] = "Active";
                        }
                        header('location:Manage-Task');
                        exit();
                    }
                }else {
                    $Alert_Message[] = Message_Handling($Wrong_Password,'Error',$Font);
                }
            }else {
                $Alert_Message[] = Message_Handling($No_Found_Username,'Error',$Font);
            }
        }
        }
}
?>