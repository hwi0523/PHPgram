<?php
namespace application\controllers;

class FeedController extends Controller{
    public function index(){

        $this->addAttribute(_MAIN,$this->getview("feed/index.php"));
        return "template/t1.php";
    }
}