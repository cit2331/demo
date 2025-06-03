<?php

namespace App\Services;
use App\Models\UserModel;//Gọi đến file UserModel
use Exception;
class UserService extends BaseService
{
    private $users; //Biến cục bộ
    function __construct(){
        parent::__construct();
        $this -> users = new UserModel();//Khởi tạo đối tượng và gán vào users
        $this -> users -> protect(false); //Bảo vệ bảng
        ///users => CONNECT tới bảng users
    }

    public function addUser($requestData){
        $validate = $this->validationAddUser($requestData);
        if($validate->getErrors()){
            
            return [
                'status'=> 'ERROR',
                'messageCode'=>'MESSAGE_ERROR',
                'messages'=> $validate->getErrors()
            ];
        }else{
            try {
                $dataSave = $requestData->getPost();
                unset($dataSave['repassword']);
                $dataSave['password'] = password_hash($dataSave['password'], PASSWORD_BCRYPT);
                $this->users->save($dataSave);
                return [
                    'status'=> 'SUCCESS',
                    'messageCode'=>'MESSAGE_SUCCESS',
                    'messages'=> ['MESSAGE_SUCCESS'=>'Đăng ký thành công']
                ];
            } catch (Exception $e) {
                return [
                    'status'=> 'ERROR',
                    'messageCode'=>'MESSAGE_ERROR',
                    'messages'=> ['MESSAGE_SUCCESS'=>$e->getMessage()]
                ];
            }            
        }
    }
    private function validationAddUser($requestData){
        //1 mảng trong php
        //$rule = []
        $rule = [
            'email'=>'required|valid_email',
            'password'=>'required|max_length[255]|min_length[3]',
            'repassword'=>'required|matches[password]',
        ];
        $message = [
            'email'=>[
                'required'=>'Địa chỉ email không được để trống',
                'valid_email'=>'Email nhập sai định dạng'
            ],
            'password'=>[
                'required'=>'Mật khẩu không được để trống',
                'max_length'=>'Mật khẩu tối đa {param} ký tự',
                'min_length'=>'Mật khẩu ít nhất {param} ký tự'
            ],
            'repassword'=>[
                'required'=>'Nhập lại mật khẩu không được để trống',
                'matches'=>'Mật khẩu nhập lại không khớp',
            ]
        ];
        $this->validation->setRules($rule,$message);
        //validation = [[rule],[message]]
        $this->validation->withRequest($requestData)->run();
        return $this->validation;
    }
}
