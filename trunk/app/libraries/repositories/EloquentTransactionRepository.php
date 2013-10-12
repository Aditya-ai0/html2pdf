<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 6:35 PM
 * To change this template use File | Settings | File Templates.
 */

class EloquentTransactionRepositoryInterface implements TransactionRepositoryInterface
{

    public function create($converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                           $processId, $isKilled)
    {
        try {
            $transaction = new Transaction();
            $transaction->converterId = $converterId;
            $transaction->userId = $userId;
            $transaction->fileName = $fileName;
            $transaction->fileSize = $fileSize;
            $transaction->tokens = $tokens;
            $transaction->startTime = $startTime;
            $transaction->endTime = $endTime;
            $transaction->processId = $processId;
            $transaction->isKilled = $isKilled;
            $transaction->save();
            return $transaction;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getTransaction($id, $converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                                   $processId, $isKilled)
    {
        try {
            $query = Transaction::getQuery();
            if (!is_null($id))
                $query->where('id', '=', $id);
            if (!is_null($converterId))
                $query->where('converterId', '=', $converterId);
            if (!is_null($userId))
                $query->where('userId', '=', $userId);
            if (!is_null($fileName))
                $query->where('fileName', '=', $fileName);
            if (!is_null('fileSize'))
                $query->where('fileSize', '=', $fileSize);
            if (!is_null($tokens))
                $query->where('tokens', '=', $tokens);
            if (!is_null($startTime))
                $query->where('startTime', '=', $startTime);
            if (!is_null($endTime))
                $query->where('endTime', '=', $endTime);

        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function updateTransaction($id, $converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                                      $processId, $isKilled)
    {
        try {
            $transaction = Transaction::where('id', '=', $id)->first();
            if (!is_null($fileName))
                $transaction->fileName = $fileName;
            if (!is_null($userId))
                $transaction->userId = $userId;
            if (!is_null($fileSize))
                $transaction->fileSize = $fileSize;
            if (!is_null($tokens))
                $transaction->tokens = $tokens;
            if (!is_null($startTime))
                $transaction->startTime = $startTime;
            if (!is_null($endTime))
                $transaction->endTime = $endTime;
            if (!is_null($processId))
                $transaction->processId = $processId;
            if (!is_null($isKilled))
                $transaction->isKilled = $isKilled;
            $transaction->save();
            return $transaction;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}