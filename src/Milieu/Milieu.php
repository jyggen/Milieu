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

namespace Milieu;

class Milieu
{

	protected $config;
	protected $device;
	protected $environment;

	public function __construct()
	{

		$this->config      = new Config;
		$this->device      = new Device;
		$this->environment = new Environment;

	}

	public function config()
	{

		return $this->config;

	}

	public function device()
	{

		return $this->device;

	}

	public function env()
	{

		return $this->environment();

	}

	public function environment()
	{

		return $this->environment;

	}

}