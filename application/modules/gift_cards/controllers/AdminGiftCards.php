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
class AdminGiftCards extends Admin
{
    public function __construct()
    {
        parent::__construct();

        \CI::load()->model('GiftCards');
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');
        \CI::lang()->load('gift_cards');
    }

    public function index()
    {
        $data['page_title'] = lang('gift_cards');
        $data['cards'] = \CI::GiftCards()->getAllNew();

        $gc_settings = \CI::Settings()->getSettings('gift_cards');
        if (isset($gc_settings['enabled'])) {
            $data['gift_cards']['enabled'] = $gc_settings['enabled'];
        } else {
            $data['gift_cards']['enabled'] = false;
        }

        $this->view('gift_cards', $data);
    }

    public function form()
    {
        \CI::form_validation()->set_rules('to_email', 'lang:recipient_email', 'trim|required');
        \CI::form_validation()->set_rules('to_name', 'lang:recipient_name', 'trim|required');
        \CI::form_validation()->set_rules('from', 'lang:sender_name', 'trim|required');
        \CI::form_validation()->set_rules('personal_message', 'lang:personal_message', 'trim');
        \CI::form_validation()->set_rules('beginning_amount', 'lang:amount', 'trim|required|numeric');

        $data['page_title'] = lang('add_gift_card');

        if (\CI::form_validation()->run() === false) {
            $this->view('gift_card_form', $data);
        } else {
            $save['code'] = generate_code(); // from the string helper
            $save['to_email'] = \CI::input()->post('to_email');
            $save['to_name'] = \CI::input()->post('to_name');
            $save['from'] = \CI::input()->post('from');
            $save['personal_message'] = \CI::input()->post('personal_message');
            $save['beginning_amount'] = \CI::input()->post('beginning_amount');

            \CI::GiftCards()->saveCard($save);

            if (\CI::input()->post('sendNotification')) {
                \Avonlea\Emails::giftCardNotification($save);
            }

            \CI::session()->set_flashdata('message', lang('message_saved_gift_card'));

            redirect('admin/gift-cards');
        }
    }

    public function delete($optn)
    {
        \CI::GiftCards()->delete($optn);

        \CI::session()->set_flashdata('message', lang('message_deleted_gift_card'));
        redirect('admin/gift-cards');
    }
}
