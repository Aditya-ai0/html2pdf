<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/10/13
 * Time: 2:00 PM
 * To change this template use File | Settings | File Templates.
 */

class TransactionService
{
    private $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function create($converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                           $processId, $isKilled)
    {
        return $this->transactionRepository->create($converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
            $processId, $isKilled);

    }

    public function updateTransaction($id, $converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
                                      $processId, $isKilled)
    {
        return $this->transactionRepository->updateTransaction($id, $converterId, $userId, $fileName, $fileSize, $tokens, $startTime, $endTime,
            $processId, $isKilled);
    }
}