<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'type',
        'price',
        'start_date',
        'end_date',
        'status',
    ];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
