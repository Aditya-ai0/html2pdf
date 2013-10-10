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

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getList()
    {
        $userList = $this->userService->getAll();
        return Response::json(array('users' => $userList));
    }
}