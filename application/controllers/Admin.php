<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        checkSessionLog();
    }

    public function index()
    {
        $info['title']  = 'Dashboard';
        $info['user']   = $this->Auth_model->getUserSession();

        $this->load->view('templates/header', $info);
        $this->load->view('templates/sidebar', $info);
        $this->load->view('templates/topbar', $info);
        $this->load->view('admins/index', $info);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $info['title']  = "Role";
        $info['user']   = $this->Auth_model->getUserSession();

        $config['base_url']     = base_url() . 'admin/role';
        $config['total_rows']     = $this->db->count_all('user_role');
        $config['per_page']     = 5;
        $config['uri_segment']     = 3;

        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links']     = floor($choice);

        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';

        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close']  = '</span></li>';

        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']   = '</span></li>';

        $config['next_link']        = '&gt;';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';

        $config['prev_link']        = '&lt;';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']   = '</span></li>';

        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';

        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';

        $this->pagination->initialize($config);

        $info['page']     = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $info['role'] = $this->Admin_model->getAllRole($config['per_page'], $info['page']);

        $info['pagination'] = $this->pagination->create_links();

        if ($this->input->post('search', true)) {
            $info['role']    = $this->Admin_model->getSearchRole($config['per_page'], $info['page']);
        }

        $this->load->view('templates/header', $info);
        $this->load->view('templates/sidebar', $info);
        $this->load->view('templates/topbar', $info);
        $this->load->view('admins/role', $info);
        $this->load->view('templates/footer');
    }

    public function addRole()
    {
        $info['title']     = 'Add New Role';
        $info['user']      = $this->Auth_model->getUserSession();

        $this->form_validation->set_rules('name', 'role name', 'trim|required|min_length[3]');

        $file = [
            'role' => $this->security->xss_clean(html_escape($this->input->post('name', true)))
        ];

        $role_name  = $this->security->xss_clean(html_escape($this->input->post('name', true)));
        $check         = $this->Admin_model->getCheckRoleName($role_name);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $info);
            $this->load->view('templates/sidebar', $info);
            $this->load->view('templates/topbar', $info);
            $this->load->view('admins/add_role', $info);
            $this->load->view('templates/footer');
        } else {
            if ($check == TRUE) {
                $this->session->set_flashdata('error', 'Insert failed, you cannot add the same role name !');
                redirect('admin/addrole', 'refresh');
            } else {
                $this->Admin_model->insertRole($file);
                $this->session->set_flashdata('success', 'Added !');
                redirect('admin/role', 'refresh');
            }
        }
    }

    public function editrole($id)
    {
        $info['title']     = 'Edit Role';
        $info['user']      = $this->Auth_model->getUserSession();
        $info['detail']    = $this->Admin_model->getAccessById($id);

        $this->form_validation->set_rules('name', 'role name', 'trim|required|min_length[3]');

        $role_name    = $this->security->xss_clean(html_escape($this->input->post('name', true)));

        $data = [
            'role' => $this->security->xss_clean(html_escape($this->input->post('name', true)))
        ];

        $check         = $this->Admin_model->getCheckRoleName($role_name);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $info);
            $this->load->view('templates/sidebar', $info);
            $this->load->view('templates/topbar', $info);
            $this->load->view('admins/edit_role', $info);
            $this->load->view('templates/footer');
        } else {
            if ($check == TRUE) {
                $this->session->set_flashdata('error', 'Update failed, you cannot change the same role name !');
                redirect('admin/role', 'refresh');
            } else {
                $get_id = $this->input->post('id', true);

                $this->Admin_model->updateRole($get_id, $data);
                $this->session->set_flashdata('success', 'Updated !');
                redirect('admin/role', 'refresh');
            }
        }
    }

    public function deleteRole($id)
    {
        $this->Admin_model->modelDeleteRole($id);
        $this->session->set_flashdata('success', 'Deleted !');
        redirect('admin/role', 'refresh');
    }

    public function accessRole($id)
    {
        $info['title']     = 'Access Role';
        $info['user']      = $this->Auth_model->getUserSession();
        $info['role']    = $this->Admin_model->getAccessById($id);
        $info['menu']     = $this->Admin_model->getAllMenu();

        $this->form_validation->set_rules('name', 'role name', 'trim|required|min_length[3]');

        $file = [
            'role' => $this->security->xss_clean(html_escape($this->input->post('name', true)))
        ];

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $info);
            $this->load->view('templates/sidebar', $info);
            $this->load->view('templates/topbar', $info);
            $this->load->view('admins/access_role', $info);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->insertRole($file);
            $this->session->set_flashdata('success', 'Added !');
            redirect('admin/role', 'refresh');
        }
    }

    public function accessUpdate()
    {
        $menu_id  = $this->security->xss_clean(html_escape($this->input->post('menuId', true)));
        $role_id  = $this->security->xss_clean(html_escape($this->input->post('roleId', true)));
        $file = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $this->Admin_model->updateAccessRole($file);
        $this->session->set_flashdata('success', 'Updated !');
    }
}
