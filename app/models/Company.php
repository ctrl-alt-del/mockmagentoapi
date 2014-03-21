<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at','updated_at');
	protected $appends = array('location');
	
    
    public function getLocationAttribute() {
//        return URL::to('products?' . 'upc=' . $this->upc);
        return URL::to('api/v1/products/' . $this->id);
    }

	// public function getImageAttribute($image)
	// {
	// 	return URL::to('images/'.$image);
	// }

    public function quote() {
        return $this->belongsTo('Quote');
    }

}