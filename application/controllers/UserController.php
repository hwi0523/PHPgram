<?php
namespace application\controllers;

class UserController extends Controller {

    // 로그인
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
        $dbUser->pw = null;
        $dbUser->regdt = null;
        $this-> flash(_LOGINUSER,$dbUser);
        return "redirect:/feed/index";
    }
}
    // 회원가입
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
                return "redirect:signin";
        }
    }

    public function logout(){
        $this-> flash(_LOGINUSER);
        return "redirect:/user/signin";
    }
}
// GET(삭제) 값이 쿼리스트링(주소값 뒤 ? 부터 시작)으로 전달
// POST(등록,수정) body에 담겨져서 전달
// PHP = 왼쪽 키값 오른쪽 벨류값

// 