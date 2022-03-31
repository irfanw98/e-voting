<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kandidat;
use App\User;

class M_mahasiswa extends Model
{
    
    protected $table = 'm_mahasiswa';
    // protected $primaryKey = 'id';
    protected $fillable = ['nim', 'nama', 'no_telp', 'alamat', 'foto'];

    public function user()
    {
        //user di miliki oleh mahasiswa
        return $this->belongsTo(User::class);
    }

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
}
