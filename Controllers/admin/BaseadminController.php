<?php
    //class for base admin controller
    class BaseAdminController{


        //$view the view file to render
        //$data the data to be passed to the view
        protected function view($view, $data = []){
            extract($data);
            ob_start();
            require "views/{$view}.php";
            $content = ob_get_clean();
            require "views/layoutAdmin.php";
        }


        //redirect to a specific location
        //$url The URL to redirect to
        protected function redirect($url){
            header("Location: $url");
            exit();
        }
    }
?>