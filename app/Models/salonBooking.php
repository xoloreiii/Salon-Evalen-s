<?php

namespace App\Models;

use CodeIgniter\Model;

class salonBooking extends Model
{

    protected $table = 'booking';
    protected $allowedFields = ['email', 'id_jasa', 'waktu','harga_transaksi', 'pembayaran', 'photo', 'status'];

    public function simpan($record)
    {
        $this->insert([
            'email' => $record['email'],
            'id_jasa' => json_encode($record['jasa']),
            'waktu' => $record['waktu'],
            'pembayaran' => $record['pembayaran'],
            'photo' => $record['photo'],
            'harga_transaksi' => $record['harga_transaksi'],
            'status' => $record['status'],
        ]);
    }

    public function ambil($id_booking)
    {
        return $this->where(['id_booking' => $id_booking])->first();
    }

    public function findAllByQuery()
    {
        return $this->db->query('SELECT * from booking')->getResultArray();
    }

    public function validation($id_booking)
    {
        return $this->query("update booking set status = 'Lunas' where id_booking = " . $id_booking);
    }
    
}
