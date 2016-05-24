<?php namespace Avonlea\Controller;

/**
 * AdminWysiwyg Class
 *
 * @package     Avonlea
 * @subpackage  Controllers
 * @category    AdminWysiwyg
 * @author      Clear Sky Designs
 * @link        http://Avonleadv.com
 */

class AdminWysiwyg extends Admin
{

    public function upload_image()
    {
        $config['upload_path'] = 'uploads/wysiwyg/images';
        $config['allowed_types'] = 'gif|jpg|png';

        \CI::load()->library('upload', $config);

        if (! \CI::upload()->do_upload('file')) {
            $error = array('error' => \CI::upload()->display_errors('', ''));
            echo stripslashes(json_encode($error));
        } else {
            $data = \CI::upload()->data();

            //upload successful generate a thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/wysiwyg/images/'.$data['file_name'];
            $config['new_image'] = 'uploads/wysiwyg/thumbnails/'.$data['file_name'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = true;
            $config['width']     = 75;
            $config['height']   = 50;

            \CI::load()->library('image_lib', $config);

            \CI::image_lib()->resize();

            
            $data = array('filelink' => base_url('uploads/wysiwyg/images/'.$data['file_name']), 'filename'=>$data['file_name']);
            echo stripslashes(json_encode($data));
        }
    }

    public function get_images()
    {
        $files = get_filenames('uploads/wysiwyg/thumbnails');

        $return = [];
        foreach ($files as $file) {
            $return[] = array('thumb'=>base_url('uploads/wysiwyg/thumbnails/'.$file), 'image'=>base_url('uploads/wysiwyg/images/'.$file));
        }
        echo stripslashes(json_encode($return));
    }
}
