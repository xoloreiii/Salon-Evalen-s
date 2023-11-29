<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException; // Add this line

class Login extends BaseController
{
    public function index()
    {
        return view('login/loginpage');
    }

    public function check()
    {   //dari form
        // KALAU PAKAI DARI DATABASE
        // $userpass = $this->request->getPost(['username','password']);

        // $model = model(LoginModel::class);

        // //modelnya jadi pasangin
        // $login = $model->ambil($userpass['username']);

        // if($userpass['username'] == $login['username'] && $userpass['password'] == $login['password']) { // mengecek kalau usr dan pws nya admin dan 123. kalau iya maka akan buat session 
        //     $session = session(); //buat session 
        //     $session->set('pengguna', $userpass['username']); //session ini akan mencangkup nilai user dengan nama atribut pengguna
        //     return view ('login/home'); //nampilin menu home 
        // } else {
        //     return view('login/fail');
        // }

        $post = $this->request->getPost('username','password');
        if($post['username'] == 'admin' && $post['password'] == '123') { // mengecek kalau usr dan pws nya admin dan 123. kalau iya maka akan buat session 
            $session = session(); //buat session 
            $session->set('pengguna', $post['username']); //session ini akan mencangkup nilai user dengan nama atribut pengguna
            return view ('login/home'); //nampilin menu home 
        } else {
            return view('login/fail');
        }
    }

    public function home()
    {
        $session = session(); //buat session
        if($session->has('pengguna')){ //apa ada variabel session atribut bernama pengguna
            $item = $session->get('pengguna'); //dapetin isi dari pengguna terus disimpen di item 
            if($item == 'admin'){ //kalau iya nanti akan diarahkan ke home
                return view('login/home');
            } else { //kalau engga nanti diarahkan ke login page
                return view('login/loginpage');
            } 
        } else {
            return view ('login/loginpage');
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('pengguna');
        // return view('login/logoutsuccess'); 
        // atau bisa diarahkan ke loginpage
        return view('login/loginpage');
    }
}