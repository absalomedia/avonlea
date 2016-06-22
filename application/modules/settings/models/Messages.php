<?php

class Messages extends CI_Model
{
    public function getList($type = '')
    {
        if ($type != '') {
            CI::db()->where('type', $type);
        }
        $res = CI::db()->get('canned_messages');

        return $res->result_array();
    }

    public function getMessage($optn)
    {
        $res = CI::db()->where('id', $optn)->get('canned_messages');

        return $res->row_array();
    }

    public function saveMessage($data)
    {
        if ($data['id']) {
            CI::db()->where('id', $data['id'])->update('canned_messages', $data);

            return $data['id'];
        } else {
            CI::db()->insert('canned_messages', $data);

            return CI::db()->insert_id();
        }
    }

    public function deleteMessage($optn)
    {
        CI::db()->where('id', $optn)->delete('canned_messages');

        return $optn;
    }
}
