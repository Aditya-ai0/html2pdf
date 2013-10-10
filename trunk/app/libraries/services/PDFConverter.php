<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/10/13
 * Time: 3:01 PM
 * To change this template use File | Settings | File Templates.
 */

interface PDFConverter
{
    public function convert($html);
}