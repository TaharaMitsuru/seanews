<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seanews extends Model
{
    //追記
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    //追記。NEWS　MODELに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\History');
    }
}
