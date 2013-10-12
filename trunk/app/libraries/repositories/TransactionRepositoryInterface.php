<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 12:16 PM
 * To change this template use File | Settings | File Templates.
 */

interface TransactionRepositoryInterface
{

    public function create($converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                           $processId, $isKilled);

    public function getTransaction($id, $converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                                   $processId, $isKilled);

    public function updateTransaction($id, $converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                                      $processId, $isKilled);

}