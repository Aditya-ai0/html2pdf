<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/9/13
 * Time: 9:04 AM
 * To change this template use File | Settings | File Templates.
 */

class UserControllerTest extends TestCase
{

    public function testGetList()
    {
        $mockRepo = Mockery::mock('UserRepository');
        $mockRepo->shouldReceive('all')->once()->andReturn(array('Keshav Ashta'));
        $this->app->instance('UserRepository', $mockRepo);
        $reponse = $this->call('GET', '/user/list');
        $veiw = $reponse->getContent();

       $userList=json_decode($veiw)->users;
        $this->assertTrue($userList==array('Keshav Ashta'));
    }
}