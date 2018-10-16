<!DOCTYPE html>
<html>
<head>
	<title>MVC | Classificados</title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
	<nav class="navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="<?php echo BASE_URL; ?>" class="navbar-brand">Classificados</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<!-- SE TIVER LOGADO, MOSTRAR ESSAS DUAS OPÇÕES -->
				<?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])):?>
					<li><a href="#">Bem Vindo: <?php echo $_SESSION['nomeUsuario']; ?></a></li>
					<li><a href="<?php echo BASE_URL; ?>anuncios">Meus anúncios</a></li>
					<li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a></li>
				<?php else: ?>	
				<!-- SE NÃO TIVER LOGADO, MOSTRAR ESSAS DUAS OPÇÕES  -->
					<li><a href="<?php echo BASE_URL; ?>cadastrar">Cadastre-se</a></li>
					<li><a href="<?php echo BASE_URL; ?>login">Acessar</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
	
	<?php $this->loadViewInTemplate($viewName, $viewData); ?>

	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>
</html>