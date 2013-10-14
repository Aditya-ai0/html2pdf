<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 12:13 PM
 * To change this template use File | Settings | File Templates.
 */

class Transaction extends Eloquent
{

    protected $table = "transactions";

//$transaction->converterId = $converterId;
//$transaction->isKilled = $isKilled;
//$transaction->userId = $userId;
//$transaction->fileName = $fileName;
//$transaction->fileSize = $fileSize;
//$transaction->tokens = $tokens;
//$transaction->startTime = $startTime;
//$transaction->endTime = $endTime;
//$transaction->processId = $processId;

    public static $factory = array(
        'id' => 'integer',
        'converterId' => 'integer',
        'userId' => 'integer',
        'fileName' => 'string',
        'fileSize' => 'integer',
        'tokens' => 'integer',
        'startTime' => 'call|currentDate',
        'endTime' => 'call|currentDate',
        'processId' => 'integer'
    );

    public static function currentDate()
    {
        return gmdate('Y-m-d H:i:s');
    }
}