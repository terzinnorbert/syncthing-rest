<?php

use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use Codeception\Util\Stub;
use GuzzleHttp\Exception\ServerException;
use SyncthingRest\Client;

class ClientTest extends Unit
{
    const RESTART_SLEEP = 10;
    const DEFAULT_FOLDER = 'default';
    const INVALID_FOLDER = 'invalid';
    const DEVICE = 'device';
    const DEVICE_IP = '192.168.0.1';
    /**
     * @var UnitTester
     */
    protected $tester;
    /**
     * @var Client
     */
    private $client;

    /**
     * @dataProvider convertTimeData
     * @param $time
     * @param $expected
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
                    '/lib32/',
                    '/lib64/',
                    '/libx32/',
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
                'ldap',
                'options',
                'remoteIgnoredDevices',
                'pendingDevices',
            ],
            array_keys($this->client->getSystemConfig())
        );
    }


    public function testPostDbOverride()
    {
        $this->client->postDbOverride(self::DEFAULT_FOLDER);
    }

    public function testPostDbRevert()
    {
        $this->client->postDbRevert(self::DEFAULT_FOLDER);
    }

    public function testGetDbNeed()
    {
        $this->assertEquals(
            [
                'page',
                'perpage',
                'progress',
                'queued',
                'rest',
            ],
            array_keys($this->client->getDbNeed(self::DEFAULT_FOLDER))
        );

        $response = $this->client->getDbNeed(self::DEFAULT_FOLDER, 2);
        $this->assertEquals(2, $response['page']);
        $this->assertEquals(65536, $response['perpage']);
        $response = $this->client->getDbNeed(self::DEFAULT_FOLDER, 2, 10);
        $this->assertEquals(2, $response['page']);
        $this->assertEquals(10, $response['perpage']);
    }

    public function testGetSystemPing()
    {
        $this->assertEquals(['ping' => 'pong'], $this->client->getSystemPing());
    }

    public function testPostSystemPing()
    {
        $this->assertEquals(['ping' => 'pong'], $this->client->postSystemPing());
    }

    public function testGetSvcReport()
    {
        $this->assertEquals(
            [
                'alwaysLocalNets',
                'announce',
                'blockStats',
                'cacheIgnoredFiles',
                'customDefaultFolderPath',
                'customReleaseURL',
                'customTempIndexMinBlocks',
                'customTrafficClass',
                'deviceUses',
                'folderMaxFiles',
                'folderMaxMiB',
                'folderUses',
                'folderUsesV3',
                'guiStats',
                'hashPerf',
                'ignoreStats',
                'limitBandwidthInLan',
                'longVersion',
                'memorySize',
                'memoryUsageMiB',
                'natType',
                'numCPU',
                'numDevices',
                'numFolders',
                'overwriteRemoteDeviceNames',
                'platform',
                'progressEmitterEnabled',
                'relays',
                'rescanIntvs',
                'restartOnWakeup',
                'sha256Perf',
                'temporariesCustom',
                'temporariesDisabled',
                'totFiles',
                'totMiB',
                'transportStats',
                'uniqueID',
                'upgradeAllowedAuto',
                'upgradeAllowedManual',
                'upgradeAllowedPre',
                'uptime',
                'urVersion',
                'usesRateLimit',
                'version',
            ],
            array_keys($this->client->getSvcReport())
        );
    }

    /**
     * @dataProvider getSvcRandomStringData
     * @param $length
     */
    public function testGetSvcRandomString($length)
    {
        $response = $this->client->getSvcRandomString($length);
        $this->assertTrue(array_key_exists('random', $response));
        $this->assertEquals($length, strlen($response['random']));
    }

    public function getSvcRandomStringData()
    {
        return [
            [10],
            [15],
            [100],
        ];
    }

    public function testPostSystemError()
    {
        $this->client->postSystemError('test');
        $response = $this->client->getSystemError();
        $hasError = false;
        foreach ($response['errors'] as $error) {
            if (strpos($error['message'], 'test')) {
                $hasError = true;
            }
        }
        $this->assertTrue($hasError);
    }

    public function testPostSystemDebug()
    {
        $this->assertEmpty($this->client->postSystemDebug(['config'], ['db']));
    }

