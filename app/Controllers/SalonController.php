<?php

namespace App\Controllers;

use App\Models\salonBooking;
use App\Models\salonModel;
use App\Models\salonLogin;
use App\Models\salonPricelist;
use App\Models\SalonModelProfile;
use CodeIgniter\Files\File;
use Exception;

class SalonController extends BaseController
{
    protected $salonpriceController;
    protected $salonvalidasiBayar;

    public function __construct()
    {
        $this->salonpriceController = new salonPricelist();
        // membuat variabel salonpriceController dengan new salonPricelist yang diambil dari model
        $this->salonvalidasiBayar = new salonBooking();
    }

    public function list()
    {
        $price = [
            'body' => $this->salonpriceController->findAll(),
        ];

        return view('/salon/salonPricelist', $price);
    }

    public function listPriceAdmin()
    {
        $priceA = [
            'body' => $this->salonpriceController->findAll(),
        ];

        return view('/salon/salonPriceadmin', $priceA);
    }

    public function listLogin()
    {
        $priceM = [
            'body' => $this->salonpriceController->findAll(),
        ];

        return view('/salon/salonPricelistL', $priceM);
    }

    public function index()
    {
        return view('/salon/salonHome');
    }

    public function register()
    {
        return view('salon/salonRegister');
    }

    public function checkRegister()
    {
        // $session = session();
        // if ($session->has('pengguna')) {
        helper('form');
        // Memeriksa apakah melakukan submit data atau tidak.
        if (!$this->request->is('post')) {
            return view('/salon/salonHome');
        }

        // Mengambil data yang disubmit dari form
        $this->request->getPost([
            'nama', 'email', "nohp",
            "password"
        ]);
        $post = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'nohp' => $this->request->getVar('nohp'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role' => 'user'
        ];
        // Mengakses Model untuk menyimpan data
        $model = model(salonModel::class);
        $model->simpan($post);
        return view('/salon/salonSuccess');
        // } else {
        //     return view('/salon/salonRegister');
        // }

    }

    public function login()
    {
        return view('salon/salonLogin');
    }

    public function afterLogin()
    {
        return view('salon/salonHomeL');
    }

    public function checkLogin()
    {
        $post = $this->request->getPost(['email', 'password']);
        $model = model(salonLogin::class);
        $user = $model->ambil($post['email']);

        if ($user !== null && $post['email'] === $user['email'] && password_verify($post['password'], $user['password'])) { // mengecek masukan dari user
            $session = session();
            $session->set('pengguna', $post['email']); //menyimpan hasil dari usr ke variable pengguna
            if ($user['role'] == 'admin') {
                return view('salon/salonHomeAdmin');
            } else {
                return view('salon/salonHomeL');
            }
        } else {
            return view('salon/salonGagal');
        }
    }

    public function tambahJasa()
    {
        $session = session();
        if ($session->has('pengguna')) {
            helper('form');
            // Memeriksa apakah melakukan submit data atau tidak.
            if (!$this->request->is('post')) {
                return view('/salon/salonTambahJasa');
            }

            // Mengambil data yang disubmit dari form
            $post = $this->request->getPost([
                'nama_jasa', 'harga'
            ]);
            // Mengakses Model untuk menyimpan data
            $model = model(salonPricelist::class);
            $model->simpan($post);
            return view('/salon/salonSuccessTambahJasa');
        } else {
            return view('/salon/salonGagalTambahJasa');
        }
    }

    public function hapusJasa($id_jasa)
    {
        try {
            $model = model(salonPricelist::class);
            $success = $model->hapus($id_jasa);

            if ($success) {
                return view('/salon/salonSuccessHapusJasa');
            } else {
                return view('/salon/salonGagalHapusJasa');
            }
        } catch (Exception $e) {
            return view('/salon/salonHapusJasa');
        }
    }

    public function listHapusJasa()
    {
        $priceA = [
            'body' => $this->salonpriceController->findAll(),
        ];

        return view('/salon/salonHapusJasa', $priceA);
    }


