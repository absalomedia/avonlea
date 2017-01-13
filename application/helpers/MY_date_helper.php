<?php

function format_date($date)
{
    if ($date != '' && $date != '0000-00-00') {
        $day = explode('-', $date);

        $mon = [
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
        ];

        return $mon[$day[1] - 1].' '.$day[2].', '.$day[0];
    } else {
        return false;
    }
}

function reverse_format($date)
{
    if (empty($date)) {
        return;
    }

    $day = explode('-', $date);

    return "{$day[1]}-{$day[2]}-{$day[0]}";
}

function format_ymd($date)
{
    if (empty($date) || $date === '00-00-0000') {
        return '';
    } else {
        $day = explode('-', $date);

        return $day[2].'-'.$day[0].'-'.$day[1];
    }
}

function format_mdy($date)
{
    if (empty($date) || $date === '0000-00-00') {
        return '';
    } else {
        return date('m-d-Y', strtotime($date));
    }
}

/* End of file welcome.php */
/* Location: ./system/application/helpers/MY_date_helper.php */
