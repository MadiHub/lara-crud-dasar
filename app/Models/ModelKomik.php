<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// wajib
use Illuminate\Support\Facades\DB;

class ModelKomik extends Model
{
    use HasFactory;
    protected $table = 'tb_komik';
    public $timestamps = false;
    protected $fillable = ['id_komik','judul', 'penulis', 'foto'];

    public function getAllKomik()
    {
        return $this->all();
    }

    public function getKomikById($id_komik)
    {
        return $this->where('id_komik', $id_komik)->first();
    }

    public function addKomik($data)
    {
        $builder = DB::table($this->table);
        return $builder->insert($data);
    }

    public function updateKomik($id_komik, $data)
    {
        $builder = DB::table($this->table);
        return $builder->where('id_komik', $id_komik)->update($data);
    }

    public function deleteKomik($id_komik)
    {
        $builder = DB::table($this->table);
        return $builder->where('id_komik', $id_komik)->delete();
    }
    

}
