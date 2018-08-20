<?php
namespace App\tests;

use App\Usuario;
use App\Lance;
use App\Leilao;
use App\Avaliador;

use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
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

    public function testAceitaLeilaoGrandesEmOrdemCrescente()
    {
        $joao = new Usuario('Joao');
        $renan = new Usuario('Renan');
        $felipe = new Usuario('Felipe');

        $leilao = new Leilao('Playstation 3');

        $leilao->propoe(new Lance($felipe, 2500));
        $leilao->propoe(new Lance($joao, 3000));
        $leilao->propoe(new Lance($renan, 4000));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 4000;
        $menorEsperado = 2500;

        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDeveAceitarApenasUmLance()
    {
        $joao = new Usuario('Joao');

        $leilao = new Leilao('Playstation 3');

        $leilao->propoe(new Lance($joao, 3000));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 3000;
        $menorEsperado = 3000;

        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDevePegarOsTresMaiores()
    {
        $leilao = new Leilao('Playstation 4');

        $renan = new Usuario('Renan');
        $mauricio = new Usuario('Mauricio');

        $leilao->propoe(new Lance($renan, 200));
        $leilao->propoe(new Lance($mauricio, 300));
        $leilao->propoe(new Lance($renan, 400));
        $leilao->propoe(new Lance($mauricio, 500));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertEquals(3, count($leiloeiro->getMaiores()));
        $this->assertEquals(500, $leiloeiro->getMaiores()[0]->getValor());
        $this->assertEquals(400, $leiloeiro->getMaiores()[1]->getValor());
        $this->assertEquals(300, $leiloeiro->getMaiores()[2]->getValor());
    }

    public function testAceitaLeilaoComUmLance()
    {
        $joao = new Usuario("Joao");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 250;
        $menorEsperado = 250;

        $this->assertEquals($leiloeiro->getMaiorLance(), $maiorEsperado);
        $this->assertEquals($leiloeiro->getMenorLance(), $menorEsperado);
    }

    public function testDeveEntenderLeilaoComLancesEmOrdemRandomica()
    {
        $joao = new Usuario("Joao");
        $maria = new Usuario("Maria");

        $leilao = new Leilao("Playstation 3 Novo");

        $leilao->propoe(new Lance($joao, 200.0));
        $leilao->propoe(new Lance($maria, 450.0));
        $leilao->propoe(new Lance($joao, 120.0));
        $leilao->propoe(new Lance($maria, 700.0));
        $leilao->propoe(new Lance($joao, 630.0));
        $leilao->propoe(new Lance($maria, 230.0));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertEquals(700.0, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(120.0, $leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDeveEntenderLeilaoComLancesEmOrdemDecrescente()
    {
        $joao = new Usuario("Joao");
        $maria = new Usuario("Maria");

        $leilao = new Leilao("Playstation 3 Novo");

        $leilao->propoe(new Lance($joao, 400.0));
        $leilao->propoe(new Lance($maria, 300.0));
        $leilao->propoe(new Lance($joao, 200.0));
        $leilao->propoe(new Lance($maria, 100.0));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertEquals(400.0, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(100.0, $leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDeveDevolverListaVaziaCasoNaoHajaLances () {
        $leilao = new Leilao("Playstation 3 Novo");

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getMaiores();

        $this->assertEquals(0, count($maiores));
    }
}