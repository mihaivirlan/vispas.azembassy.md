<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lang;

class DataController extends Controller
{
    public static $month = array(

        'en' => array( 1=>'January','February','March','April','May','June','July','August','September','October','November','December'),

        'ru' => array( 1=>'январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь') ,

        'ro' => array( 1=>'Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie') ,

    );

    public static function getDateBlogs ($date ) {
        $time = strtotime( $date );
        $day = date('d', $time );
        $month = (int) date('m', $time );
        $year = date('Y', $time );
        return $day.' '.self::$month[Lang::getLocale()][ $month ].', '.$year;
    }
}