    public function simpanRev()
    {
        $session = session();
        if ($session->has('pengguna')) {
            helper('form');
            // Memeriksa apakah melakukan submit data atau tidak.
            if (!$this->request->is('post')) {
                return view('/salon/salonReservasi', ['session' => $session, 'price_list' => model(salonPricelist::class)->ambillSemua()]);
            }

            // Mengambil data yang disubmit dari form
            $post = $this->request->getPost([
                'email', 'nama_jasa', 'jasa', 'totalPrice',
                'waktu', 'pembayaran'
            ]);
            
            $img = null;

            if ($post['pembayaran'] != 'CASH') {
                $img = $this->request->getFile('photo');
                $post['photo'] = $img->getRandomName();
            } else {
                $post['photo'] = '-';
            }

            if ($post['pembayaran'] != 'CASH') {
                $post['status'] = 'Belum Lunas';
            } else {
                $post['status'] = 'Belum Lunas';
            }

            $post['harga_transaksi'] = 0;
            // var_dump($post);die();
            // Mengakses Model untuk menyimpan data
            // $model = model(salonBooking::class);
            // $model->simpan($post);
            $model = new salonBooking();
            $model->insert([
                'email' => $post['email'],
                'id_jasa' => json_encode($post['jasa']),
                'waktu' => $post['waktu'],
                'pembayaran' => $post['pembayaran'],
                'photo' => $post['photo'],
                'harga_transaksi' => isset($post['totalPrice'])?$post['totalPrice']:0,
                'status' => $post['status'],
            ]);

            if (!is_null($img)) {
                $img->move('../public/gambars', $post['photo']);
            }
            $db      = \Config\Database::connect();
            $ambilJasa = $db->table('jasa')->whereIn('id_jasa',$post['jasa'])->get()->getResult();
            $temp = [];
            foreach ($ambilJasa as $key => $value) {
                $temp[] = $value->nama_jasa;
            }
            $post['jasa_data'] = $temp;

            return view('/salon/salonSuccessReservasi',$post);

        } else {
            return view('/salon/loginpages');
        }
    }

    

    public function ValidasiPembayaran()
    {
        $booking = [
            'booking' => $this->salonvalidasiBayar->findAllByQuery(),
        ];

        return view('/salon/salonValidasiPembayaran', $booking);
        // return view('/salon/salonValidasiPembayaran', compact('booking'));
    }
    public function validation($id_booking)
    {
        $model = model(salonBooking::class);
        $success = $model->validation($id_booking);

        if ($success) {
            $berhasil = true;
            return view('/salon/salonValidasiPembayaran', [$berhasil]);
        } else {
            $berhasil = false;
            return view('/salon/salonValidasiPembayaran', [$berhasil]);
        }
    }

    public function logout() //remove attribut session pengguna
    {
        $session = session();
        // $session->destroy(); //destroy akan menghancurakn semua session
        $session->remove('pengguna'); //bisa menggunakan destroy. 
        return view('salon/salonStart');
    }

    public function salonStart()
    {
        return view('salon/salonStart');
    }

    public function homeAdmin()
    {
        return view('salon/salonHomeAdmin');
    }

    public function updateProfile()
    {
        // Load the model
        $model = new salonModelProfile();

        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $formData = $this->request->getPost();

            // Validate the form data if needed

            // Call the model method to update the profile
            $model->simpan($formData);

            // Redirect to a success page or reload the current page
            return view ('salon/salonSuccessUpdateProfile');
        }

        // Load the view
        return view('salon/salonProfile');
    }

    public function profile()
    {
        $session = session();
        if ($session->has('pengguna')) {
            helper('form');
            $model = model(SalonModelProfile::class);
            
            // Memeriksa apakah melakukan submit data atau tidak.
            if ($this->request->getMethod() === 'post') {
                // Validasi form jika diperlukan
                $validation = \Config\Services::validation();
                $validation->setRules([
                    'nama' => 'required',
                    'nohp' => 'required',
                ]);

                if ($validation->withRequest($this->request)->run()) {
                    // Jika validasi berhasil, update profil
                    $model->simpan([
                        'nama' => $this->request->getPost('nama'),
                        'email' => $session->pengguna,
                        'nohp' => $this->request->getPost('nohp'),
                    ]);

                    return view('salon/salonSuccessUpdateProfile');
                }
            }

            // Ambil data profil dari model
            $profile = $model->ambil($session->pengguna);

            return view('salon/salonProfile', ['session' => $session, 'profile' => $profile]);
        } else {
            return view('/home');
        }
    }


}
