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

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getUser($id, $accessUserName, $accessKey, $userName)
    {
        return $this->userRepo->getUser($id, $accessUserName, $accessKey, $userName);
    }

    public function getAll()
    {
        return $this->userRepo->all();
    }

    public function getUserList($id, $accessUserName, $accessKey, $userName)
    {
        return $this->userRepo->getUserList($id, $accessUserName, $accessKey, $userName);
    }

    public function addUser($userName, $password)
    {
        $user = $this->getUser(null, null, null, $userName);
        if ($user)
            throw new InvalidArgumentException("User already exist");
        return $this->userRepo->addUser(Util::GUID(), Util::GUID(), $userName, Hash::make($password));
    }


}