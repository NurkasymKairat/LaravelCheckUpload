<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;


    protected $fillable = ['image', 'status', 'user_id', 'date', 'code'];



    public function getStatusName(): string
    {
        return match ($this->attributes['status']) {
            '0' => "Принят",
            '1' => "Отклонён",
            default => '?',
        };
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
