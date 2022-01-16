<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  
   protected $guarded = array('id');
    
    public static $rules = array(
        'body' => 'required',
        'title' => 'required',
        
    );
     public function histories()
   {
            return $this->hasMany('App\History');
            
   }
}
