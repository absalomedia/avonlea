<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Installer extends CI_Controller
{
    public function init()
    {
        $this->load->helper(['form', 'file', 'url']);
        $this->load->library(['form_validation']);

        $cartPath = dirname(FCPATH);

        $testConfig = is_writable($cartPath.'/application/config/');
        $testUploads = is_writable($cartPath.'/uploads/');
        $testIntl = class_exists('Locale');

        $errors = (!$testConfig) ? '<div class="alert alert-danger" role="alert">The folder "'.$cartPath.'/application/config" must be writable.</div>' : '';
        $errors .= (!$testUploads) ? '<div class="alert alert-danger" role="alert">The folder "'.$cartPath.'/uploads" must be writable.</div>' : '';
        $errors .= (!$testIntl) ? '<div class="alert alert-danger" role="alert">The PHP_INTL Library is required for AVL and is not installed on your server. <a href="http://php.net/manual/en/book.intl.php">Read More</a></div>' : '';

        $this->form_validation->set_rules('hostname', 'Hostname', 'required');
        $this->form_validation->set_rules('database', 'Database Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('prefix', 'Database Prefix', 'trim');
        $this->form_validation->set_rules('admin-password', 'Admin Password', 'trim|required');

        if ($this->form_validation->run() === false || $errors != '') {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $errors .= validation_errors();

            $this->load->view('index', ['errors' => $errors]);
        } else {
            $dbCred = $this->input->post();
            //test the database
            mysqli_report(MYSQLI_REPORT_STRICT);

            try {
                $db = new mysqli($dbCred['hostname'], $dbCred['username'], $dbCred['password'], $dbCred['database']);
            } catch (Exception $e) {
                $errors = '<div class="alert alert-danger" role="alert">There was an error connecting to the database</div>';
                $this->load->view('index', ['errors' => $errors]);

                return;
            }

            //create the database file
            $database = $this->load->view('database', $this->input->post(), true);

            $myfile = fopen($cartPath.'/application/config/database.php', 'w');
            fwrite($myfile, $database);
            fclose($myfile);

            $sql = str_replace('avl_', $dbCred['prefix'], file_get_contents(FCPATH.'database.sql'));

            $db->multi_query($sql); // run the dump
            while ($db->more_results() && $db->next_result()) {
            } //run through it

            $adminpass = password_hash($dbCred['admin-password'], PASSWORD_DEFAULT);

            $query = "INSERT INTO `{$dbCred['prefix']}admin` (`id`, `firstname`, `lastname`, `username`, `email`, `access`, `password`) VALUES ('1', '', '', 'admin', '', 'Admin', '".$adminpass."');";

            $db->query($query);


            //set some basic information in settings
            $query = "INSERT INTO `{$dbCred['prefix']}settings` (`code`, `setting_key`, `setting`) VALUES
            ('avl', 'theme', 'default'),
            ('avl', 'locale', 'en_AU'),
            ('avl', 'currency_iso', 'AUD'),
            ('avl', 'new_customer_status', '1'),
            ('avl', 'order_statuses', '{\"Order Placed\":\"Order Placed\",\"Pending\":\"Pending\",\"Processing\":\"Processing\",\"Shipped\":\"Shipped\",\"On Hold\":\"On Hold\",\"Cancelled\":\"Cancelled\",\"Delivered\":\"Delivered\"}'),
            ('avl', 'products_per_page', '24'),
            ('avl', 'default_meta_description', 'AVL ecommerce invoice thing.'),
            ('avl', 'default_meta_keywords', 'open source, ecommerce'),
            ('avl', 'timezone', 'Australia/Brisbane');";

            $db->query($query);

            $db->close();

            $url = dirname((isset($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'/admin';

            header('Location: '.dirname($url).'/admin');
        }
    }
}
