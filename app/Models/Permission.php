<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'system_id',
        'profile_id',
        'state',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function systems()
    {
        return $this->belongsToMany(System::class);
    }
    
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
