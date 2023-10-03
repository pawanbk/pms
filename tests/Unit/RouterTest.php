<?php
namespace Tests\Unit;

use core\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase{
    
    public function test_that_router_can_be_registered() :void{
        $router = new Router();
        $router->register('get','/users',['Users','index']);

        $expected=[
            'get' =>[
                '/users' => ['Users', 'index']
            ]
        ];

        $this->assertEquals($expected, $router->routes());


    }
}