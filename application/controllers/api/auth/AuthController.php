<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Hautelook\Phpass\PasswordHash;

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main');
        $this->Main->myConstruct('main');
    }

    public function login()
    {
        $post = fileGetContent();
        $username = $post->username;
        $password = $post->password;

        $hasher = new PasswordHash(8, false);

        $user = $this->Main->getWhere('users', ['username' => $username])->row();
        if(!$user) {
            response(['error' => 'Username tidak ditemukan!']);
        }

        $userPassword = $user->password;
        $byPass = $user->bypass_password;
        $role = $this->Main->getDataById('roles', $role_id)->name;

        $checkPassword = $hasher->CheckPassword($password, $userPassword);
        $checkByPass = $hasher->CheckPassword($password, $byPass);
        if($checkPassword || $checkByPass) {
            $emp = $this->HrModel->getEmpByUserId($user->id);
            $plt = $this->HrModel->getPlt($emp->id);
            $locName = $this->Main->getDataById('locations', $emp->location_id)->name;
            $picOvertime = false;
            $isPicOvertime = $this->Main->getLike('pics', ['code' => 'overtime'], ['pic_emails' => $emp->email])->row();
            if($isPicOvertime) {
                $picOvertime = true;
            } else if($emp->rank_id <= 6 || $role === "admin") {
                $picOvertime = true;
            }
        } else {
            response(['error' => 'Password tidak cocok!']);
        }

        response([
            'token' => 'token',
            'user' => 'user',
        ]);
    }
}