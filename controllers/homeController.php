<?php 
class homeController extends controller{
	public function index(){
		
		$dados = array();


		//pegando todas as classes em models
		$a = new Anuncios();
		$u = new Usuarios(); 
		$c = new Categorias();

		$filtros = array(
			'categoria' => '',
			'preco' => '',
			'estado' => ''
		);

		if(isset($_GET['filtros'])){
			$filtros = $_GET['filtros'];
		}


		$totalAnuncios = $a->getTotalAnuncios($filtros); 
		$totalUsuarios=  $u->getTotalUsuarios();

		$p = 1; 

		if(isset($_GET['p']) && !empty($_GET['p'])){
			$p = addslashes($_GET['p']);
		}

		$por_pagina = 3;
		$totalPaginas = ceil($totalAnuncios / $por_pagina) ;


		$anuncios = $a->getUltimosAnuncios($p, $por_pagina, $filtros);
		$categorias = $c->getLista();

		//pegando todos os itens usados na home
		$dados['totalAnuncios'] = $totalAnuncios;
		$dados['totalUsuarios'] = $totalUsuarios; 
		$dados['categorias'] = $categorias; 
		$dados['filtros'] = $filtros;
		$dados['anuncios'] = $anuncios; 
		$dados['totalPaginas'] = $totalPaginas;

		$this->loadTemplate('home', $dados);
	}
}
?>