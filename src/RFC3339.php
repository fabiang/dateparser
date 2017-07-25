<?php

namespace Fabiang\Dateparser;

use DateTime;
use DateTimeZone;

class RFC3339 extends Parser
{
    public function parse(string $string): DateTime
    {
        $dateToken = $this->baseParse('RFC3339', $string);

        $tokens = [];
        foreach ($dateToken->getChildren() as $child) {
            $value = $child->getValue();
            $tokens[$value['token']] = $value['value'];
        }

        $microseconds = 0;
        if (isset($tokens['microseconds'])) {
            $microseconds = $tokens['microseconds'];
        }

        $dateString = sprintf(
            '%d-%02d-%02dT%02d:%02d:%02d.%d',
            $tokens['year'], 
            $tokens['month'],
            $tokens['day'],
            $tokens['hour'], 
            $tokens['minute'],
            $tokens['second'],
            $microseconds
        );

        if (isset($tokens['timezone_utc'])) {
            $dateString .= '+0000';
        } elseif (isset($tokens['timezone_positive'])) {
            $timezoneValue = $this->getTimezoneValue($tokens, false);
            $dateString .= '+' . $timezoneValue;
        } elseif (isset($tokens['timezone_negative'])) {
            $timezoneValue = $this->getTimezoneValue($tokens, true);
            $dateString .= '-' . $timezoneValue;
        }

        $dateObject = new DateTime($dateString);
        return $dateObject;
    }

    private function getTimezoneValue($tokens, $negative = false)
    {
        if (isset($tokens['timezone_value'])) {
            return $tokens['timezone_value'];
        }

        return $tokens['_timezone'] . $tokens['timezone_'];
    }
}
