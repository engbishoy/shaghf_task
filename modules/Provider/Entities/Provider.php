<?php

namespace Modules\Provider\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Provider\Entities\Location;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    use HasFactory, SoftDeletes,Notifiable;

    protected $guard=['provide'];
    protected $fillable = ['name','email','user_name'];
    protected $hidden = [
        'password',
    ];

    public function locations(){
        return $this->hasMany(Location::class);
    }

    protected static function newFactory()
    {
        return \Modules\Provider\Database\factories\ProviderFactory::new();
    }
}
