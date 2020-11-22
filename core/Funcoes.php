<?php

Class Funcoes {

    public static function numerosPagina($registroTotal, $registroPagina) {
        return ceil($registroTotal / $registroPagina);
    }

    public static function buscaController($array){
        //1º IDENTIFICAR QUAL O INDICE A PALAVRA SISTEMA
        if(in_array("tarefas", $array)) {
            $indiceSistema = array_search("tarefas", $array);
        }
        $controller = $array[$indiceSistema+1];
        //2º VERIFICA SE EXISTE O DIRETORIO
        if( is_dir (PASTA."/view/".$controller)){
            return $controller;
        }
        return "home";
    }
    
    
    public static function buscaMain($controller,$link){
        // 1º comecar apartir do controller
        $indiceController = array_search($controller, $link); 
        $linkController = "";
        // 2º verifica se existe a pasta do controller principal

        if( is_dir (PASTA."/view/".$controller)){
            
            // 3º percorre o link para achar o arquivo 
            for($c = $indiceController; $c<count($link);$c++){
                //CONCATENAR ARRAY
                if(is_numeric($link[$c])) break;
                $linkController .= $link[$c]."/";
            }

            $linkController = substr($linkController,0,  strlen($linkController)-1) ;
            
            if(file_exists(PASTA."/view/".$linkController.".php")){ 
                return "view/".$linkController.".php";  
            }
            
            //4º senao existir o arquivo que esta no link , se existir tmb tentar 
            //por o arquivo index dentro da pasta do controler ex: post/index.php
            if(file_exists("view/".$linkController."/index.php")){ 
                return "view/".$linkController."/index.php";  
            }
        }       
        //SE CHEGAR ATÉ AQUI EXIBE A PAGINA INICIAL
        return "view/home/index.php";
    }    
    
    public static function retirarCaractereExtremidade($string,$caractere){
        $tamanho = strlen(trim($string));
        for($c = $tamanho-1; $c >= 0; $c--){
            if($string[$c] == $caractere) { 
               $string = substr($string,0,-1);
            }else{
                break;
            }

        }
        return $string;
    }
    
   
}

