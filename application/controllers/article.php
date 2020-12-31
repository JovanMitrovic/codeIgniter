<?php

class Article extends CI_Controller
{
	public $isUserLogged = false;

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('email') !== NULL)
		{
			$this->isUserLogged = true;
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function view($intArticleID)
	{
		$this->load->model('article_model');
		$this->load->model('image_model');

		$arrData['article'] = $this->article_model->getArticle($intArticleID);
		$arrData['articleImages'] = $this->image_model->getImages($intArticleID);

		$this->load->view('view_article', $arrData);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function index()
	{
		$arrData['isUserLogged'] = $this->isUserLogged;

		$this->load->view('list_article', $arrData);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function indexAjax()
	{
		$this->load->model('article_model');

		$arrData['isUserLogged'] = $this->isUserLogged;
		
		// PAGINATION
		$intLimit = 5;
		$strOffset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$arrData['articles'] = $this->article_model->getAllArticles($intLimit, $strOffset, $intCount = false);

		$this->load->library('pagination');

		$config['base_url'] = site_url('/article/indexajax');
		$config['total_rows'] = $this->article_model->getAllArticles($intLimit, $strOffset, $intCount = true);
		$config['per_page'] = $intLimit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$arrData['pagelinks'] = $this->pagination->create_links();

		$this->load->view('list_ajax_article', $arrData);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function add()
	{
		$this->load->view('add_article');
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function addFinish()
	{
		$this->form_validation->set_message('required', 'Ovo polje je obavezno');

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');


		if ($this->form_validation->run() == false)
		{
			$this->load->view('add_article');
		}
		else
		{
			//INSERT ARTICLE
			$this->load->model('article_model');

			$arrForm['title'] = $this->input->post('title');
			$arrForm['description'] = $this->input->post('description');
			$arrForm['created_at'] = date('Y-m-d');

			$intArticleID = $this->article_model->insertArticle($arrForm);

			$this->addImages($intArticleID);

			redirect(base_url() . 'index.php/article/index');
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function edit($intArticleID)
	{
		$this->load->model('article_model');
		$this->load->model('image_model');

		$arrData['article'] = $this->article_model->getArticle($intArticleID);
		$arrData['articleImages'] = $this->image_model->getImages($intArticleID);

		$this->load->view('edit_article', $arrData);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function editFinish($intArticleID)
	{
		$this->load->model('article_model');
		$arrData['article'] = $this->article_model->getArticle($intArticleID);

		$this->form_validation->set_message('required', 'Ovo polje je obavezno');

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == false)
		{
			$this->load->view('edit_article', $arrData);
		}
		else
		{
			// UPDATE ARTICLE RECORD
			$arrArticleForm['title'] = $this->input->post('title');
			$arrArticleForm['description'] = $this->input->post('description');

			$this->article_model->updateArticle($intArticleID, $arrArticleForm);

			$this->addImages($intArticleID);

			redirect(base_url() . 'index.php/article/index');
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function delete($intArticleID)
	{
		$this->load->model('article_model');
		$this->load->model('image_model');

		$arrArticle = $this->article_model->getArticle($intArticleID);

		if (!isset($arrArticle))
		{
			redirect(base_url() . 'index.php/article/index');
		}

		$this->article_model->deleteArticle($intArticleID);

		$this->image_model->deleteImageByArticleID($intArticleID);

		redirect(base_url() . 'index.php/article/index');
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function addImages($intArticleID)
	{
		if (isset($_FILES['file_upload']['name']))
		{
			$intNumbersOfFiles = sizeof($_FILES['file_upload']['tmp_name']);
			$arrFiles = $_FILES['file_upload'];

			for ($i = 0; $i < $intNumbersOfFiles; $i++)
			{
				if ($_FILES['file_upload']['error'][$i] != 0)
				{
					$this->form_validation->set_message('file_upload', 'Couldn\'t upload the files');

					return false;
				}
			}

			$config['upload_path'] = FCPATH . 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|bmp|png|gif';
			$config['encrypt_name'] = true;

			for ($i = 0; $i < $intNumbersOfFiles; $i++)
			{
				$_FILES['file_upload']['name'] = $arrFiles['name'][$i];
				$_FILES['file_upload']['type'] = $arrFiles['type'][$i];
				$_FILES['file_upload']['tmp_name'] = $arrFiles['tmp_name'][$i];
				$_FILES['file_upload']['error'] = $arrFiles['error'][$i];
				$_FILES['file_upload']['size'] = $arrFiles['size'][$i];

				$this->upload->initialize($config);

				if ($this->upload->do_upload('file_upload'))
				{
					$arrData = $this->upload->data();

					// INSERT TO DATABASE
					$arrImages[$i]['name'] = $arrData['file_name'];
					$arrImages[$i]['size'] = $arrData['file_size'];
					$arrImages[$i]['article_id'] = $intArticleID;
				}
			}

			if (is_array($arrImages) && (count($arrImages) > 0))
			{
				$this->load->model('image_model');
				$this->image_model->insertImages($arrImages);
			}
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////
}
?>
