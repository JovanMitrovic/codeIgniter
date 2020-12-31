<?php

class User_model extends CI_Model
{
	//////////////////////////////////////////////////////////////////////////////////////////////

	function login($email, $password)
	{
		$this->db->where('email', $email);

		$arrUserData = $this->db->get('users')->row_array();

		if (is_array($arrUserData) && (count($arrUserData) > 0))
		{
			return $arrUserData;
		}
		else
		{
			return false;
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

}
?>
