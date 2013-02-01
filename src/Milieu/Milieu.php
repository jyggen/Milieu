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

	public static $environments;
	public static $path;

	protected $config;
	protected $device;
	protected $environment;

	public function __construct()
	{

		$this->device = new Device($this);

		if (static::$path !== null) {

			$this->config = new Config(static::$path, $this);

		}

		if (static::$environments !== null) {

			$this->environment = new Environment(static::$environments, $this);

		}

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