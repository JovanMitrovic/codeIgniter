<?php

class Image_model extends CI_Model
{
	//////////////////////////////////////////////////////////////////////////////////////////////

	function insertImages($arrData)
	{
		$this->db->insert_batch('images', $arrData);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	function getImages($intArticleID)
	{
		$this->db->where('article_id', $intArticleID);

		return $this->db->get('images')->result_array();
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	function getImage($intImageID)
	{
		$this->db->where('id', $intImageID);

		return $this->db->get('images')->row_array();
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	function deleteImage($intImageID)
	{
		$this->db->select('name');
		$strImageName = $this->getImage($intImageID);

		$this->db->where('id', $intImageID);
		$this->db->delete('images');

		$path = './uploads/';

		@unlink($path . $strImageName['name']);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	function deleteImageByArticleID($intArticleID)
	{
		$arrImages = $this->getImages($intArticleID);

		$this->db->where('article_id ', $intArticleID);
		$this->db->delete('images');

		if (is_array($arrImages) && (count($arrImages) > 0))
		{
			$path = './uploads/';
			foreach ($arrImages as $arrImage)
			{
				@unlink($path . $arrImage['name']);
			}

		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////
}
?>
