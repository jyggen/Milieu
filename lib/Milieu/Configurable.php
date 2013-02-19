<?php
namespace Milieu;

interface Configurable
{

    public function delete($item);

    public function get($item, $default = null);

    public function load($file, $group = null, $reload = false, $overwrite = false);

    public function save($file, $config = null);

    public function set($item, $value);

}