<?php 	

class Anuncios extends model {

	public function getTotalAnuncios($filtros){
		
		$filtroString =array('1=1');
		if(!empty($filtros['categoria'])){
			$filtroString[] = 'anuncios.id_categoria = :id_categoria';
		}
		if(!empty($filtros['preco'])){
			$filtroString[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
		}

		if(!empty($filtros['estado'])){
			$filtroString[] = 'anuncios.estado = :estado';
		}


		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM anuncios WHERE ".implode(' AND ', $filtroString));


		if(!empty($filtros['categoria'])){
			$sql->bindValue(':id_categoria', $filtros['categoria']);
		}
		if(!empty($filtros['preco'])){
			$preco = explode('-',$filtros['preco']);
			$sql->bindValue(':preco1', $preco[0]);
			$sql->bindValue(':preco2', $preco[1]);
		}

		if(!empty($filtros['estado'])){
			$sql->bindValue(':estado', $filtros['estado']);
		}


		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function getUltimosAnuncios($page, $porPagina, $filtros){
		
		$offset = ($page - 1) * $porPagina;


		$array = array();


		$filtroString =array('1=1');
		if(!empty($filtros['categoria'])){
			$filtroString[] = 'anuncios.id_categoria = :id_categoria';
		}
		if(!empty($filtros['preco'])){
			$filtroString[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
		}

		if(!empty($filtros['estado'])){
			$filtroString[] = 'anuncios.estado = :estado';
		}




		$sql = $this->db->prepare("SELECT *, 
		(select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url,
		(select categorias.nome from categorias where categorias.id = anuncios.id_categoria ) as categoria
		 FROM anuncios WHERE ".implode(' AND ', $filtroString)." ORDER BY id DESC  LIMIT $offset, 3") ;


		$filtroString =array('1=1');

		if(!empty($filtros['categoria'])){
			$sql->bindValue(':id_categoria', $filtros['categoria']);
		}
		if(!empty($filtros['preco'])){
			$preco = explode('-',$filtros['preco']);
			$sql->bindValue(':preco1', $preco[0]);
			$sql->bindValue(':preco2', $preco[1]);
		}

		if(!empty($filtros['estado'])){
			$sql->bindValue(':estado', $filtros['estado']);
		}


	
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}
		return $array;
		}



	public function getMeusAnuncios(){
	

	$array = array();
	
	$sql = $this->db->prepare("SELECT *, 
		(select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) 
		as url FROM anuncios WHERE id_usuario = :id_usuario") ;
	
	$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
	$sql->execute();

	if($sql->rowCount() > 0){
		$array = $sql->fetchAll();
	}
	return $array;

	}

	public function getAnuncio($id) {
		$array = array();
		

		$sql = $this->db->prepare("SELECT
			*,
			(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria,
			(select usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario) as telefone,
			(select usuarios.nome from usuarios where usuarios.id = anuncios.id_usuario) as nome

		FROM anuncios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $this->db->prepare("SELECT id, url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
			$sql->bindValue(":id_anuncio", $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}

		}

		return $array;
	}

	public function addAnuncio($titulo, $categoria, $valor, $descricao, $estado){

		

		$sql= $this->db->prepare("INSERT INTO anuncios SET 
			titulo = :titulo,
			id_usuario = :id_usuario,
			id_categoria = :id_categoria, 
			descricao = :descricao, 
			valor = :valor, 
			estado = :estado");

		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":estado", $estado);
		$sql->execute(); 
	}

		public function editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $id){

		

		$sql= $this->db->prepare("UPDATE anuncios SET 
			titulo = :titulo,
			id_usuario = :id_usuario,
			id_categoria = :id_categoria, 
			descricao = :descricao, 
			valor = :valor, 
			estado = :estado WHERE id = :id");

		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":estado", $estado);
		$sql->bindValue(":id", $id);
		$sql->execute(); 

		// se houver o envio de fotos
		if(count($fotos) > 0){

			for($q=0; $q<count($fotos['tmp_name']);$q++){
				$tipo = $fotos['type'][$q];

				//verificando se é uma imagem compatível
				if(in_array($tipo, array('image/jpeg', 'image/png'))){
					//gerando um novo nome para a imagem
					$tmpname = md5(time().rand(0,99)).'.jpg';
					//redirecionando para a nova pasta 
					move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/anuncios/'.$tmpname); 

					//redimensionando 
					list($largura_orig, $altura_orig) = getimagesize('assets/images/anuncios/'.$tmpname);
					$ratio = $largura_orig/$altura_orig;

					$largura = 500; 
					$altura = 500; 

					if($largura/$altura > $ratio){
						$largura = $altura*$ratio;
					} else {
						$altura = $largura/$ratio;
					}


					//salvando a nova imagem ja com tamanho, nome e pasta
					$img = imagecreatetruecolor($largura, $altura);
					if($tipo == 'image/jpeg'){
						$origi = imagecreatefromjpeg('assets/images/anuncios/'.$tmpname);
					} elseif($tipo == 'image/png') {
						$origi = imagecreatefrompng('assets/images/anuncios/'.$tmpname);
					}
					imagecopyresampled($img, $origi, 0, 0, 0, 0, $largura, $altura, $largura_orig, $altura_orig);
					imagejpeg($img, 'assets/images/anuncios/'.$tmpname, 80);


					// inserindo os dados no banco, a referencia

					$sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url");
					$sql->bindValue(":id_anuncio", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();


				}
			}
		}
	

	}

// ########################################################################### 
	public function excluirAnuncio($id){


		$sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
		$sql->bindValue(":id_anuncio", $id);
		$sql->execute();

		$sql = $this->db->prepare("DELETE FROM anuncios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}	

	public function excluirFoto($id){
		

		$id_anuncio = 0;

		$sql = $this->db->prepare("SELECT id_anuncio FROM anuncios_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$row = $sql->fetch();
			$id_anuncio = $row['id_anuncio'];
		}

		$sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id = :id"); 
		$sql->bindValue(":id", $id);
		$sql->execute();

		return $id_anuncio;

	}

}

?>