<?php
    function check_month_day($month, $day){
        if($day < 1) 
            return false;
        else if(($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) && $day <= 31) 
            return true;
        else if($month == 2 && $day <= 29) 
            return true;
        else if(($month == 4 || $month == 6 || $month == 9 || $month == 11) && $day <= 30) 
            return true;
        else
            return false;
    } 
?>
