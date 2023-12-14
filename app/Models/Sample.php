<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sample extends Model
{
    protected $fillable = [
        'id_alternative',
        'id_criteria',
        'value',
    ];

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'id_alternative', 'id_alternative');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'id_criteria', 'id_criteria');
    }

    public function getValue()
    {
        return $this->value;
    }
}
