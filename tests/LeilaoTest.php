<?php
namespace App\tests;

use App\Leilao;
use App\Lance;
use App\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function testDeveReceberUmLance()
    {
        $leilao = new Leilao("Macbook Pro 15");
        $this->assertEquals(0, count($leilao->getLances()));

        $leilao->propoe(new Lance(new Usuario("Steve Jobs"), 2000));

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor(), 0.00001);
    }

    public function testDeveReceberVariosLances()
    {
        $leilao = new Leilao("Macbook Pro 15");
        $leilao->propoe(new Lance(new Usuario("Steve Jobs"), 2000));
        $leilao->propoe(new Lance(new Usuario("Steve Wozniak"), 3000));

        $this->assertEquals(2, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor(), 0.00001);
        $this->assertEquals(3000, $leilao->getLances()[1]->getValor(), 0.00001);
    }

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

    public function testDeveDarNoMaximo5Lances()
    {
        $leilao = new Leilao('Notebook dell');

        $jobs = new Usuario('Jobs');
        $gates = new Usuario('Gates');

        $leilao->propoe(new Lance($jobs, 2000));
        $leilao->propoe(new Lance($gates, 2100));

        $leilao->propoe(new Lance($jobs, 2200));
        $leilao->propoe(new Lance($gates, 2300));

        $leilao->propoe(new Lance($jobs, 2400));
        $leilao->propoe(new Lance($gates, 2500));

        $leilao->propoe(new Lance($jobs, 2600));
        $leilao->propoe(new Lance($gates, 2700));

        $leilao->propoe(new Lance($jobs, 2800));
        $leilao->propoe(new Lance($gates, 3000));

        $leilao->propoe(new Lance($jobs, 3100));

        $this->assertEquals(10, count($leilao->getLances()));

        $ultimo = count($leilao->getLances()) - 1;
        $ultimoLance = $leilao->getLances()[$ultimo];

        $this->assertEquals(3000, $ultimoLance->getValor(), 0.00001);
    }
}