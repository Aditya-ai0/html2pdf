<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 6:57 PM
 * To change this template use File | Settings | File Templates.
 */

interface ConverterRepository
{

    public function addConverter($name, $location, $status);

    public function getConverter($id, $name, $location, $status);

    public function all();

    public function getConverterList($name, $location, $status);
}