<?php
    if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
/**
 * CodeIgniter.
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 *
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Session Class.
 *
 * @category	Sessions
 *
 * @author		ExpressionEngine Dev Team
 *
 * @link		http://codeigniter.com/user_guide/libraries/sessions.html
 */
class Session
{
    /**
     * Session Constructor.
     *
     * The constructor runs the session routines automatically
     * whenever the class is instantiated.
     */
    public function __construct()
    {
        log_message('debug', 'Session Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Destroy the current session.
     *
     * @return void
     */
    public function sess_destroy()
    {
        //clear the userdata var
        $_SESSION['userdata'] = [];
        $_SESSION['newFlashdata'] = [];
        $_SESSION['oldFlashdata'] = [];
    }

    // --------------------------------------------------------------------

    /**
     * Fetch a specific item from the session array.
     *
     * @param	string
     *
     * @return string
     */
    public function userdata($item)
    {
        return (!isset($_SESSION['userdata'][$item])) ? false : $_SESSION['userdata'][$item];
    }

    // --------------------------------------------------------------------

    /**
     * Fetch all session data.
     *
     * @return array
     */
    public function all_userdata()
    {
        return $_SESSION['userdata'];
    }

    // --------------------------------------------------------------------

    /**
     * Add or change data in the "userdata" array.
     *
     * @param	mixed
     * @param	string
     *
     * @return void
     */
    public function set_userdata($newdata = [], $newval = '')
    {
        if (is_string($newdata)) {
            $newdata = [$newdata => $newval];
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $_SESSION['userdata'][$key] = $val;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Delete a session variable from the "userdata" array.
     *
     * @return void
     */
    public function unset_userdata($newdata = [])
    {
        if (is_string($newdata)) {
            $newdata = [$newdata => ''];
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                unset($_SESSION['userdata'][$key]);
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Add or change flashdata, only available
     * until the next request.
     *
     * @param	mixed
     * @param	string
     *
     * @return void
     */
    public function set_flashdata($newdata = [], $newval = '')
    {
        if (is_string($newdata)) {
            $newdata = [$newdata => $newval];
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $_SESSION['newFlashdata'][$key] = $val;
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Keeps existing flashdata available to next request.
     *
     * @param	string
     *
     * @return void
     */
    public function keep_flashdata($key)
    {
        // 'old' flashdata gets removed.  Here we mark all
        // flashdata as 'new' to preserve it from _flashdata_sweep()
        // Note the function will return FALSE if the $key
        // provided cannot be found

        $_SESSION['newFlashdata'][$key] = $_SESSION['oldFlashdata'][$key];
    }

    // ------------------------------------------------------------------------

    /**
     * Fetch a specific flashdata item from the session array.
     *
     * @param	string
     *
     * @return string
     */
    public function flashdata($key)
    {
        if (isset($_SESSION['oldFlashdata'][$key])) {
            return $_SESSION['oldFlashdata'][$key];
        } else {
            return false;
        }
    }
}
// END Session Class

/* End of file Session.php */
/* Location: ./system/libraries/Session.php */
