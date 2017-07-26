<?php

declare(strict_types=1);

namespace Fabiang\Dateparser;

use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-25 at 17:34:16.
 *
 * @coversDefaultClass Fabiang\Dateparser\RFC3339
 */
final class RFC3339Test extends TestCase
{
    /**
     * @var RFC3339
     */
    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new RFC3339();
    }

    /**
     * @covers ::parse
     * @dataProvider provideValidDateStrings
     */
    public function testParse($date, $year, $month, $day, $hour, $minute, $second, $timezone, $microseconds)
    {
        $dateObject = $this->object->parse($date);
        $this->assertSame("$year-$month-$day", $dateObject->format('Y-m-d'));
        $this->assertSame("$hour:$minute:$second", $dateObject->format('H:i:s'));

        $this->assertSame(
            $timezone,
            $dateObject->getTimezone()->getOffset(new DateTime('UTC'))
        );

        $this->assertSame($microseconds, intval($dateObject->format('u')));

    }

    public function provideValidDateStrings(): array
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
                'microseconds' => 0
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
                'microseconds' => 123456
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
                'microseconds' => 123456
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
                'microseconds' => 0
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
                'microseconds' => 123456
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
                'microseconds' => 0
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
                'microseconds' => 123456
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
                'microseconds' => 0
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
                'microseconds' => 123456
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
                'microseconds' => 0
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
                'microseconds' => 123456
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
                'microseconds' => 0
            ],
        ];
    }
}
