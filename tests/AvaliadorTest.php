<?php
namespace App\tests;

use App\Usuario;
use App\Lance;
use App\Leilao;
use App\Avaliador;

use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testDeveCalcularAMedia()
    {
        // cenario: 3 lances em ordem crescente
        $joao = new Usuario("Joao");
        $jose = new Usuario("José");
        $maria = new Usuario("Maria");

        $leilao = new Leilao("Playstation 3 Novo");

        $leilao->propoe(new Lance($maria, 300.0));
        $leilao->propoe(new Lance($joao, 400.0));
        $leilao->propoe(new Lance($jose, 500.0));

        // executando a acao
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        // comparando a saida com o esperado
        $this->assertEquals(400, $leiloeiro->getMedia(), 0.0001);
    }

    public function testAceitaLeilaoEmOrdemCrescente() 
    {
        $joao = new Usuario('Joao');
        $renan = new Usuario('Renan');
        $felipe = new Usuario('Felipe');

        $leilao = new Leilao('Playstation 3');

        $leilao->propoe(new Lance($felipe, 250));
        $leilao->propoe(new Lance($joao, 300));
        $leilao->propoe(new Lance($renan, 400));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;

        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
    }
}