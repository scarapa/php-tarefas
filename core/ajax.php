<?php
header("Content-type: application/json");
include("config.php");
if($_REQUEST['objeto']=="imagem"){
    if($_REQUEST['metodo']==10){
        $pasta= $_GET['pasta'];
        $nome = $_GET['nome'];    
        $tipo = $_GET['tipo'];     
    
        $pesquisarPasta = (!empty($pasta))? " AND i.id_pasta = $pasta " : "";
        $pesquisarNome = (!empty(trim($nome)))? " AND nome LIKE '%$nome%' " : "";
        $pesquisarTipo = (!empty($tipo))? " AND id_tipo = $tipo " : "";      
        $where = " $pesquisarPasta $pesquisarNome $pesquisarTipo " ;
        require_once(PASTA."/model/ImagemModel.php");
        $objeto = new ImagemModel();
        $dados = $objeto->fetchAllWhere(1 , $where );
        echo json_encode($dados);

    }
}



/* PERMALINK - GERAR */
if(($_REQUEST['objeto']=="post") && ($_REQUEST['metodo']==20) && (!empty($_REQUEST['titulo']))){
    $id = !empty($_REQUEST['id'])?$_REQUEST['id']:0;
    $titulo = $_REQUEST['titulo'];
    require_once(PASTA."/model/PostModel.php");
    $objeto = new PostModel();
    $dados = $objeto->permalinkGerar($id,$titulo);
    echo json_encode($dados);
}
