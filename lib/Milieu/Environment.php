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

class Environment
{

	const DEFAULT_ENV = 'default';

	protected $current;
	protected $environments;
	protected $milieu;

	public function __construct(array $environments, Milieu $milieu = null)
	{

		$this->milieu       = $milieu;
		$this->environments = $environments;
		$this->current      = $this->detect();

	}

	public function __toString()
	{

		return $this->current();

	}

	public function current()
	{

		return $this->current;

	}

	public function is($name)
	{

		return ($this->current === $name);

	}

	protected function detect()
	{

		foreach ($this->environments as $env => $filters) {

			if ($env === self::DEFAULT_ENV) {

				throw new \RuntimeException(sprintf('Unable to use protected environment name "%s".', self::DEFAULT_ENV));

			}

			foreach ($filters as $filter) {

				// If it's true.
				if ($filter === true) {

					return $env;

				// If it's a closure and it returns true.
				} elseif (is_callable($filter) and call_user_func($filter, $this->milieu) === true) {

					return $env;

				// If it's a string.
				} elseif (gettype($filter) === 'string') {

					// Check if it matches the machine name.
					if (fnmatch($filter, gethostname())) {

						return $env;

					// Check if it matches the server name.
					} elseif (array_key_exists('SERVER_NAME', $_SERVER) and fnmatch($filter, $_SERVER['SERVER_NAME'])) {

						return $env;

					// Check if it matches the server IP.
					} elseif (array_key_exists('SERVER_ADDR', $_SERVER) and fnmatch($filter, $_SERVER['SERVER_ADDR'])) {

						return $env;

					// Check if it matches the HTTP host.
					} elseif (array_key_exists('HTTP_HOST', $_SERVER) and fnmatch($filter, $_SERVER['HTTP_HOST'])) {

						return $env;

					// Check if it matches the remote IP.
					} elseif (array_key_exists('REMOTE_ADDR', $_SERVER) and fnmatch($filter, $_SERVER['REMOTE_ADDR'])) {

						return $env;

					}

				}

			}

		}

		// Return DEFAULT_ENV.
		return self::DEFAULT_ENV;

	}

}