<?php

namespace OkamiChen\TmsWechat\Entity;

use Illuminate\Database\Eloquent\Model;

class Wechat extends Model
{
    protected $table    = 'wechat';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'mobile_id'
    ];
    
    /**
     * 
     * @return \OkamiChen\TmsMobile\Entity\Mobile | NULL
     */
    public function phone(){
        return $this->belongsTo(\OkamiChen\TmsMobile\Entity\Mobile::class, 'mobile_id');
    }

}
