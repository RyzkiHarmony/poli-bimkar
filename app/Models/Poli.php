<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_poli',
    ];
    public function dokter(): HasMany
    {
        return $this->hasMany(User::class, 'id_poli');
    }
}