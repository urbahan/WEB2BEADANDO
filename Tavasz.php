<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tavasz extends Model
{
    protected $table = 'tavasz';
    public $timestamps = false;

    protected $fillable = ['szalloda_az', 'indulas', 'idotartam', 'ar'];

    protected function casts(): array
    {
        return [
            'indulas' => 'date',
            'idotartam' => 'integer',
            'ar' => 'integer',
        ];
    }

    public function szalloda(): BelongsTo
    {
        return $this->belongsTo(Szalloda::class, 'szalloda_az', 'az');
    }
}
