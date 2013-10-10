<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/9/13
 * Time: 8:49 AM
 * To change this template use File | Settings | File Templates.
 */

interface UserRepository
{

    public function all();

    public function getUser($id, $accessUserName, $accessKey, $userName);

    public function addUser($accessUserName, $accessKey, $userName, $password);

    public function getUserList($id, $accessUserName, $accessKey, $userName);

}