    public function testGetDbFile()
    {
        $response = $this->client->getDbFile(self::DEFAULT_FOLDER, 'test.txt');
        $this->assertEquals(
            [
                'availability',
                'global',
                'local',
            ],
            array_keys($response)
        );

        foreach (['global', 'local'] as $type) {
            $this->assertEquals(
                [
                    'deleted',
                    'ignored',
                    'invalid',
                    'localFlags',
                    'modified',
                    'modifiedBy',
                    'mustRescan',
                    'name',
                    'noPermissions',
                    'numBlocks',
                    'permissions',
                    'sequence',
                    'size',
                    'type',
                    'version',
                ],
                array_keys($response[$type])
            );
        }
    }

    public function testGetSystemConfigInsync()
    {
        $this->assertEquals(['configInSync'], array_keys($this->client->getSystemConfigInsync()));

    }

    public function testGetEvents()
    {
        $response = $this->client->getEvents();
        $this->assertEquals(
            [
                'id',
                'globalID',
                'time',
                'type',
                'data',
            ],
            array_keys(current($response))
        );

        $response = $this->client->getEvents(3);
        $this->assertEquals(4, current($response)['id']);

        $response = $this->client->getEvents(null, 4);
        $this->assertEquals(4, count($response));

        $this->assertEmpty($this->client->getEvents(null, null, ['Starting', 'StartupComplete'], 5));
    }

    public function testPostSystemRestart()
    {
        $this->assertEquals(['ok' => 'restarting'], $this->client->postSystemRestart());
        sleep(self::RESTART_SLEEP);
    }

    public function testGetStatsDevice()
    {
        $response = $this->client->getStatsDevice();
        $this->assertTrue(array_key_exists('lastSeen', current($response)));

    }

    public function testPostSystemConfig()
    {
        $config = $this->client->getSystemConfig();
        $this->assertEquals(null, $this->client->postSystemConfig($config));
    }

    public function testPostDbIgnores()
    {
        $response = $this->client->postDbIgnores(self::DEFAULT_FOLDER, ['test.txt']);
        $this->assertEquals(['expanded', 'ignore'], array_keys($response));
        $this->assertCount(1, $response['ignore']);
        $this->assertCount(4, $response['expanded']);
        $this->assertEmpty($this->client->postDbIgnores(self::DEFAULT_FOLDER, [])['ignore']);
    }

    public function testGetSystemLog()
    {
        $response = $this->client->getSystemLog();
        $this->assertEquals(['messages'], array_keys($response));
        $this->assertEquals(['when', 'message', 'level'], array_keys(current($response['messages'])));
    }

    public function testGetSystemUpgrade()
    {
        $notAllowed = false;
        try {
            $this->client->getSystemUpgrade();
        } catch (ServerException $exception) {
            $notAllowed = true;
        }
        $this->assertTrue($notAllowed);
    }

    public function testGetDbBrowse()
    {
        $response = $this->client->getDbBrowse(self::DEFAULT_FOLDER);
        $this->assertEquals(['test', 'test.txt'], array_keys($response));
        $this->assertEmpty($response['test']);
        $this->assertCount(2, $response['test.txt']);
        $response = $this->client->getDbBrowse(self::DEFAULT_FOLDER, 1);
        $this->assertEquals(['subtest.txt'], array_keys($response['test']));
        $this->assertEquals(['subtest.txt'], array_keys($this->client->getDbBrowse(self::DEFAULT_FOLDER, 0, 'test')));
        $this->assertEmpty($this->client->getDbBrowse(self::DEFAULT_FOLDER, 0, 'te'));
        $this->assertEmpty($this->client->getDbBrowse(self::DEFAULT_FOLDER, 0, 'a'));
    }

    public function testPostSystemResume()
    {
        $this->client->postSystemResume();
        sleep(self::RESTART_SLEEP);
    }

    public function testPostDbPrio()
    {
        $this->assertEquals(
            [
                'page',
                'perpage',
                'progress',
                'queued',
                'rest',
            ],
            array_keys($this->client->postDbPrio(self::DEFAULT_FOLDER, 'test.txt'))
        );
    }

    public function testGetSvcLang()
    {
        $this->assertTrue(is_array($this->client->getSvcLang()));
    }

    public function testGetSystemDiscovery()
    {

        $this->assertTrue(is_array($this->client->getSystemDiscovery()));
    }

    public function testPostSystemReset()
    {
        $this->assertTrue(array_key_exists('ok', $this->client->postSystemReset()));
        sleep(self::RESTART_SLEEP);
        $this->assertTrue(array_key_exists('ok', $this->client->postSystemReset(self::DEFAULT_FOLDER)));
        sleep(self::RESTART_SLEEP);
        $notAllowed = false;
        try {
            $this->client->postSystemReset(self::INVALID_FOLDER);
        } catch (ServerException $exception) {
            $notAllowed = true;
        }
        $this->assertTrue($notAllowed);
    }

