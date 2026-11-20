<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Helyseg extends Model
{
    protected $table = 'helysegek';
    protected $primaryKey = 'az';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['az', 'nev', 'orszag'];

    public function szallodak(): HasMany
    {
        return $this->hasMany(Szalloda::class, 'helyseg_az', 'az');
    }
}
