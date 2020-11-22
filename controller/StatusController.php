<?php
class StatusController {

    public function index() {

        
        $objetoModel = new StatusModel();
        $dados = $objetoModel->fetchAll();

        //echo "<pre>"; print_r($dados); echo "</pre>";

        ob_start();
        include('view/status/index.php');
        $content = ob_get_clean();
        return $content;
    }

    public function form() {
        // parâmetros
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $r = isset($_GET['r']) ? $_GET['r'] : '';
        $m = isset($_GET['m']) ? $_GET['m'] : '';
        // se é uma edição (se algum id foi passado por parâmetro), tenta carregar os dados do registro
        $loadObjeto = null;
        if ($id) {
            // model super
            $objetoModel = new StatusModel();
            $loadObjeto = $objetoModel->fetchById($id);
        }
        ob_start();
        include('view/status/form.php');
        $content = ob_get_clean();
        return $content;

        //return PASTA.'/view/status/form.php';
    }

    public function formAction() {
        // campos postados
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $descricao = isset($_POST['descricao']) ? addslashes($_POST['descricao']) : '';

        $objeto = new StatusModel();
        $objeto->setId($id);
        $objeto->setDescricao($descricao);
        $objetoId = $objeto->save();

        // redireciona
        header('Location: index.php?controller=status&action=form&id=' . $objetoId . '&r=success&m=' . urlencode('Salvo com sucesso!'));
        die;
    }

    public function remove() {
        // parâmetros
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        // se algum id foi passado por parâmetro, tenta remover o registro
        if ($id) {
            $objeto = new StatusModel();
            $objeto->fetchById($id);
            $objeto->delete();
        }

        // redireciona
        header('Location: index.php?controller=status&r=success&m=' . urlencode('Removido com sucesso!'));
        die;
    }
}
?>