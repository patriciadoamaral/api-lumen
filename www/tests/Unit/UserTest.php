<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class UserUnitTest extends TestCase
{

    public function testGetAll()
    {
        $user = \App\Models\User::getAll();        
        $this->assertTrue($user);
    }

    public function testGet()
    {
        $user = \App\Models\User::get(["id"=>4]);
        $this->assertTrue($user);
    }

    public function testCreate()
    {
        $user = \App\Models\User::create([
            "nome_completo"=> "Patricia Silva",
            "email"=> "patricia@picpay.com",
            "cpf"=> "41332513436",
            "senha"=> "password",
            "carteira"=> 50.00
        ]);         

        $this->seeInDatabase('users', ['email' => 'patricia@picpay.com']);

    }
    
    public function testUpdate()
    {
        $id=3;
        $user = \App\Models\User::update($id,[
            "nome_completo"=> "Patricia Silva",
            "email"=> "patricia@picpay.com",
            "cpf"=> "41332513438",
            "senha"=> "password2",
            "carteira"=> 50.00
        ]);  

        $this->seeInDatabase('users', ['id' => $id]);
    }

    public function testDelete()
    {
        $id = 1;
        $user = \App\Models\User::delete($id);
        $this->seeInDatabase('users', ['id' => $id]);
    }
}
