<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 12:29 PM
 * To change this template use File | Settings | File Templates.
 */

class EloquentUserRepository implements UserRepositoryInterface
{

    public function all()
    {
        try {
            return User::all();
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getUser($id, $accessUserName, $accessKey, $userName)
    {
        try {
            $query = User::getQuery();
            if (!is_null($id))
                $query->where('id', '=', $id);
            if (!is_null($accessUserName))
                $query->where('accessUsername', '=', $accessUserName);
            if (!is_null($accessKey))
                $query->where('accessKey', '=', $accessKey);
            if (!is_null($userName))
                $query->where('username', '=', $userName);
            return $query->first();
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function addUser($accessUserName, $accessKey, $userName, $password)
    {
        try {
            $user = new User();
            $user->accessUsername = $accessUserName;
            $user->accessKey = $accessKey;
            $user->username = $userName;
            $user->password = $password;
            $user->save();
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getUserList($id, $accessUserName, $accessKey, $userName)
    {
        // TODO: Implement getUserList() method.
    }

    public function createUser($accessUsername, $accessKey, $userName, $password)
    {
        // TODO: Implement createUser() method.
    }
}