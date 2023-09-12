<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';

    protected $primaryKey = 'id';

    protected $fillable = [
        'created_id',
        'first_name',
        'last_name',
        'contact_phone',
        'email',
        'dob',
        'street_address',
        'city',
        'country',
        'postal_code'
    ];

    protected $dates = ['deleted_at'];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }


    protected static function booted()
    {
        static::creating(function ($employee) {
            $employee->created_id = static::generateUniqueId();
        });
    }

    protected static function generateUniqueId(): string
    {
        $id = strtoupper(Str::random(2)) . rand(1000, 9999);
        
        while (static::where('created_id', $id)->exists()) {
            $id = strtoupper(Str::random(2)) . rand(1000, 9999);
        }

        return $id;
    }

}
