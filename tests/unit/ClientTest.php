<?php

use SyncthingRest\Client;

class ClientTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var Client
     */
    private $client;

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
            ['2018-05-08T14:42:35.320697136+02:00', ['2018-05-08 14:42:35', 320697]],
            ['2018-01-12T18:24:44.120872+01:00', ['2018-01-12 18:24:44', 120872]],
            ['2018-01-12T18:25:17.55452+01:00', ['2018-01-12 18:25:17', 554520]],
            ['2018-01-12T18:25:17.55+01:00', ['2018-01-12 18:25:17', 550000]],
        ];
    }

    /**
     * @dataProvider getSystemBrowseData
     * @param $current
     * @param $expected
     */
    public function testGetSystemBrowse($current, $expected)
    {
        $this->assertEquals($expected, $this->client->getSystemBrowse($current));
    }

    public function getSystemBrowseData()
    {
        return [
            [null, ['/']],
            [
                '/',
                [
                    '/bin/',
                    '/boot/',
                    '/dev/',
                    '/etc/',
                    '/home/',
                    '/lib/',
                    '/lib64/',
                    '/media/',
                    '/mnt/',
                    '/opt/',
                    '/proc/',
                    '/root/',
                    '/run/',
                    '/sbin/',
                    '/srv/',
                    '/sys/',
                    '/tmp/',
                    '/usr/',
                    '/var/',
                ],
            ],
            ['/va', ['/var/']],
            [
                '/var/',
                [
                    '/var/backups/',
                    '/var/cache/',
                    '/var/lib/',
                    '/var/local/',
                    '/var/lock/',
                    '/var/log/',
                    '/var/mail/',
                    '/var/opt/',
                    '/var/run/',
                    '/var/spool/',
                    '/var/tmp/',
                    '/var/www/',
                ],
            ],
        ];
    }

    public function testGetSystemConfig()
    {
        $this->assertEquals(
            [
                'version',
                'folders',
                'devices',
                'gui',
                'options',
                'ignoredDevices',
                'ignoredFolders',
            ],
            array_keys($this->client->getSystemConfig())
        );
    }

    protected function _before()
    {
        $this->client = new Client('http://localhost:8380', 'c180235c30a980484a512472d97f8832');
    }

    protected function _after()
    {
    }
}