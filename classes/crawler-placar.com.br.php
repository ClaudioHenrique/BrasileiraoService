<?php

	/* Classe responsavel por recuperar as informações da classificação do 
	 * Campeonato Brasileiro(Brasileirao)
	 * O Crawler ainda não foi finalizado.
	 * Autor   : Cláudio Henrique
	 * e-mail  : claudiohenriquedev@gmail.com
	 * Version : 0.1
	*/
	
	header('Content-Type: text/html; charset=utf-8');
	require_once 'simple_html_dom.php';
	require_once 'Xml.php';
	
	class CrawlerPlacar {
		
		private $url = 'http://placar.abril.com.br/campeonato/brasileirao';
		private $class;
		private $clear;
		private $novoArray;
		private $xml;
		
		public function __construct()
		{
			$this->buscarClassificacao();
		}
		
		//Metodo responsavel por buscar a classificação atual.
		private function buscarClassificacao(){
			
			$html = file_get_html($this->url);
			
			//Retorna a Classificação é todas as informações (Pontos,Jogos,Empates, e.t.c)
			foreach($html->find('tr.another-team') as $class){
				$this->class .= $class->plaintext .'<br>';
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

			//Coloca o Array ordenado em uma nova variavel
			$retornoArray = $this->ordenarArray($arrayLimpo);
			
			//Transforma a váriavel de uma String para um Array [String to Array]
			$retornaArray = explode('<br>',$retornoArray);
			
			$x = $this->unirNomes($retornaArray);
			
			echo '<pre>';
			print_r($x);
			echo '</pre>';
		}
		
		private function ordenarArray($array){
			//Declaração e inicialização das variaveis. 
			$ultimaPossicao = 0;
			$contador = 0;
			
			//Recupera o ultimo indice do array
			foreach($array as $indice => $valor){
				$ultimaPossicao = $indice;
			}
			
			for($i = 0; $i < $ultimaPossicao; $i++){
				if(!empty($array[$i]))
					$this->novoArray .= $array[$i].'<br>';
			}
			return $this->novoArray;
		}
		
		/*
		 * Pode ser até um pouco estranho explicar, porem quando eu faço um explode na linha 56
		 * Nomes compostos como 'São Paulo' ou 'Ponte Preta' acabam quebrando e ficando separados
		 * ou seja na possição fica [0] => São e na [1] => Paulo, entendeu? 
		 * Preisamos do metodo unirNomes para essa finalidade.
		*/
		
		private function unirNomes($array){
			for($i = 0; $i <= sizeof($array)-1; $i++){
				if(strcmp($array[$i],'Paulo') == 0){
					$anterior = $i - 1;
					$array[$i] = $array[$anterior] . ' '.$array[$i];
					unset($array[$anterior]);
				}else if(strcmp($array[$i],'Preta') == 0){
					$anterior = $i - 1;
					$array[$i] = $array[$anterior] . ' '.$array[$i];
					unset($array[$anterior]);
				}
			}
			return $array;
		}
	
	}
?>