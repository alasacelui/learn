<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable,InteractsWithMedia ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


        /**
     * check for role 
     * @var integer  0 = user ; 1 = admin
     */
    public function hasRole($role)
    {
        if($this->role == $role ) {
            return true;
        }

        return false;
    }


    public function registerMediaCollections(): void
    {
        // create a card size image
        $this->addMediaConversion('avatar')
        ->width(300)
        ->height(300);

        $this->addMediaConversion('thumbnail')
        ->width(120)
        ->height(120);
    }

    public function avatar()
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }

    public function getAvatarUrlAttribute()
    {
        return optional($this->avatar)->getUrl('avatar');
    }

    public function getAvatarThumbnailAttribute()
    {
        return optional($this->avatar)->getUrl('thumbnail');
    }




}
