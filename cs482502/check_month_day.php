<?php
    //This function will check the given month and day and see if they are a valid combination.
    //For example, June 9th and January 31st are valid combinations, but February 30th and November 31st are not.
    //This function returns true if the month and day are valid, false otherwise.
    function check_month_day($month, $day){
        if($day < 1) 
            return false;
        else if(($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) && $day <= 31) 
            return true;
        else if($month == 2 && $day <= 28) 
            return true;
        else if(($month == 4 || $month == 6 || $month == 9 || $month == 11) && $day <= 30) 
            return true;
        else
            return false;
    } 
?>
