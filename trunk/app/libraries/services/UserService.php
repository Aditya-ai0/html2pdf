<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 1:19 PM
 * To change this template use File | Settings | File Templates.
 */

class UserService
{

    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getUser($accessUserName, $accessKey)
    {
        return $this->userRepo->getUser(null, $accessUserName, $accessKey, null);
    }

    public function getAll()
    {
        return $this->userRepo->all();
    }

    public function getUserList($id, $accessUserName, $accessKey, $userName)
    {
        return $this->userRepo->getUserList($id, $accessUserName, $accessKey, $userName);
    }


}