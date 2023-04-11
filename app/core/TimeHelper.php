<?php
namespace app\core;

use IntlDateFormatter;
use DateTimeZone;
use DateTime;


class TimeHelper {

	//Outputting the time
	public static function DTOutput($s_datetime) {

		// Converting UTC to TZ to avoid time difference issues
		// Create the dateTime object in the timezone of reference for DB data
		$datetime = new DateTime($s_datetime, new DateTimeZone('UTC'));
		
		//TODO: pick the timezone
		global $tz;
		// $timezone='UTC';

		global $lang;
		// IntlDateFormatter is used to output the date not input
		$fmt = new IntlDateFormatter(
			//the language being used
			$lang,

			//DATE formatter
			// IntlDateFormatter::LONG,
			IntlDateFormatter::MEDIUM,
			// IntlDateFormatter::SHORT,

			//TIME formatter
			// IntlDateFormatter::LONG,
			IntlDateFormatter::MEDIUM,
			// IntlDateFormatter::SHORT,

			// $timezone
			$tz
		);

		return $fmt->format($datetime);
	}

	//Input the time
	//from TZ to UTC
	public static function DTInput($s_datetime){
		//create a datetime object in the local timezone
		global $tz; //imports $tz here
		$datetime = new DateTime($_datetime, new DateTimeZone($tz));

		//change the timezone
		$datetime->setTimezone(new DateTimeZone('UTC')); 

		//output to a standard string format
		return $datetime->format('Y-m-d H:i:s'); //this will output the datetime to a string depending on the format we give it
	}

	//from UTC to TZ
	public static function DTOutBrowser($s_datetime){
		//create a datetime object in the local timezone
		global $tz; //imports $tz here
		$datetime = new DateTime($s_datetime, new DateTimeZone('UTC'));

		//change the timezone
		$datetime->setTimezone(new DateTimeZone($tz)); 

		//output to a standard string format
		return $datetime->format('Y-m-d H:i:s'); //this will output the datetime to a string depending on the format we give it
	}



}