<h2>Status list</h2>

<table class="tabelaGrid">
    <tr>
        <th style="width:10%">ID</th>
        <th style="width:80%">DESCRICAO</th>
        <th></th>
    </tr>
    <?php
    if (isset($dados) && !empty($dados)) {
        foreach ($dados as $linha) {    
            $linhaId = $linha->getId();
        ?>
        <tr>
            <td><?php echo $linha->getId(); ?></td>
            <td><?php echo $linha->getDescricao(); ?></td>
            <td>
                <a href="index.php?controller=status&action=form&id=<?php echo $linhaId; ?>" class="btn btn-default btn-xs button-action" title="Editar">EDIT</a>
                <a href="index.php?controller=status&action=remove&id=<?php echo $linhaId; ?>" class="btn btn-default btn-xs button-action" title="Remover">DEL</a>
            </td>
        </tr>
        <?php
        }
    }
    ?>
</table>