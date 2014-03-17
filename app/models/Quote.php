<?php

class Quote extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quotes';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('id','created_at','updated_at');
	protected $appends = array('number_of_orders','location');



	public function getLocationAttribute() {
//        return URL::to('products?' . 'upc=' . $this->upc);
		return URL::to('api/v1/quotes/' . $this->id);
	}

	// public function getImageAttribute($image)
	// {
	// 	return URL::to('images/'.$image);
	// }

	public function user() {
		return $this->belongsTo('User');
	}

	public function orders() {
		return $this->hasMany('Order');
	}

	public function includeOrders() {
		$this->hidden = array_diff($this->hidden, array('orders'));
	}

	public function getNumberOfOrdersAttribute() {
        return count($this->orders);
    }

}