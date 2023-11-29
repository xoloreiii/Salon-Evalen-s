<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException; // Add this line

class Pesan extends BaseController
{
    public function index()
    {
        return view('inputpesan');
    }

    public function tampil()
    {
        return view('tampilpesan');
    }

}