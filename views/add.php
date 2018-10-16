<?php
if(!empty($msg)) {
    echo $msg;
}
?>
<div class="container">
    <h1>Meus Anúncios - Adicionar Anúncio</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="">Selecione</option>
                <?php foreach($categorias as $categoria): ?>
                    <option value="<?=$categoria['id']?>"><?=utf8_encode($categoria['nome'])?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control">
        </div>

        <div class="form-group">
            <label for="valor">Preço do Produto: R$</label>
            <input type="text" name="valor" id="valor" class="form-control">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" name="descricao" id="descricao"></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0">Péssimo</option>
                <option value="1">Ruim</option>
                <option value="2">Regular</option>
                <option value="3">Bom</option>
                <option value="4">Ótimo</option>
                <option value="5">Embalado (Novo)</option>
            </select>
        </div>

        <input type="submit" value="Adicionar" class="btn btn-default">

    </form>
</div>