<?php
namespace App\Libraries;

class Simhash
{
    protected static $length = 64;
    protected static $search = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
    protected static $replace = array('0000','0001','0010','0011','0100','0101','0110','0111','1000','1001','1010','1011','1100','1101','1110','1111');

    public static function get(array &$set)
    {
        $boxes = array_fill(0, self::$length, 0);
        if (is_int(key($set)))
            $dict = array_count_values($set);
        else
            $dict = &$set;
        foreach ($dict as $element => $weight) {

			$hash = hash('md5', $element);
			$hash = str_replace(self::$search, self::$replace, $hash);
			$hash = substr($hash, 0, self::$length);
			$hash = str_pad($hash, self::$length, '0', STR_PAD_LEFT);

            for ( $i=0; $i < self::$length; $i++ ) {
				$boxes[$i] += ($hash[$i] == '1') ? $weight : -$weight;
            }
        }
        $s = '';
        foreach ($boxes as $box) {
            if ($box > 0)
                $s .= '1';
            else
                $s .= '0';
        }

        return $s;
    }

    public static function hd($h1, $h2)
    {
        $dist = 0;
        for ($i=0;$i<self::$length;$i++) {
            if ( $h1[$i] != $h2[$i] )
                $dist++;
        }
        return (self::$length - $dist) / self::$length;
    }
}
