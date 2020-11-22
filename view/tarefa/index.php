<div style="width:100%;">
    <a href="?controller=tarefa&action=diagrama" style="float:right;text-decoration:none" class="botao fundoPrimario">
        Exibir Diagrama
    </a>
</div>

<br clear="all">

<h2>Tarefa list</h2>
<table class="tabelaGrid">
    <tr>
        <th style="width:5%">#</th>
        <th style="width:5%">PAI</th>
        <th style="width:25%">TITULO</th>
        <th style="width:30%">DESCRICAO</th>
        <th style="width:15%">STATUS</th>
        <th style="width:5%">POS.</th>
        <th style="width:10%"></th>
    </tr>
    <?php
    if (isset($dados) && !empty($dados)) {
        foreach ($dados as $linha) {    
            $linhaId = $linha->getId();
        ?>
        <tr>
            <td><?php echo $linha->getId(); ?></td>
            <td><?php echo $linha->getPai(); ?></td>
            <td><?php echo $linha->getTitulo(); ?></td>
            <td><?php echo $linha->getDescricao(); ?></td>
            <td class="texto-centro"><?php echo $linha->getDescricaoStatus(); ?></td>
            <td ><?php echo $linha->getPosicao(); ?></td>
            <td>
                <a href="index.php?controller=tarefa&action=form&id=<?php echo $linhaId; ?>" title="Editar">EDIT</a>
                <a href="index.php?controller=tarefa&action=remove&id=<?php echo $linhaId; ?>" title="Remover">DEL</a>
            </td>
        </tr>
        <?php
        }
    }
    ?>
</table>
