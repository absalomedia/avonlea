<?php
/**
 * GC Class
 *
 * @package     Avonlea
 * @subpackage  Facade
 * @category    GC
 * @author      Clear Sky Designs
 * @link        http://Avonleadv.com
 */

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Static Avonlea Object
 */
class AVL
{

    private function __construct()
    {
    }
    private static $i;

    public static function instance()
    {
        if (!self::$i) {
            self::$i = new Avonlea();
        }

        return self::$i;
    }

    public static function __callStatic($method, $parameters = [])
    {
        self::instance();
        return call_user_func_array(array(self::$i, $method), $parameters);
    }
}

/* End of file GC.php */
/* Location: ./Avonlea/libraries/GC.php */
