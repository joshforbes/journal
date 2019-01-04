<?php

namespace App;

class EmailAddressParser
{
    public static function parse($addressString)
    {
        return str_after(str_before($addressString, '>'), '<');
    }
}