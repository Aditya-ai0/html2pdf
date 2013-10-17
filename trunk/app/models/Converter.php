<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 6:40 PM
 * To change this template use File | Settings | File Templates.
 */

class Converter extends Eloquent
{

    protected $table = "converters";

    public static $factory = array(
        'id' => 'integer',
        'name' => 'string',
        'location' => 'string',
        'status' => ConverterStatuses::IDLE
    );

    protected $fillable = array('id',
        'name',
        'location',
        'status');
}