<?php

declare(strict_types=1);

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

        $parseString = 'Y-m-d\TH:i:s';
        $microseconds = '';
        if (isset($tokens['microsecond'])) {
            $parseString = 'Y-m-d\TH:i:s.u';
            $microseconds = '.' . substr($tokens['microsecond'], 0, 6);
        }

        $dateString = sprintf(
            '%d-%02d-%02dT%02d:%02d:%02d%s',
            $tokens['year'], 
            $tokens['month'],
            $tokens['day'],
            $tokens['hour'], 
            $tokens['minute'],
            $tokens['second'],
            $microseconds
        );

        if (isset($tokens['timezone_utc'])) {
            $parseString .= 'O';

            $dateString .= '+0000';
        } elseif (isset($tokens['timezone_positive'])) {
            $parseString .= 'O';

            $timezoneValue = $this->getTimezoneValue($tokens, false);
            $dateString .= '+' . $timezoneValue;
        } elseif (isset($tokens['timezone_negative'])) {
            $parseString .= 'O';

            $timezoneValue = $this->getTimezoneValue($tokens, true);
            $dateString .= '-' . $timezoneValue;
        }

        $dateObject = DateTime::createFromFormat($parseString, $dateString);
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
