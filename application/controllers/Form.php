<?php
class Form extends CI_Controller
{

    public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');




        $this->form_validation->set_rules('username', 'username', 'required|min_length[3]');
        $this->form_validation->set_rules('status', 'status', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('task', 'task', 'required|min_length[4]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('create_new_user');
        } else {
           if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['task']) && !empty($_POST['status'])){
               $username = $this->security->xss_clean($_POST['username']);
               $email = $this->security->xss_clean($_POST['email']);
               $task = $this->security->xss_clean($_POST['task']);
               $status = $this->security->xss_clean($_POST['status']);
               $this->main_model->insert_users($username,$email,$task,$status);
           }
            redirect('/');
        }
    }
}
