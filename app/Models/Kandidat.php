<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\M_mahasiswa;

class Kandidat extends Model
{
    protected $table = 'kandidat';
    protected $fillable = ['no_urut', 'calon_ketua', 'calon_wakil', 'visi_misi'];


    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }

    public function mhscalonketua()
    {
        return $this->belongsTo(M_mahasiswa::class, 'calon_ketua', 'id');
    }

    public function mhscalonwakil()
    {
        return $this->belongsTo(M_mahasiswa::class, 'calon_wakil', 'id');
    }
}
