<?php
namespace App;

class FiltroDeLances 
{
    public function filtra(array $lances) 
    {
        $resultado = [];

        foreach($lances as $lance) {
            if($lance->getValor() > 1000 && $lance->getValor() < 3000) {
                $resultado[] = $lance;
            } else if($lance->getValor() > 500 && $lance->getValor() < 700) {
                $resultado[] = $lance;
            } else if($lance->getValor() > 5000) {
                $resultado[] = $lance;
            }
        }

        return $resultado;
    }
}