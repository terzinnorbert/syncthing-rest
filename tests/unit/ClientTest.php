<?php

use SyncthingRest\Client;

class ClientTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @dataProvider convertTimeData
     * @param $time
     */
    public function testConvertTime($time, $expected)
    {
        $carbon = Client::convertTime($time);
        $this->assertEquals($expected[0], $carbon->toDateTimeString());
        $this->assertEquals($expected[1], $carbon->micro);
    }

    /**
     * @return array
     */
    public function convertTimeData()
    {
        return [
            ['2017-10-02T18:47:00Z', ['2017-10-02 18:47:00', 0]],
            ['2018-05-06T10:21:00.533401659Z', ['2018-05-06 10:21:00', 533401]],
        ];
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }
}