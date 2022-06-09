<?php

if(!function_exists('formatDate')) {
    function formatDate($date, string $format = 'Y-m-d') 
    {
        // Early exist if $date is null
        if(!isset($date)) {
            return '-';
        }
        
        // If $date is an instance of Carbon, we can format it according to the desired format
        if ($date instanceof \Carbon\Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}