<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
      protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    //追記。comment　MODELに関連付けを行う
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
     public function histories()
    {
            return $this->hasMany('App\History');
            
    }
}
