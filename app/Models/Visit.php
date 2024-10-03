<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fecha_visita',
        'comentarios',
        'persona_id',
        'propiedad_id',
    ];


    public function persona()
    {
        return $this->belongsTo(Person::class, 'persona_id');
    }

    public function propiedad()
    {
        return $this->belongsTo(Property::class, 'propiedad_id');
    }
}
