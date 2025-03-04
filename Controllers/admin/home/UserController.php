<?php

class UserController extends BaseController{
    public function userform(){
        $this->view('user/user-form');
    }
}