<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $primaryKey = 'id';

    protected $fillable = [
        'skill',
        'years_exp',
        'level',
    ];

    protected $casts = [
        'skill' => 'array'
    ];

    public function employee()
{
    return $this->belongsTo(Employee::class);
}

}
