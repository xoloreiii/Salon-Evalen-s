<?php 
    namespace App\Models;

    use CodeIgniter\Model;
    
    class SalonModelProfile extends Model
    {
        protected $table = 'user';
        protected $primaryKey = 'email';
        protected $allowedFields = ['nama', 'email', 'nohp'];
    
        public function simpan($record)
        {
            $this->save([
                'nama' => $record['nama'],
                'email' => $record['email'],
                'nohp' => $record['nohp'],
            ]);
        }
    
        public function ambil($email)
        {
            return $this->where(['email' => $email])->first();
        }
    }
    
?>