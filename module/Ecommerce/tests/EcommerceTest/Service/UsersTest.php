<?php

namespace EcommerceTest\Service;

use Ecommerce\V1\Rest\Users\UsersMapper;
use Ecommerce\V1\Rest\Users\UsersService;
use Zend\ServiceManager\ServiceManager;

class EcommerceTest extends \PHPUnit_Framework_TestCase
{
    /** @var UsersService */
    protected $instance;

    public function setUp()
    {
        $this->instance = new UsersService();

        $sm = new ServiceManager();
        $this->instance->setServiceLocator($sm);
    }

    public function testCreateUser()
    {
        $newUser = new \Ecommerce\V1\Rest\Users\UsersEntity();

        $mapperUsersMock = $this->getMock('Ecommerce\V1\Rest\Users\UsersMapper');
        $mapperUsersMock
            ->expects($this->once())
            ->method('store')
            ->with($newUser)
            ->will($this->returnSelf());
        $mapperUsersMock
            ->expects($this->once())
            ->method('flush')
            ->with($newUser);
        $this->instance->getServiceLocator()->setService('mapper.user', $mapperUsersMock);

        $this->instance->getServiceLocator()->setService('entity.user', $newUser);

        $response = $this->instance->createUser([
            'username'  => 'batman',
            'firstname' => 'Bruce',
            'lastname'  => 'Wayne'
        ]);

        $this->assertSame($newUser, $response);
        $this->assertEquals('batman', $response->getUsername());
        $this->assertEquals('Bruce', $response->getFirstname());
        $this->assertEquals('Wayne', $response->getLastname());
    }
}