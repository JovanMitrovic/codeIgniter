<?php

	class Article_model extends CI_Model
	{
		//////////////////////////////////////////////////////////////////////////////////////////////

		function insertArticle($arrNewArticle)
		{
			$this->db->insert('articles', $arrNewArticle); // INSERT INTO articles (title, description) values (? , ?)

			return $this->db->insert_id();
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		function getAllArticles($limit, $offset, $count)
		{
			$this->db->select('*');
			$this->db->from('articles');

			if ($count)
			{
				return $this->db->count_all_results();
			}
			else
			{
				$this->db->limit($limit, $offset);
				$query = $this->db->get();

				if($query->num_rows() > 0)
				{
					return $query->result();
				}
			}

			return array();
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		function getArticle($intArticleID)
		{
			$this->db->where('id', $intArticleID);

			return $this->db->get('articles')->row_array();;
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		function updateArticle($intArticleID, $arrArticleForm)
		{
			$this->db->where('id', $intArticleID);
			$this->db->update('articles', $arrArticleForm); // Update articles SET  title = ? ,descrption = ? WHERE articleID = ?
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		function deleteArticle($intArticleID)
		{
			$this->db->where('id', $intArticleID);
			$this->db->delete('articles'); // DELETE FROM articles WHERE id = ?
		}

		//////////////////////////////////////////////////////////////////////////////////////////////
	}
?>
