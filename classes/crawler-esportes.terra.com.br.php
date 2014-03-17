<?php
	require_once 'simple_html_dom.php';
	
	class CrawlerEsportesTerra {
		
		private $url = 'http://esportes.terra.com.br/futebol/brasileiro-serie-a/';
		private $cont;
		
		public function __construct(){
				$this->buscarClassificacao();
		}
		
		private function buscarClassificacao(){
			$html = file_get_html($this->url);
			
			//Retorna a Classificação é todas as informações (Pontos,Jogos,Empates, e.t.c)
			foreach($html->find('.col-main') as $class){
				foreach($class->find('table') as $tabela){
					$this->cont .= $tabela.'<br>';
				}
			}
			
			
			$this->cont = explode('<br>',$this->cont);
			echo '<pre>';
			print_r($this->cont);
			echo '</pre>';
		}
	}
?>