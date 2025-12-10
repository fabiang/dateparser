<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

use function intval;

#[CoversClass(RFC3339::class)]
#[UsesClass(AbstractParser::class)]
final class RFC3339Test extends TestCase
{
    private RFC3339 $object;

    protected function setUp(): void
    {
        $this->object = new RFC3339();
    }

    #[DataProvider('provideValidDateStrings')]
    public function testParse(
        string $date,
        string $year,
        string $month,
        string $day,
        string $hour,
        string $minute,
        string $second,
        int $timezone,
        int $microseconds
    ): void {
        $dateObject = $this->object->parse($date);
        $this->assertSame("$year-$month-$day", $dateObject->format('Y-m-d'));
        $this->assertSame("$hour:$minute:$second", $dateObject->format('H:i:s'));

        $this->assertSame(
            $timezone,
            $dateObject->getTimezone()->getOffset(new DateTime('UTC'))
        );

        $this->assertSame($microseconds, intval($dateObject->format('u')));
    }

    public static function provideValidDateStrings(): array
    {
        return [
            [
                'date'         => '2017-07-25T18:37:40',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 0,
                'microseconds' => 0,
            ],
            [
                'date'         => '2017-07-25T18:37:40.1234567890',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 0,
                'microseconds' => 123456,
            ],
            [
                'date'         => '2017-07-25T18:37:40.1234567890Z',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 0,
                'microseconds' => 123456,
            ],
            [
                'date'         => '2017-07-25T18:37:40Z',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 0,
                'microseconds' => 0,
            ],
            [
                'date'         => '2017-07-25T18:37:40.1234567890+0200',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 7200,
                'microseconds' => 123456,
            ],
            [
                'date'         => '2017-07-25T18:37:40+0200',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 7200,
                'microseconds' => 0,
            ],
            [
                'date'         => '2017-07-25T18:37:40.1234567890-0400',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => -14400,
                'microseconds' => 123456,
            ],
            [
                'date'         => '2017-07-25T18:37:40-0400',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => -14400,
                'microseconds' => 0,
            ],
            [
                'date'         => '2017-07-25T18:37:40.1234567890+02:00',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 7200,
                'microseconds' => 123456,
            ],
            [
                'date'         => '2017-07-25T18:37:40+02:00',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => 7200,
                'microseconds' => 0,
            ],
            [
                'date'         => '2017-07-25T18:37:40.1234567890-04:00',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => -14400,
                'microseconds' => 123456,
            ],
            [
                'date'         => '2017-07-25T18:37:40-04:00',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '25',
                'hour'         => '18',
                'minute'       => '37',
                'second'       => '40',
                'timezone'     => -14400,
                'microseconds' => 0,
            ],
            [
                'date'         => '2017-07-28T12:39:55.867906479+02:00',
                'year'         => '2017',
                'month'        => '07',
                'day'          => '28',
                'hour'         => '12',
                'minute'       => '39',
                'second'       => '55',
                'timezone'     => 7200,
                'microseconds' => 867906,
            ],
            [
                'date'         => '1985-02-19T00:00:00+00:00',
                'year'         => '1985',
                'month'        => '02',
                'day'          => '19',
                'hour'         => '00',
                'minute'       => '00',
                'second'       => '00',
                'timezone'     => 0,
                'microseconds' => 0,
            ],
            [
                'date'         => '2022-06-24T14:21:58+00:00',
                'year'         => '2022',
                'month'        => '06',
                'day'          => '24',
                'hour'         => '14',
                'minute'       => '21',
                'second'       => '58',
                'timezone'     => 0,
                'microseconds' => 0,
            ],
        ];
    }
}
