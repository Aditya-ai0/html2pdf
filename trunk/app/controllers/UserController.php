<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/9/13
 * Time: 8:46 AM
 * To change this template use File | Settings | File Templates.
 */

class UserController extends BaseController
{

    private $users;

    public function __construct(UserRepository $userRepo)
    {
        $this->users = $userRepo;
    }

    public function getList()
    {
        $userList = $this->users->all();
        return Response::json(array('users' => $userList));
    }
}