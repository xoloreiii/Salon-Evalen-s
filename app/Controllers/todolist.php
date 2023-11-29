<?php

namespace App\Controllers;

use App\Models\TodolistModel;

class todolist extends BaseController
{
    protected $todolistModel;
    public function __construct()
    {
        $this->todolistModel = new \App\Models\TodolistModel();
    }
    public function index()
    {
        $todolist = $this->todolistModel->findAll();
        $data = [
            'title' => 'To Do List',
            'todolist' => $todolist
        ];

        return view('todolist/index', $data);
    }
    public function save()
    {
        $this->todolistModel->save([
            'idkegiatan' => $this->request->getVar('idkegiatan'),
            'kegiatan' => $this->request->getVar('kegiatan'),
            'status' => $this->request->getVar('status') 

        ]);

        return redirect()->to('/todolist');
    }
}