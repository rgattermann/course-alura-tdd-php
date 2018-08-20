<?php
namespace App;

class Avaliador 
{
    private $maiorDeTodos = -INF;
    private $menorDeTodos = INF;
    private $media = 0;

    public function avalia(Leilao $leilao)
    {
        $total = 0;
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorDeTodos) {
                $this->maiorDeTodos = $lance->getValor();
            }
            
            if ($lance->getValor() < $this->menorDeTodos) {
                $this->menorDeTodos = $lance->getValor();
            }
            
            $total += $lance->getValor();
        }

        $this->media = $total / count($leilao->getLances());
    }

    public function getMaiorLance()
    {
        return $this->maiorDeTodos;
    }
    
    public function getMenorLance()
    {
        return $this->menorDeTodos;
    }

    public function getMedia()
    {
        return $this->media;
    }
}

