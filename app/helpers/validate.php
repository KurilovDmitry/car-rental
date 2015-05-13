<?php namespace helpers;

class validate {
    function isDate($date) {
        return DateTime::createFromFormat('Y-m-d G:i:s', $date) !== FALSE;
    }
}
