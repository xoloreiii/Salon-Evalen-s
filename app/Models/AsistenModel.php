<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class AsistenModel extends Model{
        protected $table = 'asisten';
        protected $primaryKey = 'NIM';

        // protected $allowedFields = ['NIM', 'NAMA','PRAKTIKUM','IPK'];
        protected $allowedFields = ['nim', 'nama', "praktikum", "ipk"];

        public function simpan($record){
            $this->save([
                'nim' => $record['nim'],
                'nama' => $record['nama'],
                'praktikum' => $record['praktikum'],
                'ipk' => $record['ipk'],
                ]);
        }
        
        public function ambil($nim){
            //akan terhubung ke table database asisten
            //nanti akan dicek nim nya, dimana akan mengambil row pertama
            return $this->where(['nim' => $nim]) -> first();
        }
    }
?>