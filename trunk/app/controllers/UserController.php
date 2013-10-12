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

    public function postAdd()
    {
        $userName = Input::get('userName', null);
        $password = Input::get('password', null);
        if (is_null($userName) || is_null($password))
            App::abort(400, Lang::get('responseMessages.badRequest'));
        try {
            $user = $this->userService->addUser($userName, $password);
            return Response::json($user);
        } catch (InvalidArgumentException $e) {
            return Response::json(array('error' => $e->getMessage()));
        } catch (Exception $e) {
            return Response::json(array('error' => Lang::get('responseMessages.internalServer')),500);
        }


    }
}