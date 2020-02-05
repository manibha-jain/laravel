<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';

    public function children()
	{
	    return $this->hasMany('App\Category','category_id' ,'id');
	}
}
