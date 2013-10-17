<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 12/10/13
 * Time: 3:04 PM
 * To change this template use File | Settings | File Templates.
 */

class ConverterStatuses
{
    const IDLE = 0;
    const BUSY = 1;
}

class HTTPConstants
{
    const SUCCESS_CODE = 200;
    const RESOURCE_CREATED = 201;
    const RESOURCE_CHANGED = 202;
    const RESOURCE_DELETED = 204;
    const NOT_FOUND = 400;
    const AUTHENTICATION_FAILED = 401;
    const TIME_OUT = 408;
    const HTTP_METHOD_NOT_FOUND = 405;
    const DATABASE_ERROR_CODE = 500;
    const SERVICE_NOT_AVAILABLE = 500;
}

