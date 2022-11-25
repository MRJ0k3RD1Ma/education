<?php

namespace frontend\components;

class General
{
    public static function PrettyNumber($number){
        return number_format($number, 0, ',', ' ');
    }
}