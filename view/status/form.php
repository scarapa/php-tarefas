<h2>Status Edit</h2>

<?php
$messageOutput = '';
if ($r == 'error') {
    $messageOutput = '<div class="alert alert-danger alert-dismissable">' . stripslashes(urldecode($m)) . '</div>';
} else if ($r == 'warning') {
    $messageOutput = '<div class="alert alert-warning alert-dismissable">' . stripslashes(urldecode($m)) . '</div>';
} else if ($r == 'success') {
    $messageOutput = '<div class="alert alert-success alert-dismissable">' . stripslashes(urldecode($m)) . '</div>';
}
?>
<div id="output"><?php echo $messageOutput; ?></div>

<form id="form-generico" action="index.php?controller=status&action=formAction" method="post" role="form">
    <table class="tabelaForm">
        <tr>
            <th>ID</th>
            <td>
                <input type="text" name="id" class="form-control form-peq" value="<?php echo isset($loadObjeto) ? htmlentities($loadObjeto->getId(), ENT_QUOTES, 'UTF-8') : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th>DESCRICAO</th>
            <td>
                <input type="text" name="descricao" class="form-control" placeholder="Descricao" value="<?php echo isset($loadObjeto) ? htmlentities($loadObjeto->getDescricao(), ENT_QUOTES, 'UTF-8') : ''; ?>" />            
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center">
                <input type="submit" value="Adicionar Status" class="botao fundoPrimario">
            </td>
        </tr>        
    </table>
</form>