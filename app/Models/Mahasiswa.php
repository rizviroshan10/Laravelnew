<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mahasiswa extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'mahasiswas';

    protected $fillable =[
    'npm',
    'nama',
    'tanggal_lahir',
    'kota_lahir',
    'foto',
    'prodi_id'
   ];
   public function getTanggalAttribute ($value){
    return Carbon::createFromFormat('Y-m-d', $value)->format('l d m y');
   }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
