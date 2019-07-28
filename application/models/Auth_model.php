<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function checkUser($data)
	{
		return $this->db->get_where('users', ['email' => $data])->row_array();
	}

	public function getUserSession()
	{
		return $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
	}

	public function insertToRegister($data)
	{
		$this->db->insert('users', $data);
	}

	public function insertToken($data)
	{
		$this->db->insert('user_token', $data);
	}

	public function deleteUserToken($data)
	{
		$this->db->where('email', $data);
		$this->db->delete('user_token');
	}

	public function deleteUser($data)
	{
		$this->db->where('email', $data);
		$this->db->delete('users');
	}

	public function updateUser($data)
	{
		$this->db->set('is_active', 1);
		$this->db->where('email', $data);
		$this->db->update('users');
	}

	public function userLogin($data)
	{
		return $this->db->get_where('users', ['email' => $data])->row_array();
	}

	public function checkUserEmail($data)
	{
		return $this->db->get_where('users', $data)->row_array();
	}

	public function insertChangePass($data)
	{
		$this->db->insert('user_token', $data);
	}

	public function updateUserPass($data, $value)
	{
		$this->db->set('password', $data);
		$this->db->where('email', $value);
		$this->db->update('users');
	}
}
