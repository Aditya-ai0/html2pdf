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
        $userList = array("id" => "1", "accessUsername" => "abcdefgh",
            "accessKey" => "dkksdfkk342543kdfs", "username" => "kashta@greenapplesolutions.com",
            "created_at" => "0000-00-00 00:00:00", "updated_at" => "0000-00-00 00:00:00");
        $mockRepo->shouldReceive('all')->once()->andReturn($userList);
        $this->app->instance('UserRepository', $mockRepo);
        $reponse = $this->call('GET', '/user/list');
        $response = $reponse->getContent();

        $userList = json_decode($response)->users;
        $this->assertTrue($userList == $userList);
    }
}