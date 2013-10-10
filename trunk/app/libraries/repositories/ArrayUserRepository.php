<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/9/13
 * Time: 8:51 AM
 * To change this template use File | Settings | File Templates.
 */

class ArrayUserRepository implements UserRepository
{

    public function all()
    {
        return array("id" => "1", "accessUsername" => "abcdefgh",
            "accessKey" => "dkksdfkk342543kdfs", "username" => "keshavashta16@gmail.com",
            "created_at" => "0000-00-00 00:00:00", "updated_at" => "0000-00-00 00:00:00");
    }

    public function getUser($id, $accessUserName, $accessKey, $userName)
    {
        // TODO: Implement getUser() method.
    }

    public function addUser($accessUserName, $accessKey, $userName, $password)
    {
        // TODO: Implement addUser() method.
    }

    public function getUserList($id, $accessUserName, $accessKey, $userName)
    {
        // TODO: Implement getUserList() method.
    }
}