<?php

if(!function_exists('booktypesString')) {
    function booktypesString($booktypes) : string
    {
        $typesString = '';

        $count = 0;
        foreach($booktypes as $booktype) {
            if($count == 0) {
                $typesString .= $booktype->name;
            }
            else {
                $typesString .= ', ' . $booktype->name;
            }

            $count++;
        }

        return !empty($typesString) ? $typesString : '-';
    }
}

if(!function_exists('bookAvgRating')) {
    function bookAvgRating($book, int $precision = 2)
    {
        return isset($book->average_rating) ? round($book->average_rating, $precision) : '-';
    }
}