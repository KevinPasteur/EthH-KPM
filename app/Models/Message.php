<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Casts\ObjectId;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    protected  $connection = 'mongodb';

    protected  $collection = 'messages';
    protected $fillable = ['user_id', 'content'];

    protected $casts = [
        'user_id' => ObjectId::class,
    ];




    public function user()
    {
        return $this->belongsTo(User::class);
    }
}