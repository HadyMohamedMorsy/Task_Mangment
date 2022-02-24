<?php
    function Alert_Message($Alert_Message = null){
        foreach ($Alert_Message as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($key == 'Success') {
                    echo '  <div class="alert alert-success mt-3" role="alert">
                                '.$value2.'
                            </div>';
                }elseif ($key == 'Error') {
                    echo '  <div class="alert alert-danger mt-3" role="alert">
                                '.$value2.'
                            </div>';
                }
            }
        }
    }
?>
