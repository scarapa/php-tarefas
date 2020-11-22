<?php
class ErrorController {

    public function classe() {

        ob_start();
        include('view/error/classe.php');
        $content = ob_get_clean();
        return $content;
    }

    public function controle() {
        ob_start();
        include('view/error/controle.php');
        $content = ob_get_clean();
        return $content;
    }
}
?>