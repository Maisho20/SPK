<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternative extends Model
{
    protected $table = 'alternatives';

    protected $primaryKey = 'id_alternative';

    protected $fillable = [
        'name',
    ];

    public function evaluations()
    {
        return $this->hasMany(Sample::class, 'id_alternative', 'id_alternative');
    }
}
