<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gregwar\Captcha\CaptchaBuilder;
use Session;
/**
 * Some tools
 */
class KitController extends Controller{
    /**
     * Show the captcha
     * @param string $tmp random string
     * @param string $captcha_name captcha session name
     * @param int $width picture width
     * @param int $height picture height
     *
     * @return Response
     */
    public function captcha($captcha_name = 'captcha', $width = 100, $height = 40) {
        $builder = new CaptchaBuilder;
        $builder->build($width, $height, $font = null);
        $phrase = $builder->getPhrase();

        Session::flash($captcha_name, $phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
