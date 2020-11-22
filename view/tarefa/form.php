<h2>Tarefa novo</h2>

<form id="form-generico" action="index.php?controller=tarefa&action=formAction" method="post" role="form">
    <table class="tabelaForm">
        <tr>
            <th>ID</th>
            <td>
                <input type="text" name="id" class="form-control form-peq" value="<?php echo isset($loadObjeto) ? htmlentities($loadObjeto->getId(), ENT_QUOTES, 'UTF-8') : ''; ?>" />
            </td>
        </tr>       
        <tr>
            <th>PAI</th>
            <td>
                <select class="form-select form-med" name="pai">
                    <option value="0">-- Selecione</option>
                    <?php
                    //$statusId = isset($loadPai) ? $loadPai->getId() :  0;
                    foreach($loadPai AS $pai){
                        $selecionado = ($pai->getId() == $statusId)? "selected" : "" ;
                        $titulo = $pai->getTitulo();
                        //$titulo = str_repeat ( "&mdash; " , $pai->getPai() )."".$pai->getTitulo();
                    ?>
                        <option value="<?php echo $pai->getId();?>" <?=$selecionado;?>>
                            <?=$titulo;?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <!-- <input type="text" name="pai" class="form-control form-peq" value="<?php echo isset($loadObjeto) ? htmlentities($loadObjeto->getPai(), ENT_QUOTES, 'UTF-8') : ''; ?>" /> -->
            </td>
        </tr>          
        <tr>
            <th>Titulo</th>
            <td>
                <input type="text" name="titulo" class="form-control form-med" value="<?php echo isset($loadObjeto) ? htmlentities($loadObjeto->getTitulo(), ENT_QUOTES, 'UTF-8') : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th>Descricao</th>
            <td>
                <textarea name="descricao" class="form-control form-post"><?php echo isset($loadObjeto) ? htmlentities($loadObjeto->getDescricao(), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
            </td>
        </tr>   
        <tr>
            <th>Status</th>
            <td>
                <select class="form-select form-med" name="status">
                    <option value="0">-- Selecione</option>
                    <?php
                    $statusId = isset($loadObjeto) ? $loadObjeto->getStatus() :  0;
                    foreach($loadStatus AS $status){
                        $selecionado = ($status->getId() == $statusId)? "selected" : "" ;
                    ?>
                        <option value="<?php echo $status->getId();?>" <?=$selecionado;?>>
                            <?php echo $status->getDescricao();?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>         
        <tr>
            <th>Posicao</th>
            <td>
                <input type="text" name="posicao" class="form-control form-peq" value="<?php echo isset($loadObjeto) ? htmlentities($loadObjeto->getPosicao(), ENT_QUOTES, 'UTF-8') : ''; ?>" />
            </td>
        </tr>                
        <tr>
        <td colspan="2" class="center">
                <input type="submit" value="<?php echo isset($loadObjeto) ? "Editar Tarefa" : "Adicionar Tarefa"; ?>" class="botao fundoPrimario">
                
            </td>
        </tr>        
    </table>
</form>