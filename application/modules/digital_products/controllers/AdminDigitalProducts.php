<?php

namespace Avonlea\Controller;

/**
 * AdminDigitalProducts Class.
 *
 * @category    AdminDigitalProducts
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class AdminDigitalProducts extends Admin
{
    public function __construct()
    {
        parent::__construct();
        \CI::lang()->load('digital_products');
        \CI::load()->model('DigitalProducts');
    }

    public function index()
    {
        $data['page_title'] = lang('dgtl_pr_header');
        $data['file_list'] = \CI::DigitalProducts()->getList();

        $this->view('digital_products', $data);
    }

    public function form($optn = 0)
    {
        \CI::load()->helper('form_helper');
        \CI::load()->library('form_validation');
        \CI::form_validation()->set_error_delimiters('<div class="error">', '</div>');

        $data = [
                    'id'            => '',
                    'filename'      => '',
                    'max_downloads' => '',
                    'title'         => '',
                    'size'          => '',
                  ];
        if ($optn) {
            $data = array_merge($data, (array) \CI::DigitalProducts()->getFileInfo($optn));
        }

        $data['page_title'] = lang('digital_products_form');

        \CI::form_validation()->set_rules('max_downloads', 'lang:max_downloads', 'numeric');
        \CI::form_validation()->set_rules('title', 'lang:title', 'trim|required');

        if (\CI::form_validation()->run() === false) {
            $this->view('digital_product_form', $data);
        } else {
            if ($optn == 0) {
                $data['file_name'] = false;
                $data['error'] = false;

                $config['allowed_types'] = '*';
                $config['upload_path'] = 'uploads/digital_products'; //config_item('digital_products_path');
                $config['remove_spaces'] = true;

                \CI::load()->library('upload', $config);

                if (\CI::upload()->do_upload()) {
                    $upload_data = \CI::upload()->data();
                } else {
                    $data['error'] = \CI::upload()->display_errors();
                    $this->view('digital_product_form', $data);

                    return;
                }

                $save['filename'] = $upload_data['file_name'];
                $save['size'] = $upload_data['file_size'];
            } else {
                $save['id'] = $optn;
            }

            $save['max_downloads'] = \CI::input()->post('max_downloads');
            $save['title'] = \CI::input()->post('title');

            \CI::DigitalProducts()->save($save);

            redirect('admin/digital_products');
        }
    }

    public function delete($optn)
    {
        \CI::DigitalProducts()->delete($optn);

        \CI::session()->set_flashdata('message', lang('message_deleted_file'));
        redirect('admin/digital_products');
    }
}
