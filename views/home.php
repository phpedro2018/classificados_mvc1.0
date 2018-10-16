<div class="container-fluid">
	
	<div class="jumbotron">
		<h2> temos um total de <?php echo $totalAnuncios; ?>  anúncio(s)</h2>
		<p><?php echo $totalUsuarios; ?> usuário(s) cadastrado(s).</p>
	</div>
	
	<!-- FILTROS -->
	<div class="row">
		<div class="col-sm-3">
			<h4>Pesquisa Avançada</h4>
			<form method="GET">
				<!-- filtrando por categorias -->
				<div class="form-group">
					<label for="categoria"> Categorias:</label>
					<select name="filtros[categoria]" class="form-control" id="categoria">
						<option> </option>
						<?php foreach($categorias as $cat): ?>
							<option value="<?php echo $cat['id']; ?>"<?php echo ($cat['id']==$filtros['categoria'])?'selected="selected"':''; ?>> 
								<?php echo utf8_encode($cat['nome']); ?>    
							</option>
						<?php endforeach;?>
					</select>
				</div>
				
				<!-- filtrando por preço -->
				<div class="form-group">
					<label for="preco"> Preço:</label>
					<select name="filtros[preco]" class="form-control" id="preco">
						<option>  </option>
						<option value="0-50" 	<?php echo ($filtros['preco']=='0-50')?'selected="selected"':''; ?> 	> R$ 0 - 50		</option>
						<option value="51-100" 	<?php echo ($filtros['preco']=='51-100')?'selected="selected"':''; ?> 	> R$ 51 - 100 	</option>
						<option value="101-200" <?php echo ($filtros['preco']=='101-200')?'selected="selected"':''; ?> 	> R$ 101 - 200 	</option>
						<option value="101-200" <?php echo ($filtros['preco']=='101-200')?'selected="selected"':''; ?> 	> R$ 101 - 200 	</option>
						<option value="201-500" <?php echo ($filtros['preco']=='201-500')?'selected="selected"':''; ?> 	> R$ 201- 500 	</option>
					</select>
				</div>
				
				<!-- filtrando por estado de conservação -->
				<div class="form-group">
					<label for="estado"> Estado :</label>
					<select name="filtros[estado]" class="form-control" id="estado">
						<option>  </option>
						<option value="0" <?php echo ($filtros['estado']=='0')?'selected="selected"':''; ?> > 	Péssimo	</option>
						<option value="1" <?php echo ($filtros['estado']=='1')?'selected="selected"':''; ?> >	Ruim	</option>
						<option value="2" <?php echo ($filtros['estado']=='2')?'selected="selected"':''; ?> >	Regular	</option>
						<option value="3" <?php echo ($filtros['estado']=='3')?'selected="selected"':''; ?> >	Bom		</option>
						<option value="4" <?php echo ($filtros['estado']=='4')?'selected="selected"':''; ?> >	Ótimo	</option>
						<option value="5" <?php echo ($filtros['estado']=='5')?'selected="selected"':''; ?> >	Embalado (Novo)</option>
					</select>
				</div>
				
				<!-- botão para ativar a pesquisa -->
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</div>
				<!-- FIM DO FILTROS -->
			</form>
		</div>
		
		<!-- ´´ULTIMOS ANÚNCIOS -->
		<div class="col-sm-9">
			<h4>Últimos Anúncios</h4>
			<table class="table table-striped">
				<tbody>
					<?php foreach($anuncios as $anuncio): ?>
					<tr>
						<td>
							<?php
							if(!empty($anuncio['url'])):?>
							<img src="<?php echo BASE_URL; ?>assets/images/anuncios/<?php echo $anuncio['url'];  ?>" alt="" height="50">
							<?php else:?>
							<img src="<?php echo BASE_URL; ?>assets/images/default.jpg" height="50" alt="">
							<?php endif; ?>		
						</td>

						<td>
							<a href="<?php echo BASE_URL; ?>produto/abrir/<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a> <br/>
							<?php echo utf8_encode($anuncio['categoria']); ?>
						</td>
						<td>
							R$ <?php echo number_format($anuncio['valor'], 2); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<!-- FIM DOS ÚLTIMOS ANÚNCIOS -->
		
			<!-- AQUI INICIA A PAGINAÇÃO -->
			
			<ul class="pagination">
				<?php for($q=1; $q<=$totalPaginas; $q++): ?>
					<li class="<?php echo($p==$q)?'page-item active':''; ?>">
						<a class="page-link" href="<?php echo BASE_URL; ?>?<?php  $q; 
						$w = $_GET;
						$w['p'] = $q; 
						echo http_build_query($w);
						?>">
					<?php echo $q; ?></a></li>
				<?php endfor; ?>	
			</ul>
			<!-- AQUI TERMINA A PAGINAÇÃO -->
		</div>

	</div>
</div>