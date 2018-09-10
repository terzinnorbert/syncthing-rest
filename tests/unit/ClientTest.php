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


    public function testPostDbOverride()
    {

    }

    public function testGetDbNeed()
    {

    }

    public function testGetSystemPing()
    {
        $this->assertEquals(['ping' => 'pong'], $this->client->getSystemPing());
    }

    public function testPostSystemPing()
    {

    }

    public function testGetSvcReport()
    {

    }

    public function testGetSvcRandomString()
    {

    }

    public function testPostSystemError()
    {

    }

    public function testPostSystemDebug()
    {

    }

    public function testGetDbFile()
    {

    }

    public function testGetSystemConfigInsync()
    {
        $this->assertEquals(['configInSync'], array_keys($this->client->getSystemConfigInsync()));

    }

    public function testGetEvents()
    {

    }

    public function testPostSystemRestart()
    {

    }

    public function testPostSystemDiscovery()
    {

    }

    public function testGetStatsDevice()
    {

    }

    public function testPostSystemConfig()
    {

    }

    public function testPostDbIgnores()
    {

    }

    public function testGetSystemLog()
    {
        $response = $this->client->getSystemLog();
        $this->assertEquals(['messages'], array_keys($response));
        $this->assertEquals(['when', 'message', 'level'], array_keys(current($response['messages'])));
    }

    public function testGetSystemUpgrade()
    {

    }

    public function testGetDbBrowse()
    {

    }

    public function testPostSystemResume()
    {

    }

    public function testPostDbPrio()
    {

    }

    public function testGetSvcLang()
    {

    }

    public function testGetSystemDiscovery()
    {

        $this->assertTrue(is_array($this->client->getSystemDiscovery()));
    }

    public function testPostSystemReset()
    {

    }

    public function testGetDbCompletion()
    {

    }

    public function testGetDbIgnores()
    {

    }

    public function testPostSystemErrorClear()
    {

    }

    public function testPostDbScan()
    {

    }

    public function testPostSystemPause()
    {

    }

    public function testGetSystemDebug()
    {
        $this->assertEquals(['enabled', 'facilities'], array_keys($this->client->getSystemDebug()));
    }

    public function testGetSystemStatus()
    {

    }

    public function testGetDbStatus()
    {

    }

    public function testGetSystemVersion()
    {

    }

    public function testGetSystemError()
    {
        $this->assertEquals(['errors'], array_keys($this->client->getSystemError()));
    }

    public function testGetSystemConnections()
    {
        $this->assertEquals(['connections', 'total'], array_keys($this->client->getSystemConnections()));
    }

    public function testGetStatsFolder()
    {

    }

    public function testPostSystemShutdown()
    {

    }

    public function testPostSystemUpgrade()
    {

    }

    public function testGetSvcDeviceid()
    {

    }

    protected function _before()
    {
        $this->client = new Client('http://localhost:8380', 'c180235c30a980484a512472d97f8832');
    }

    protected function _after()
    {
    }
}