    public function testGetDbCompletion()
    {
        $myId = $this->client->getSystemStatus()['myID'];
        $this->assertEquals(
            [
                'completion',
                'globalBytes',
                'needBytes',
                'needDeletes',
                'needItems',
            ],
            array_keys($this->client->getDbCompletion($myId, self::DEFAULT_FOLDER))
        );
    }

    public function testGetDbIgnores()
    {
        $this->assertEquals(
            [
                'expanded',
                'ignore',
            ],
            array_keys($this->client->getDbIgnores(self::DEFAULT_FOLDER))
        );
    }

    public function testPostSystemErrorClear()
    {
        $this->assertEquals(null, $this->client->postSystemErrorClear());
    }

    public function testPostDbScan()
    {
        $this->assertEmpty($this->client->postDbScan());
        $this->assertEmpty($this->client->postDbScan(self::DEFAULT_FOLDER));
        $this->assertEmpty($this->client->postDbScan(self::DEFAULT_FOLDER, '/test'));
        $this->assertEmpty($this->client->postDbScan(self::DEFAULT_FOLDER, '/test', 10));
    }

    public function testPostSystemPause()
    {
        $this->assertEmpty($this->client->postSystemPause());
    }

    public function testGetSystemDebug()
    {
        $this->assertEquals(['enabled', 'facilities'], array_keys($this->client->getSystemDebug()));
    }

    public function testGetSystemStatus()
    {
        $this->assertEquals(
            [
                'alloc',
                'connectionServiceStatus',
                'cpuPercent',
                'discoveryEnabled',
                'discoveryErrors',
                'discoveryMethods',
                'goroutines',
                'guiAddressOverridden',
                'guiAddressUsed',
                'lastDialStatus',
                'myID',
                'pathSeparator',
                'startTime',
                'sys',
                'tilde',
                'uptime',
                'urVersionMax',
            ],
            array_keys($this->client->getSystemStatus())
        );
    }

    public function testGetDbStatus()
    {
        $this->assertEquals(
            [
                'errors',
                'globalBytes',
                'globalDeleted',
                'globalDirectories',
                'globalFiles',
                'globalSymlinks',
                'globalTotalItems',
                'ignorePatterns',
                'inSyncBytes',
                'inSyncFiles',
                'invalid',
                'localBytes',
                'localDeleted',
                'localDirectories',
                'localFiles',
                'localSymlinks',
                'localTotalItems',
                'needBytes',
                'needDeletes',
                'needDirectories',
                'needFiles',
                'needSymlinks',
                'needTotalItems',
                'pullErrors',
                'sequence',
                'state',
                'stateChanged',
                'version',
            ],
            array_keys($this->client->getDbStatus(self::DEFAULT_FOLDER))
        );
    }

    public function testGetSystemVersion()
    {
        $this->assertEquals(
            [
                'arch',
                'codename',
                'isBeta',
                'isCandidate',
                'isRelease',
                'longVersion',
                'os',
                'version',
            ],
            array_keys($this->client->getSystemVersion())
        );
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
        $response = $this->client->getStatsFolder();
        $this->assertTrue(array_key_exists(self::DEFAULT_FOLDER, $response));
        $this->assertEquals(['lastFile', 'lastScan'], array_keys($response[self::DEFAULT_FOLDER]));
    }

    public function testPostSystemUpgrade()
    {
        $notAllowed = false;
        try {
            $this->client->postSystemUpgrade();
        } catch (ServerException $exception) {
            $notAllowed = true;
        }
        $this->assertTrue($notAllowed);
    }

    public function testGetSvcDeviceId()
    {
        $myId = $this->client->getSystemStatus()['myID'];
        $this->assertEquals(['error'], array_keys($this->client->getSvcDeviceId('123')));
        $this->assertEquals(['id' => $myId], $this->client->getSvcDeviceId($myId));
    }

    public function testPostSystemShutdown()
    {
        $client = Stub::makeEmptyExcept(
            Client::class,
            'postSystemShutdown',
            [
                'post' => Expected::once(
                    function ($value) {
                        $this->assertEquals('system/shutdown', $value);
                    }
                ),
            ],
            $this
        );

        $client->postSystemShutdown();
    }

    protected function _before()
    {
        $this->client = new Client('http://localhost:8380', 'c180235c30a980484a512472d97f8832');
    }

    protected function _after()
    {
    }
}