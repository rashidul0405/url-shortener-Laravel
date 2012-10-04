<?php

class Url extends Eloquent {
	public static $timestamps = false;

	public static $rules = array(
		'url' => 'required|url'
	);

	public static function validate($input)
	{
		$v = Validator::make($input, static::$rules);
		return $v->fails()
			? $v
			: true;
	}

	public static function get_unique_short_url()
	{
		$shortened = base_convert(rand(10000,99999), 10, 36);
		if ( static::where_shortened($shortened)->first() ) {
			return static::get_unique_short_url();
		}

		return $shortened;
	}
}