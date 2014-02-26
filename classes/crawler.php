<?php

	/* Classe responsavel por recuperar as informa��es da classifica��o do Brasileir�o
	 * O Crawler ainda n�o foi finalizado.
	 * Autor   : Cl�udio Henrique
	 * e-mail  : claudiohenriquedev@gmail.com
	 * Version : 0.1
	 * 	
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
			//Metodo responsavel por buscar a classifica��o atual.
			$html = file_get_html($this->url);
			
			foreach($html->find('tr.another-team') as $possicao){
				$this->class .= $possicao->plaintext .'<br>';
			}
			
			$this->class = explode('<br>',$this->class);
			
			for($i = 0; $i < sizeof($this->class); $i++){
				$this->clear .= $this->class[$i];
			}
			
			$this->clear = explode(' ',$this->clear);
			
			$arrayLimpo = array_filter($this->clear);
			echo end($arrayLimpo);
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