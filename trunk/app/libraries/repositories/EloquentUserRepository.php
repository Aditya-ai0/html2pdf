<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 12:29 PM
 * To change this template use File | Settings | File Templates.
 */

class EloquentUserRepository implements UserRepository
{

    public function all()
    {
        try {
            return User::all()->toArray();
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getUser($id, $accessUserName, $accessKey, $userName)
    {
        try {
            $query = User::getQuery();
            if ($id)
                $query->where('id', '=', $id);
            if ($accessUserName)
                $query->where('accessUsername', '=', $accessUserName);
            if ($accessKey)
                $query->where('accessKey', '=', $accessKey);
            if ($userName)
                $query->where('username', '=', $userName);
            return $query->first()->toArray();
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
            return $user->toArray();
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getUserList($id, $accessUserName, $accessKey, $userName)
    {
        // TODO: Implement getUserList() method.
    }
}