<?php namespace helpers;

class validate {
    static public function isDate($date) {
        return \DateTime::createFromFormat('Y-m-d', $date) !== FALSE;
    }
}
