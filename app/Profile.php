<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    protected $fillable = ['user_id','about','picture','facebook','twitter','github','site'];

    // relationship between Profile and user so every Profile belongsTo User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
