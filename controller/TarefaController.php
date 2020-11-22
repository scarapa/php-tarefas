<?php
class TarefaController {

    public function index() {
        
        $objetoModel = new TarefaModel();
        $dados = $objetoModel->fetchAll();
        
        //echo "<pre>"; print_r($dados); echo "</pre>"; die;

        ob_start();
        include('view/tarefa/index.php');
        $content = ob_get_clean();
        return $content;
    }

    public function form() {
        // parâmetros
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $r = isset($_GET['r']) ? $_GET['r'] : '';
        $m = isset($_GET['m']) ? $_GET['m'] : '';

        $objetoModel = new StatusModel();
        $loadStatus = $objetoModel->fetchAll();

        $objetoModel = new TarefaModel();
        $loadPai = $objetoModel->buscarPai(0);
        //echo "<pre>"; print_r($loadPai); echo "</pre>"; die;

        $loadObjeto = null;
        if ($id) {
            $loadObjeto = $objetoModel->fetchById($id);
        }
        ob_start();
        include('view/tarefa/form.php');
        $content = ob_get_clean();
        return $content;

        //return PASTA.'/view/status/form.php';
    }

    public function formAction() {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $pai = isset($_POST['pai']) ? (int) $_POST['pai'] : 0;
        $titulo = isset($_POST['titulo']) ? addslashes($_POST['titulo']) : '';
        $descricao = isset($_POST['descricao']) ? addslashes($_POST['descricao']) : '';
        $status = isset($_POST['status']) ? (int) $_POST['status'] : 0;
        $posicao = isset($_POST['posicao']) ? (int) $_POST['posicao'] : 0;

        //echo "<pre>"; print_r($_POST); echo "</pre>"; die;

        $objeto = new TarefaModel();
        $objeto->setId($id);
        $objeto->setPai($pai);
        $objeto->setTitulo($titulo);
        $objeto->setDescricao($descricao);
        $objeto->setStatus($status);
        $objeto->setPosicao($posicao);
        $objetoId = $objeto->save();

        header('Location: index.php?controller=tarefa&action=form&id='.$objetoId.'&r=success&m=' . urlencode('Salvo com sucesso!'));
        die;
    }

    public function remove() {
        // parâmetros
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        // se algum id foi passado por parâmetro, tenta remover o registro
        if ($id) {
            $objeto = new TarefaModel();
            $objeto->fetchById($id);
            $objeto->delete();
        }

        // redireciona
        header('Location: index.php?controller=status&r=success&m=' . urlencode('Removido com sucesso!'));
        die;
    }

    public function diagrama() {
        
        $objetoModel = new TarefaModel();
        $dados = $objetoModel->diagrama();
        
        //echo "<pre>"; print_r($dados); echo "</pre>"; die;

        ob_start();
        include('view/tarefa/diagrama.php');
        $content = ob_get_clean();
        return $content;
    }    
}
?>