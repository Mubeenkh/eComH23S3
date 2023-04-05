<?php
namespace app\core;

use IntlDateFormatter;
use DateTime;

class TimeHelper {

	public static function DTOutput($s_datetime) {

		$datetime = new DateTime($s_datetime);
		//TODO: pick the timezone
		$timezone='UTC';
		global $lang;
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

			$timezone

		);

		return $fmt->format($datetime);
	}

}