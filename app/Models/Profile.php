<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function followers() {
        return $this->belongsToMany(User::class);
    }


    public function profileImage(){
        
        //return ($this->image) ? $this->image : '/storage/profile/No_image.png';
        return ($this->image) ? $this->image : 'https://res.cloudinary.com/dmluuycmo/image/upload/v1656786517/profile/No_image_z8gjht.png';


    }
}
