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
        
        $default    = \OkamiChen\TmsMobile\Entity\Mobile::class;
        $obj        = config('tms-wechat-config.mobile.class', $default);
        
        if(class_exists($obj)){
            return $this->belongsTo($obj);
        }
        
        return NULL;
    }

}
