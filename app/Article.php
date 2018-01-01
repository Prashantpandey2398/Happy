<?php

namespace App;

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Article extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'user_id', 'make_public'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
