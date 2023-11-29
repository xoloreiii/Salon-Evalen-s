<?php

namespace App\Controllers;

use App\Models\AsistenModel;

class AsistenController extends BaseController
{
    protected $asistenModel;

    public function __construct()
    {
        $this->asistenModel = new AsistenModel();
    }

    public function index()
    {
        if(session()->has('pengguna')){
            $asisten = $this->asistenModel->findAll();
            $data = [
                //nama table, yang dipanggil 
                'asisten' => $asisten
            ];

            return view('AsistenView', $data);
        } else {
            return view('/asisten/loginForm');
        }
    }

    public function simpan(){
        if(session()->has('pengguna')){
            helper('form');
            // Memeriksa apakah melakukan submit data atau tidak.
            if (!$this->request->is('post')) {
            return view('/asisten/simpan');
            }
            // Mengambil data yang disubmit dari form
            $post = $this->request->getPost(['nim', 'nama', "praktikum",
            "ipk"]);
            // Mengakses Model untuk menyimpan data
            $model = model(AsistenModel::class);
            $model->simpan($post);
            return view('/asisten/success');
        } else {
            return view ('/asisten/loginForm');
        }
    }
    
    public function update()
    {
        if(session()->has('pengguna')){
            $db = \config\Database::connect();
            $builder = $db->table('asisten');
            helper('form');
            if (!$this->request->is('post')) {
                return view('/asisten/update');
            }
            $data = [
                'nama' => [$this->request->getPost('nama')],
                'praktikum' => [$this->request->getPost('praktikum')],
                'ipk' => [$this->request->getPost('ipk')],
            ];
            // mencari nim, lalu data yang sudah di diinput tadi di set untuk di update
            $builder->where('nim', $this->request->getPost('nim'))
                ->set($data)
                ->update();

            return view('/asisten/successUpdate');
        } else {
            return view('/asisten/loginForm');
        }
    }

    public function delete()
    {
        if(session()->has('pengguna')){
            $db = \config\Database::connect();
            $builder = $db->table('asisten');
            helper('form');
            if (!$this->request->is('post')) {
                return view('/asisten/hapus');
            }
            $post = $this->request->getPost([
                'nim'
            ]);
            // mencari nim, lalu dihapus
            $builder->where('nim', $post)->delete();
            return view('/asisten/successDelete');
        } else {
            return view('/asisten/loginForm');
        }
    }

    public function search()
    {   
        if(session()->has('pengguna')){
            if(!$this->request->is('post')){
                return view('/asisten/search');
            }
            //key disini berhubungan dengan input di view
            $nim = $this->request->getPost(['key']);
    
            $model = model(AsistenModel::class);
    
            //masukin ke array data, yang dimana nanti array ini akan dipassing ke $data
            //nanti hasilnya itu berhubungan ke view pada php if(!empty($hasil))
            $asisten = $model->ambil($nim['key']);
    
            $data = ['hasil' => $asisten];
            return view('asisten/search',$data);
        } else{
            return view('/asisten/loginForm');
        }
    }

    public function check()
    {
        $userpass = $this->request->getPost(['username','password']);

        $model = model(LoginModel::class);

        //modelnya jadi pasangin
        $login = $model->ambil($userpass['username']);


        // memanggil table Kurang tau aklau ngambil langsung
        $asisten = $this->asistenModel->findAll();
        $data = [
            //nama table, yang dipanggil 
            'asisten' => $asisten
        ];

        if($userpass['username'] == $login['Username'] && $userpass['password'] == $login['Password']) { // mengecek kalau usr dan pws nya admin dan 123. kalau iya maka akan buat session 
            $session = session(); //buat session 
            $session->set('pengguna', $userpass['username']); //session ini akan mencangkup nilai user dengan nama atribut pengguna
            return view ('AsistenView', $data); //nampilin tabel asisten 
        } else {
            return view('asisten/loginForm');
        }
    }

    public function login()
    {
        return view('asisten/loginForm');
    }

    public function logout()
    {
        $session = session();
        $session->remove('pengguna');
        return view('/asisten/loginForm');
    }
}