<?php

namespace Avonlea\Controller;

/**
 * AdminUsers Class.
 *
 * @category    AdminUsers
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class AdminUsers extends Admin
{
    //these are used when editing, adding or deleting an admin
    public $admin_id = false;
    public $current_admin = false;

    public function __construct()
    {
        parent::__construct();
        \CI::auth()->checkAccess('Admin', true);

        //load the admin language file in
        \CI::lang()->load('users');

        $this->current_admin = \CI::session()->userdata('admin');
    }

    public function index()
    {
        $data['page_title'] = lang('admins');
        $data['admins'] = \CI::auth()->getAdminList();

        $this->view('users', $data);
    }

    public function delete($optn)
    {
        //even though the link isn't displayed for an admin to delete themselves, if they try, this should stop them.
        if ($this->current_admin['id'] === $optn) {
            \CI::session()->set_flashdata('message', lang('error_self_delete'));
            redirect('admin/users');
        }

        //delete the user
        \CI::auth()->delete($optn);
        \CI::session()->set_flashdata('message', lang('message_user_deleted'));
        redirect('admin/users');
    }

    public function form($optn = false)
    {
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');
        \CI::form_validation()->set_error_delimiters('<div class="error">', '</div>');

        $data['page_title'] = lang('admin_form');

        //default values are empty if the customer is new
        $data['id'] = '';
        $data['firstname'] = '';
        $data['lastname'] = '';
        $data['email'] = '';
        $data['username'] = '';
        $data['access'] = '';

        if ($optn) {
            $this->admin_id = $optn;
            $admin = \CI::auth()->getAdmin($optn);
            //if the administrator does not exist, redirect them to the admin list with an error
            if (!$admin) {
                \CI::session()->set_flashdata('message', lang('admin_not_found'));
                redirect('admin/users');
            }
            //set values to db values
            $data['id'] = $admin->id;
            $data['firstname'] = $admin->firstname;
            $data['lastname'] = $admin->lastname;
            $data['email'] = $admin->email;
            $data['username'] = $admin->username;
            $data['access'] = $admin->access;
        }

        \CI::form_validation()->set_rules('firstname', 'lang:firstname', 'trim|max_length[32]');
        \CI::form_validation()->set_rules('lastname', 'lang:lastname', 'trim|max_length[32]');
        \CI::form_validation()->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
        \CI::form_validation()->set_rules('username', 'lang:username', ['trim', 'required', 'max_length[128]', ['username_callable', function ($str) {
            $email = \CI::auth()->checkUsername($str, $this->admin_id);
            if ($email) {
                \CI::form_validation()->set_message('username_callable', lang('error_username_taken'));

                return false;
            } else {
                return true;
            }
        }]]);
        \CI::form_validation()->set_rules('access', 'lang:access', 'trim|required');

        //if this is a new account require a password, or if they have entered either a password or a password confirmation
        if (\CI::input()->post('password') != '' || \CI::input()->post('confirm') != '' || !$optn) {
            \CI::form_validation()->set_rules('password', 'lang:password', 'required|min_length[6]');
            \CI::form_validation()->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
        }

        if (\CI::form_validation()->run() === false) {
            $this->view('user_form', $data);
        } else {
            $save['id'] = $optn;
            $save['firstname'] = \CI::input()->post('firstname');
            $save['lastname'] = \CI::input()->post('lastname');
            $save['email'] = \CI::input()->post('email');
            $save['username'] = \CI::input()->post('username');
            $save['access'] = \CI::input()->post('access');

            if (\CI::input()->post('password') != '' || !$optn) {
                $save['password'] = \CI::input()->post('password');
            }

            \CI::auth()->save($save);
            \CI::session()->set_flashdata('message', lang('message_user_saved'));

            //go back to the customer list
            redirect('admin/users');
        }
    }
}
