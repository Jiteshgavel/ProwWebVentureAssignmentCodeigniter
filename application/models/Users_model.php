<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database library
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function get_user_by_twitter_id($twitter_id)
    {
        $query = $this->db->get_where('users', array('twitter_id' => $twitter_id));
        return $query->row_array();
    }

    // Add other methods as needed

}
