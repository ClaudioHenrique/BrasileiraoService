<?php

	/* Classe responsavel por recuperar as informa��es da classifica��o do 
	 * Campeonato Brasileiro(Brasileirao)
	 * O Crawler ainda n�o foi finalizado.
	 * Autor   : Cl�udio Henrique
	 * e-mail  : claudiohenriquedev@gmail.com
	 * Version : 0.1
	*/
	
	header('Content-Type: text/html; charset=utf-8');
	require_once 'simple_html_dom.php';
	
	class Crawler{
		
		private $url = 'http://placar.abril.com.br/campeonato/brasileirao';
		private $class;
		private $clear;
		private $novoArray;
		
		public function __construct()
		{
			$this->buscarClassificacao();
		}
		
		//Metodo responsavel por buscar a classifica��o atual.
		private function buscarClassificacao(){
			
			$html = file_get_html($this->url);
			
			//Retorna a Classifica��o � todas as informa��es (Pontos,Jogos,Empates, e.t.c)
			foreach($html->find('tr.another-team') as $class){
				$this->class .= $class->plaintext .'<br>';
			}
			
			//Coloca as informa��es dentro de um array
			$this->class = explode('<br>',$this->class);
			
			//Coloca tudo dentro de uma v�riavel
			for($i = 0; $i < sizeof($this->class); $i++){
				$this->clear .= $this->class[$i];
			}
			
			//Transforma essa v�riavel em um Array
			$this->clear = explode(' ',$this->clear);
			
			//Limpa o Array, eliminando campos nulos ou v�zios.
			$arrayLimpo = array_filter($this->clear);

			//Coloca o Array ordenado em uma nova variavel
			$retornoArray = $this->ordenarArray($arrayLimpo);
			
			$retornaArray = explode('<br>',$retornoArray);
			
		}
		
		private function ordenarArray($array){
			//Declara��o e inicializa��o das variaveis. 
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
	}
?>