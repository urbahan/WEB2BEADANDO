<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Szalloda extends Model
{
    protected $table = 'szallodak';
    protected $primaryKey = 'az';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'az',
        'nev',
        'besorolas',
        'helyseg_az',
        'tengerpart_tav',
        'repter_tav',
        'felpanzio',
    ];

    protected function casts(): array
    {
        return [
            'besorolas' => 'integer',
            'tengerpart_tav' => 'integer',
            'repter_tav' => 'integer',
            'felpanzio' => 'boolean',
        ];
    }

    public function helyseg(): BelongsTo
    {
        return $this->belongsTo(Helyseg::class, 'helyseg_az', 'az');
    }

    public function tavasziAjanlatok(): HasMany
    {
        return $this->hasMany(Tavasz::class, 'szalloda_az', 'az');
    }
}
