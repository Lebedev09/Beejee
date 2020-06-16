<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    function __construct()
    {
        session_start();
        parent::__construct();
        $this->load->helper('cookie');

    }

    public function index()
    {

        $link_data = array();
        if (!empty($_GET['admin'])) {
            $link_data['admin'] = $_GET['admin'];
        }

        if (!empty($_GET['sort_by'])) {
            $link_data['sort_by'] = $_GET['sort_by'];
        }

        if (!empty($_GET['order'])) {
            $link_data['order'] = $_GET['order'];
        }
        if (!empty($_GET['where'])) {
            $link_data['where'] = $_GET['where'];
        }


        $data['book'] = http_build_query($link_data);

        $this->load->library('pagination');
        $config['base_url'] = base_url() . "index.php/welcome/?{$data['book']}";
        $config['per_page'] = 3;
        $config['num_links'] = 5;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page_num';

        $config['total_rows'] = $this->db->get('users')->num_rows();
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';

        $config['first_link'] = 'First Page';
        $config['first_tag_open'] = '<span class="firstlink">';
        $config['first_tag_close'] = '</span>';

        $config['last_link'] = 'Last Page';
        $config['last_tag_open'] = '<span class="lastlink">';
        $config['last_tag_close'] = '</span>';

        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<span class="nextlink">';
        $config['next_tag_close'] = '</span>';

        $config['prev_link'] = 'Prev Page';
        $config['prev_tag_open'] = '<span class="prevlink">';
        $config['prev_tag_close'] = '</span>';

        $config['cur_tag_open'] = '<span class="curlink">';
        $config['cur_tag_close'] = '</span>';

        $config['num_tag_open'] = '<span class="numlink">';
        $config['num_tag_close'] = '</span>';

        $limit = $config['per_page'];
        if (!empty($_GET['page_num'])) {
            $offset = ($_GET['page_num'] - 1) * $config['per_page'];
        } else {
            $offset = 0;
        }

        $this->pagination->initialize($config);
        $data['query'] = $this->main_model->get_users($_GET, $limit, $offset);


        $this->load->view('table', $data);
    }

    function login()
    {

        $data['error'] = '';
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $uname = $_POST['username'];
            $password = md5($_POST['password']);
        }
        if (isset($_POST['submit'])) {
            if (!empty($uname) && !empty($password)) {
                $row = $this->main_model->select_login_password($uname, $password);
                if (!empty($row)) {
        setcookie("TestCookie", true , 0 , '/');
                    $_SESSION['uname'] = $uname;
                    redirect('/');
                } else {
                    $data['error'] = 'Access Denied';
                }

            }

        }
        $this->load->view('login',$data);
    }


    function home()
    {
        $this->load->view('home');
    }

    function create_new_user()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->load->view('create_new_user');

    }


    function exit_welcome()
    {
        setcookie("TestCookie", false , 0 , '/');
        session_destroy();
        redirect('/');
    }

}