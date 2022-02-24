<?php

function CurrentDate(){
    return date('Y/m/d');
}

function CurrentTime(){
    return date('h:i:s A');
}

function CurrentDateAndTime(){
    return CurrentDate() . ' ' . CurrentTime() ;
}


?>

