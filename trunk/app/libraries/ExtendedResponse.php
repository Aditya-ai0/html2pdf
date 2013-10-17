<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 17/10/13
 * Time: 3:33 PM
 * To change this template use File | Settings | File Templates.
 */
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExtendedResponse extends \Illuminate\Support\Facades\Response
{


    public static function binary($file, $name = null, array $headers = array())
    {
        return new BinaryFileResponse($file, 200, $headers, true, null);
    }
}