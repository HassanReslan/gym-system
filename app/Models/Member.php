<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'image',
    ];

    public function getAge(){

        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
