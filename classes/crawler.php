<?php

	/* Classe responsavel por recuperar as informações da classificação do Brasileirão
	 * O Crawler ainda não foi finalizado.
	 * Autor   : Cláudio Henrique
	 * e-mail  : claudiohenriquedev@gmail.com
	 * Version : 0.1
	*/
	
	header('Content-Type: text/html; charset=utf-8');
	require_once 'simple_html_dom.php';
	
	class Crawler{
		
		private $url = 'http://placar.abril.com.br/campeonato/brasileirao';
		private $class;
		private $clear;
		
		public function __construct(){
					$this->buscarClassificacao();
		}
		
		private function buscarClassificacao(){
			
			//Metodo responsavel por buscar a classificação atual.
			$html = file_get_html($this->url);
			
			//Retorna a Classificação é todas as informações (Pontos,Jogos,Empates, e.t.c)
			foreach($html->find('tr.another-team') as $possicao){
				$this->class .= $possicao->plaintext .'<br>';
			}
			
			//Coloca as informações dentro de um array
			$this->class = explode('<br>',$this->class);
			
			//Coloca tudo dentro de uma váriavel
			for($i = 0; $i < sizeof($this->class); $i++){
				$this->clear .= $this->class[$i];
			}
			
			//Transforma essa váriavel em um Array
			$this->clear = explode(' ',$this->clear);
			
			//Limpa o Array, eliminando campos nulos ou vázios.
			$arrayLimpo = array_filter($this->clear);

			//print_r($this->ordenarArray($arrayLimpo,$tamanho));
		}
		
		private function ordenarArray($array,$tamanho){
			$contador = 0;
			
			for($i = 0; $i < $tamanho; $i++){
				if(array_key_exists($i,$array)){
					echo 'Existe'.$i.'<br>';
				}
			}
		}
	}
?>