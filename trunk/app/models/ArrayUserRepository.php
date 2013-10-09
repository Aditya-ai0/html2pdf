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
        return array('Keshav Ashta');
    }
}