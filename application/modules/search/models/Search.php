<?php
/**
 * Search Class
 *
 * @package     Avonlea
 * @subpackage  Models
 * @category    Search
 * @author      Clear Sky Designs
 * @link        http://Avonleadv.com
 */

class Search extends CI_Model
{

    public function recordTerm($term)
    {
        $code   = md5($term);
        CI::db()->where('code', $code);
        $exists = CI::db()->count_all_results('search');
        if ($exists < 1) {
            CI::db()->insert('search', array('code'=>$code, 'term'=>$term));
        }
        return $code;
    }
    
    public function getTerm($code)
    {
        CI::db()->select('term');
        $result = CI::db()->get_where('search', array('code'=>$code));
        $result = $result->row();
        return $result->term;
    }
}
