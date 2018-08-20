<?php
namespace App\tests;

use App\Leilao;
use App\Lance;
use App\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function testDeveProporUmLance()
    {
        $leilao = new Leilao('Macbook caro');

        $this->assertEquals(0, count($leilao->getLances()));

        $joao = new Usuario('João');

        $leilao->propoe(new Lance($joao, 2000));
        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
    }

    public function testDeveBarrarDoisLancesSeguidos()
    {
        $leilao = new Leilao('Macbook caro');
        $joao = new Usuario('João');

        $leilao->propoe(new Lance($joao, 2000));
        $leilao->propoe(new Lance($joao, 3000));

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
    }
}