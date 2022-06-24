<?php
namespace application\controllers;

class UserController extends Controller {
    public function signin() {
        switch(getMethod()){
            case _GET:
                return "user/signin.php";
            case _POST:
                $email = $_POST['email'];
                $pw = $_POST['pw'];
                $param=['email'=> $email];
        $dbUser = $this-> model->selUser($param);
        if($dbUser === false || !password_verify($pw,$dbUser->pw)){
            return "redirect:signin?email={$email}&err";
        }

        $this-> flash(_LOGINUSER,$dbUser);
        return "redirect:/feed/index";
    }
}

    public function signup() {
        switch(getMethod()){
            case _GET:
                return "user/signup.php";
            case _POST:
                $param=[
                    'email'=> $_POST["email"],
                    'pw'=> $_POST["pw"],
                    'nm'=> $_POST["nm"]
                ];
                $param["pw"] = password_hash($param["pw"],PASSWORD_BCRYPT);
                $this->model->insUser($param);
                return "user/signin.php";
        }
    }
}