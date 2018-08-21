<?php
namespace App\tests;

use App\Usuario;
use App\Lance;
use App\FiltroDeLances;

use PHPUnit\Framework\TestCase;
use App\Leilao;

class FiltroDeLancesTest extends TestCase
{
    public function testDeveSelecionarLancesEntre1000E3000()
    {
        $joao = new Usuario('João');
        $filtro = new FiltroDeLances;

        $resultado = $filtro->filtra([
            new Lance($joao, 2000),
            new Lance($joao, 1000),
            new Lance($joao, 3000),
            new Lance($joao, 800)
        ]);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(2000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700()
    {
        $joao = new Usuario('João');

        $filtro = new FiltroDeLances;
        
        $resultado = $filtro->filtra([
            new Lance($joao, 600),
            new Lance($joao, 500),
            new Lance($joao, 700),
            new Lance($joao, 800),
        ]);

        $this->assertEquals(1, count($resultado));

        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesMaioresQue5000()
    {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();

        $resultado = $filtro->filtra([
            new Lance($joao, 10000),
            new Lance($joao, 800),
        ]);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(10000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveEliminarMenoresQue500()
    {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = $filtro->filtra([
            new Lance($joao, 400),
            new Lance($joao, 300),
        ]);
        $this->assertEquals(0, count($resultado));
    }

    public function testDeveEliminarEntre3000E5000()
    {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();

        $resultado = $filtro->filtra([
            new Lance($joao, 4000),
            new Lance($joao, 3500),
        ]);

        $this->assertEquals(0, count($resultado));
    }
}