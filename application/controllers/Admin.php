<?php
class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        $cokie = $_COOKIE['TestCookie'];
        if($cokie == false){
           session_destroy();
           redirect('/');
        }

    }

    function edit_task(){
        $id=$this->uri->segment(3);
        $data['edit']=$this->main_model->get_by_id($id);
        if (!empty($_POST['edit_task'])){
            $this->main_model->update_task_id($_POST['edit_task'],$id);
            redirect('/');
        }
        $this->load->view('edit_task',$data);
    }

    function ajax()
    {
        $id = $_POST['id'];
        $completed = 1;

        if (!empty($id)) {
            $users = $this->main_model->get_by_id($id);
            $user_completed = $users[0]['completed'];
            if ($user_completed == 1) {
                $zero = 0;
                $this->main_model->set_completed($zero, $id);
            } else {
                $this->main_model->set_completed($completed, $id);
            }
        }
    }

    function task()
    {
        $id = $_POST['id'];
        $text = $_POST['text'];
        $edit = "Отредактировано администратором";
        if (!empty($id) && !empty($text)) {
            $this->main_model->edit_task($text, $id);
            $this->main_model->edit($edit, $id);
        }
    }
}