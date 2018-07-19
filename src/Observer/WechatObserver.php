<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OkamiChen\TmsWechat\Observer;

use OkamiChen\TmsMobile\Entity\Mobile;
/**
 * Description of TaskObserver
 * @date 2018-6-21 17:47:15
 * @author dehua
 */
class WechatObserver {
    
    public function creating($model){
        $mobile = Mobile::find($model->mobile_id);
        $model->mobile  = $mobile->mobile;
        return $model;
    }
    
    public function updating($model){
        $mobile = Mobile::find($model->mobile_id);
        $model->mobile  = $mobile->mobile;
        return $model;        
    }
}
