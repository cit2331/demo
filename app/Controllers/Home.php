<?php

namespace App\Controllers;
use App\Services\UserService;

class Home extends BaseController
{
    private $service;
    public function __construct(){
        $this->service = new UserService();
    }

    public function index(): string
    {
        //login/login => folder login và file login
        return view('login/login');
    }

    public function signup(): string
    {
        //folder login và file signup
        return view('login/signup');
    }

    public function create(){
        $result = $this->service->addUser($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }


}
