<?php
class IndexController {

    public function index() {


        ob_start();
        include('view/template/index.php');
        $content = ob_get_clean();
        return $content;
    }
}
?>