<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\File;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasMediaTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'name', 'username', 'password', 'type', 'school',
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Registro dos tipos de mídia
    public function registerMediaCollections()
    {
      $this
        ->addMediaCollection('picture')
        ->singleFile();
      $this
        ->addMediaCollection('thumb')
        ->singleFile();
    }
    //Redimensionamento da foto de perfil para thumbnail
    public function registerMediaConversions(Media $media = null)
    {
      $this->addMediaConversion('picture')
        ->crop('crop-center', 125, 125);
      $this->addMediaConversion('thumb')
        ->crop('crop-center', 24, 24);
    }
}
