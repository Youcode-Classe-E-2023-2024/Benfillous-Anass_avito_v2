<?php
    function htmlChecker($string) {
        if (str_contains(strtolower($string),"style") || str_contains(strtolower($string),"script"))
            return true;
        return false;

    }
?>
