<?php

namespace Modules\Provider\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Provider\Entities\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['provider_id','latitude','longitude'];
    
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    protected static function newFactory()
    {
        return \Modules\Provider\Database\factories\LocationFactory::new();
    }
}
