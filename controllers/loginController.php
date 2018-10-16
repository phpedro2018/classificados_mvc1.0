<?php

class loginController extends controller {

    public function index() {

    $dados = array();

    $u = new Usuarios();

    if(isset($_POST['email']) && !empty($_POST['email'])) {

        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];

        if($u->login($email,$senha)) {

            header("Location: ".BASE_URL);

        } else {

            $dados['msg'] = '<div class="alert alert-danger">
                Usuário e/ou Senha incorretos!
            </div>';
        }
    }


        $this->loadTemplate('login',$dados);

    }

    public function sair() {

        unset($_SESSION['cLogin']);
        header("Location: ".BASE_URL);

    }

}