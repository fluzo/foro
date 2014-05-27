<?php
//namespace utilidades;
class Utilidades
{

    public static function fluzo_nl2br($string)
    {
        $string = nl2br($string);
        $string = str_replace("\n", "", $string);
        $string = str_replace("\r", "", $string);
        if (preg_match_all('/\<pre\>(.*?)\<\/pre\>/', $string, $match))
        {
            foreach ($match as $a)
            {
                foreach ($a as $b)
                {
                    $string = str_replace('<pre>' . $b . '</pre>', "<pre>" . str_replace("<br />", PHP_EOL, $b) . "</pre>", $string);
                }
            }
        }

//        $string = str_replace("<br /><br /><br /><pre>", '<br /><br /><pre>', $string);
//        $string = str_replace("</pre><br /><br />", '</pre><br />', $string);
        return $string;
    }

}
