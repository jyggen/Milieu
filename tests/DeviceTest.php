<?php
/**
 * An environment initialization, device detection and app configuration library.
 *
 * @package     Milieu
 * @version     1.0
 * @author      Jonas Stendahl
 * @license     MIT License
 * @copyright   2013 Jonas Stendahl
 * @link        http://github.com/jyggen/Milieu
 */

use Milieu\Device;

class DeviceTest extends PHPUnit_Framework_TestCase {

	public function testGetUserAgent()
	{

		$expectedAgent              = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';
		$_SERVER['HTTP_USER_AGENT'] = $expectedAgent;
		$device                     = new Device();
		$detectedAgent              = $device->getUserAgent();

		$this->assertEquals($detectedAgent, $expectedAgent);

	}

	public function testGetUserAgentXDevice()
	{

		$expectedAgent = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';

		$_SERVER['HTTP_X_DEVICE_USER_AGENT'] = $expectedAgent;

		$device        = new Device();
		$detectedAgent = $device->getUserAgent();

		$this->assertEquals($detectedAgent, $expectedAgent);

	}

	public function testGetUserAgentOperaMini()
	{

		$expectedAgent = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';

		$_SERVER['HTTP_USER_AGENT']           = 'Mozilla/5.0';
		$_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] = '(compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';

		$device        = new Device();
		$detectedAgent = $device->getUserAgent();

		$this->assertEquals($detectedAgent, $expectedAgent);

	}

	public function testGetUserAgentXDeviceOperaMini()
	{

		$expectedAgent = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';

		$_SERVER['HTTP_X_DEVICE_USER_AGENT']  = 'Mozilla/5.0';
		$_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] = '(compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';

		$device        = new Device();
		$detectedAgent = $device->getUserAgent();

		$this->assertEquals($detectedAgent, $expectedAgent);

	}

	public function testIsConsole()
	{

		$device    = new Device();
		$isConsole = $device->isConsole();

		$this->assertTrue($isConsole);

	}

}