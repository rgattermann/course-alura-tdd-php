<?php
namespace App;

class Leilao 
{
	private $descricao;
	private $lances;
	
	function __construct($descricao) 
	{
		$this->descricao = $descricao;
		$this->lances = [];
	}
	
	public function propoe(Lance $lance) 
	{
		$total = 0;

		foreach ($this->lances as $lanceAtual) {
			if ($lanceAtual->getUsuario() == $lance->getUsuario()) {
				$total++;
			}
		}

		if ((count($this->lances) == 0) || $this->podeDarLance($lance->getUsuario())) {
			$this->lances[] = $lance;
		}
	}

	private function podeDarLance(Usuario $usuario)
	{
		return !($this->pegaUltimoLance()->getUsuario()->getNome() == $usuario->getNome())
			&& $this->getTotalLancesUsuario($usuario) < 5;
	}

	private function getTotalLancesUsuario(Usuario $usuario)
	{
		$total = 0;
		foreach ($this->lances as $lance) {
			if ($lance->getUsuario()->getNome() == $usuario->getNome()) {
				$total++;
			} 
		}
		return $total;
	}

	public function pegaUltimoLance()
	{
		return $this->lances[count($this->lances) - 1];
	}

	public function getDescricao() 
	{
		return $this->descricao;
	}

	public function getLances() 
	{
		return $this->lances;
	}
}
?>