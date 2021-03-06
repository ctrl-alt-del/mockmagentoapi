<?php

class Order extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at','updated_at');
	protected $appends = array('location');

	public function getLocationAttribute() {
//        return URL::to('products?' . 'upc=' . $this->upc);
		return URL::to('api/v1/orders/' . $this->id);
	}

	// public function getImageAttribute($image)
	// {
	// 	return URL::to('images/'.$image);
	// }

    public function product() {
        return $this->belongsTo('Product');
    }

     public function quote() {
        return $this->belongsTo('Quote');
    }

}