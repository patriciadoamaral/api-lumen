<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    public function testGetAll()
    {
        $response = $this->call('GET', '/api/users');

        //Confere se o status do resultado é 200
        $this->assertEquals(200, $response->status());

        //Confere se traz um dado específico
        /*$this->seeJson([
            'cpf' => '96772073457',
        ]);*/
    }

    public function testGet()
    {
        $response = $this->call('GET', '/api/user/1');

        $this->assertEquals(200, $response->status());
    }

    public function testCreate()
    {
        $params = array(
            "nome_completo"=> "Patricia Silva",
            "email"=> "patricia@email.com",
            "cpf"=> "41332513438",
            "senha"=> "password",
            "carteira"=> 50.00
        );  

        $response = $this->call('POST', '/api/user', $params);

        $this->assertEquals(400, $response->status());

    }
    
    public function testUpdate()
    {
        $params = array(
            "nome_completo"=> "Patricia Silva",
            "email"=> "patricia@picpay.com",
            "cpf"=> "41332513438",
            "senha"=> "password2",
            "carteira"=> 50.00
        );  

        $response = $this->call('PUT', '/api/user/2', $params);

        $this->assertEquals(400, $response->status());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', '/api/user/1');

        $this->assertEquals(400, $response->status());
    }
}
