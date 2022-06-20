<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use DateTime;

class RFC3339 extends Parser
{
    public const T_YEAR              = 'T_YEAR';
    public const T_MONTH             = 'T_MONTH';
    public const T_DAY               = 'T_DAY';
    public const T_HOUR              = 'T_HOUR';
    public const T_MINUTE            = 'T_MINUTE';
    public const T_SECOND            = 'T_SECOND';
    public const T_MICROSECOND       = 'T_MICROSECOND';
    public const T_TIMEZONE_UTC      = 'T_TIMEZONE_UTC';
    public const T_TIMEZONE_POSITIVE = 'T_TIMEZONE_POSITIVE';
    public const T_TIMEZONE_NEGATIVE = 'T_TIMEZONE_NEGATIVE';
    public const T_TIMEZONE_VALUE    = 'T_TIMEZONE_VALUE';
    public const T_TIMEZONE_LEFT     = 'T_TIMEZONE_LEFT';
    public const T_TIMEZONE_RIGHT    = 'T_TIMEZONE_RIGHT';

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
        if (isset($tokens[self::T_MICROSECOND])) {
            $parseString = 'Y-m-d\TH:i:s.u';
            $microseconds = '.' . substr($tokens[self::T_MICROSECOND], 0, 6);
        }

        $dateString = sprintf(
            '%d-%02d-%02dT%02d:%02d:%02d%s',
            $tokens[self::T_YEAR],
            $tokens[self::T_MONTH],
            $tokens[self::T_DAY],
            $tokens[self::T_HOUR],
            $tokens[self::T_MINUTE],
            $tokens[self::T_SECOND],
            $microseconds
        );

        if (isset($tokens[self::T_TIMEZONE_UTC])) {
            $parseString .= 'O';
            $dateString .= '+0000';
        } elseif (isset($tokens[self::T_TIMEZONE_POSITIVE])) {
            $parseString .= 'O';
            $timezoneValue = $this->getTimezoneValue($tokens);
            $dateString .= '+' . $timezoneValue;
        } elseif (isset($tokens[self::T_TIMEZONE_NEGATIVE])) {
            $parseString .= 'O';
            $timezoneValue = $this->getTimezoneValue($tokens);
            $dateString .= '-' . $timezoneValue;
        }

        $dateObject = DateTime::createFromFormat($parseString, $dateString);
        return $dateObject;
    }

    private function getTimezoneValue(array $tokens): string
    {
        if (isset($tokens[self::T_TIMEZONE_VALUE])) {
            return $tokens[self::T_TIMEZONE_VALUE];
        }

        return $tokens[self::T_TIMEZONE_LEFT] . $tokens[self::T_TIMEZONE_RIGHT];
    }
}
