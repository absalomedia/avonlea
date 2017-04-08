<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once './application/libraries/REST_Controller.php';

/**
 * Projects API controller.
 *
 * Validation is missign
 */
class Projects extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('project_model');
    }

    public function index_get()
    {
        $this->response($this->project_model->get_all());
    }

    public function edit_get($id = null)
    {
        if (!$id) {
            $this->response(['status' => false, 'error_message' => 'No ID was provided.'], 400);
        }

        $this->response($this->project_model->get($id));
    }

    public function save_post($id = null)
    {
        if (!$id) {
            $new_id = $this->project_model->add($this->post());
            $this->response(['status' => true, 'id' => $new_id, 'message' => sprintf('Project #%d has been created.', $new_id)], 200);
        } else {
            $this->project_model->update($id, $this->post());
            $this->response(['status' => true, 'message' => sprintf('Project #%d has been updated.', $id)], 200);
        }
    }

    public function remove_delete($id = null)
    {
        if ($this->project_model->delete($id)) {
            $this->response(['status' => true, 'message' => sprintf('Project #%d has been deleted.', $id)], 200);
        } else {
            $this->response(['status' => false, 'error_message' => 'This project does not exist!'], 404);
        }
    }
}

/* End of file Projects.php */
/* Location: ./application/controllers/api/Projects.php */
