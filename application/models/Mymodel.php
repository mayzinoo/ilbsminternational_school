<?php
class Mymodel extends CI_Model
{
    public function getData($tablename)
	{
		$result= $this->db->get($tablename);
		return $result;
	}
	function getstudentname()
	{
	$query = $this->db->query('SELECT * FROM students');

        return $query->result();
	}
}
?>