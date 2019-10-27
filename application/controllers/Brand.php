<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    checkSessionLog();
  }

  public function index()
  {
    $info['title'] = "Product Brand";
    $info['user'] = $this->Auth_model->getUserSession();

    // SEARCHING
    if ($this->input->post('search', true)) {
      $info['keyword'] = $this->input->post('search', true);
      $this->session->set_userdata('keyword', $info['keyword']);
    } else {
      $info['keyword'] = $this->session->set_userdata('keyword');
    }

    // DB PAGINATION FOR SEARCHING
    $this->db->like('brand_id', $info['keyword']);
    $this->db->or_like('brand_name', $info['keyword']);
    $this->db->from('product_brands');

    // PAGINATION
    $config['base_url']     = base_url() . 'brand/index';
    $config['total_rows']   = $this->db->count_all_results();
    $config['per_page']     = 10;
    $config['num_links']    = 5;

    // STYLING
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
    $config['full_tag_close']   = '</ul></nav></div>';

    $config['first_link']       = 'First';
    $config['first_tag_open']   = '<li class="page-item">';
    $config['first_tag_close']  = '</li>';

    $config['last_link']        = 'Last';
    $config['last_tag_open']    = '<li class="page-item">';
    $config['last_tag_close']   = '</li>';

    $config['next_link']        = '&raquo';
    $config['next_tag_open']    = '<li class="page-item">';
    $config['next_tag_close']   = '</li>';

    $config['prev_link']        = '&laquo';
    $config['prev_tag_open']    = '<li class="page-item">';
    $config['prev_tag_close']   = '</li>';

    $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close']    = '</a></li>';

    $config['num_tag_open']     = '<li class="page-item">';
    $config['num_tag_close']    = '</li>';
    $config['attributes']       = array('class' => 'page-link');

    // GENERATE PAGE
    $this->pagination->initialize($config);

    $info['start']   = $this->uri->segment(3);
    $info['brand']    = $this->Brand_model->getAllBrand($config['per_page'], $info['start'], $info['keyword']);

    $info['pagination'] = $this->pagination->create_links();

    // PASSING DATA
    $this->load->view('templates/header', $info);
    $this->load->view('templates/sidebar', $info);
    $this->load->view('templates/topbar', $info);
    $this->load->view('brands/index', $info);
    $this->load->view('templates/footer');
  }

  public function addBrand()
  {
    $info['title'] = "Add Brand";
    $info['user'] = $this->Auth_model->getUserSession();

    // CUSTOM GENERATE ID Brand
    $id = "BRD" . "-";
    $customid = $id . date('His') . date("m") . date('y');

    $this->form_validation->set_rules('name', 'brand name', 'trim|required|min_length[5]|is_unique[product_brands.brand_name]', [
      'is_unique' => 'brand has been registered, please use another brand.'
    ]);

    $file = [
      'brand_id' => $customid,
      'brand_name' => $this->security->xss_clean(html_escape($this->input->post('name', true)))
    ];

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $info);
      $this->load->view('templates/sidebar', $info);
      $this->load->view('templates/topbar', $info);
      $this->load->view('brands/add-brand', $info);
      $this->load->view('templates/footer');
    } else {
      $this->Brand_model->insert($file);
      $this->session->set_flashdata('success', 'Your data has been added !');
      redirect('brand', 'refresh');
    }
  }

  public function editBrand($id)
  {
    $info['title']     = 'Edit Brand';
    $info['user']      = $this->Auth_model->getUserSession();
    $info['id']        = $this->Brand_model->getBrandById($id);

    $this->form_validation->set_rules('name', 'customer name', 'trim|required|min_length[5]|is_unique[product_brands.brand_name]', [
      'is_unique' => 'brand has been registered, please use another brand.'
    ]);

    $file = [
      'brand_name' => $this->security->xss_clean(html_escape($this->input->post('name', true)))
    ];

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $info);
      $this->load->view('templates/sidebar', $info);
      $this->load->view('templates/topbar', $info);
      $this->load->view('brands/edit-brand', $info);
      $this->load->view('templates/footer');
    } else {
      $this->Brand_model->update($file);
      $this->session->set_flashdata('success', 'Data brand has been updated !');
      redirect('brand', 'refresh');
    }
  }

  public function deleteBrand($id)
  {
    $this->Brand_model->delete($id);
    $this->session->set_flashdata('success', 'Data brand has been deleted !');
    redirect('brand', 'refresh');
  }
}
  
  /* End of file Brand.php */
