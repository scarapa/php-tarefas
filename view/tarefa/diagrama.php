<?php 

//echo "<pre>"; print_r($dados); echo "</pre>"; die;
?>

<h2>Diagrama</h2>
<table class="tabelaGrid">
    <tr>
        <th style="width:25%">TITULO</th>
        <th style="width:15%">POSICAO</th>
    </tr>
    <?php
    if (isset($dados) && !empty($dados)) {
        foreach ($dados as $linha) {    
            $espacamento = str_repeat ( "&mdash; " , $linha['nivel'] );
        ?>
        <tr>
            <td><?php echo $espacamento." ".$linha['titulo']; ?></td>
            <td><?php echo $linha['posicao']; ?></td>
        </tr>
        <?php
        }
    }
    ?>
</table>