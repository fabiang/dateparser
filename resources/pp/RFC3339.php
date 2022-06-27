<?php
return [
    'initial' => 'datestring',
    'tokens' => [
        'default' => [
            'T_YEAR' => '\\d\\d\\d\\d',
            'T_TIME_SEPARATOR' => ':',
        ],
        'month' => [
            'T_MONTH' => '01|02|03|04|05|06|07|08|09|10|11|12',
            'T_DATE_SEPARATOR' => '-',
        ],
        'day' => [
            'T_DAY' => '01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31',
            'T_DATE_SEPARATOR' => '-',
        ],
        'sep' => [
            'T_TIME_FROM_DATE_SEPARATOR' => 'T',
        ],
        'hour' => [
            'T_HOUR' => '\\d{2}',
        ],
        'minute' => [
            'T_MINUTE' => '\\d{2}',
            'T_TIME_SEPARATOR' => ':',
        ],
        'second' => [
            'T_SECOND' => '\\d{2}',
            'T_TIME_SEPARATOR' => ':',
        ],
        'timezone' => [
            'T_MICROSECONDS_SEPARATOR' => '\\.',
            'T_TIMEZONE_POSITIVE' => '\\+',
            'T_TIMEZONE_NEGATIVE' => '-',
            'T_TIMEZONE_UTC' => 'Z',
            'T_TIMEZONE_VALUE' => '\\d{4}',
            'T_TIMEZONE_LEFT' => '\\d{2}',
        ],
        'microsecond' => [
            'T_MICROSECOND' => '\\d+',
        ],
        'timezone_seperated' => [
            'T_TIMEZONE_RIGHT' => '\\d{2}',
            'T_TIMEZONE_SEPARATOR' => ':',
        ],
    ],
    'skip' => [
        
    ],
    'transitions' => [
        'default' => [
            'T_YEAR' => 'month',
        ],
        'month' => [
            'T_MONTH' => 'day',
        ],
        'day' => [
            'T_DAY' => 'sep',
        ],
        'sep' => [
            'T_TIME_FROM_DATE_SEPARATOR' => 'hour',
        ],
        'hour' => [
            'T_HOUR' => 'minute',
        ],
        'minute' => [
            'T_MINUTE' => 'second',
        ],
        'second' => [
            'T_SECOND' => 'timezone',
        ],
        'timezone' => [
            'T_MICROSECONDS_SEPARATOR' => 'microsecond',
            'T_TIMEZONE_VALUE' => 'default',
            'T_TIMEZONE_LEFT' => 'timezone_seperated',
        ],
        'microsecond' => [
            'T_MICROSECOND' => 'timezone',
        ],
        'timezone_seperated' => [
            'T_TIMEZONE_RIGHT' => 'default',
        ],
    ],
    'grammar' => [
        'datestring' => new \Phplrt\Parser\Grammar\Concatenation([0, 4, 1, 5, 6]),
        0 => new \Phplrt\Parser\Grammar\Concatenation([7, 8, 9, 10, 11]),
        1 => new \Phplrt\Parser\Grammar\Concatenation([12, 13, 14, 15, 16]),
        2 => new \Phplrt\Parser\Grammar\Concatenation([17, 18]),
        3 => new \Phplrt\Parser\Grammar\Alternation([19, 24]),
        4 => new \Phplrt\Parser\Grammar\Lexeme('T_TIME_FROM_DATE_SEPARATOR', false),
        5 => new \Phplrt\Parser\Grammar\Optional(2),
        6 => new \Phplrt\Parser\Grammar\Optional(3),
        7 => new \Phplrt\Parser\Grammar\Lexeme('T_YEAR', true),
        8 => new \Phplrt\Parser\Grammar\Lexeme('T_DATE_SEPARATOR', false),
        9 => new \Phplrt\Parser\Grammar\Lexeme('T_MONTH', true),
        10 => new \Phplrt\Parser\Grammar\Lexeme('T_DATE_SEPARATOR', false),
        11 => new \Phplrt\Parser\Grammar\Lexeme('T_DAY', true),
        12 => new \Phplrt\Parser\Grammar\Lexeme('T_HOUR', true),
        13 => new \Phplrt\Parser\Grammar\Lexeme('T_TIME_SEPARATOR', false),
        14 => new \Phplrt\Parser\Grammar\Lexeme('T_MINUTE', true),
        15 => new \Phplrt\Parser\Grammar\Lexeme('T_TIME_SEPARATOR', false),
        16 => new \Phplrt\Parser\Grammar\Lexeme('T_SECOND', true),
        17 => new \Phplrt\Parser\Grammar\Lexeme('T_MICROSECONDS_SEPARATOR', false),
        18 => new \Phplrt\Parser\Grammar\Lexeme('T_MICROSECOND', true),
        19 => new \Phplrt\Parser\Grammar\Lexeme('T_TIMEZONE_UTC', true),
        20 => new \Phplrt\Parser\Grammar\Lexeme('T_TIMEZONE_POSITIVE', true),
        21 => new \Phplrt\Parser\Grammar\Lexeme('T_TIMEZONE_NEGATIVE', true),
        23 => new \Phplrt\Parser\Grammar\Alternation([20, 21]),
        24 => new \Phplrt\Parser\Grammar\Concatenation([23, 22]),
        25 => new \Phplrt\Parser\Grammar\Lexeme('T_TIMEZONE_VALUE', true),
        26 => new \Phplrt\Parser\Grammar\Lexeme('T_TIMEZONE_LEFT', true),
        27 => new \Phplrt\Parser\Grammar\Lexeme('T_TIMEZONE_SEPARATOR', false),
        28 => new \Phplrt\Parser\Grammar\Lexeme('T_TIMEZONE_RIGHT', true),
        29 => new \Phplrt\Parser\Grammar\Concatenation([26, 27, 28]),
        22 => new \Phplrt\Parser\Grammar\Alternation([25, 29])
    ],
    'reducers' => [

    ]
];