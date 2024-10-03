<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'direccion',
        'ciudad',
        'precio',
        'description',
    ];

    public function solicitudesVisitas()
    {
        return $this->hasMany(Visit::class);
    }



}
