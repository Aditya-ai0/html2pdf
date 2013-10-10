<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 6:05 PM
 * To change this template use File | Settings | File Templates.
 */

class HTML2PdfService
{

    public function validateRequest($url, $HTMLContent)
    {
        if ($url || $HTMLContent) {
            return true;
        }
        return false;
    }

}