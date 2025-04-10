<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('CategoryModel');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        // Ambil data kategori untuk ditampilkan di view
        $data['categories'] = $this->CategoryModel->get_all();
        
        $this->load->view('backend/Dashboard/nav/header');
        $this->load->view('backend/Dashboard/content/category', $data);
        $this->load->view('backend/Dashboard/nav/footer');
    }

    public function save() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
		
        $response = ['success' => false, 'message' => ''];

		
        try {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('menu_name', 'Nama Menu', 'required|max_length[100]');
            $this->form_validation->set_rules('level', 'Level', 'required|in_list[Level 1,Level 2,Level 3]');
            
            $level = $this->input->post('level');
            if ($level !== 'Level 1') {
                $this->form_validation->set_rules('parent', 'Parent Menu', 'required|numeric');
            }

            if ($this->form_validation->run() === FALSE) {
                $response['message'] = validation_errors('<div class="error">', '</div>');
            } else {
                $level_number = ($level === 'Level 1') ? 1 : ($level === 'Level 2' ? 2 : 3);
                $data = [
                    'name' => $this->input->post('menu_name'),
                    'level' => $level_number,
                    'parent_id' => ($level === 'Level 1') ? null : $this->input->post('parent')
                ];

                $insertId = $this->CategoryModel->insert($data);
                
                if ($insertId) {
                    $response['success'] = true;
                    $response['message'] = 'Kategori berhasil disimpan';
                    $response['data'] = [
                        'id' => $insertId,
                        'name' => $data['name'],
                        'level' => $level,
                        'parent_id' => $data['parent_id']
                    ];
                } else {
                    $response['message'] = 'Gagal menyimpan kategori ke database';
                }
            }
        } catch (Exception $e) {
            $response['message'] = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


    
    public function get_by_level() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $level = $this->input->get('level');
        $level_number = ($level === 'Level 1') ? 1 : ($level === 'Level 2' ? 2 : 3);
        
        $categories = $this->CategoryModel->get_by_level($level_number - 1); 
        
        $response = [];
        foreach ($categories as $category) {
            $response[] = [
                'id' => $category['id'],
                'text' => $category['name']
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

	public function get_categories_exclude($exclude_id) {
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
	
		$this->load->model('CategoryModel');
		$categories = $this->CategoryModel->get_all_exclude($exclude_id);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($categories));
	}

	public function delete($id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $response = ['success' => false, 'message' => ''];
        $contentCount = $this->CategoryModel->count_articles($id);

        if ($contentCount > 0) {
            $response['message'] = 'Kategori masih memiliki konten';
        } else {
            if ($this->CategoryModel->delete($id)) {
                $response['success'] = true;
                $response['message'] = 'Kategori berhasil dihapus';
            } else {
                $response['message'] = 'Gagal menghapus kategori';
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
	
	public function delete_with_move() {
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
	
		$response = ['success' => false, 'message' => ''];
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_id', 'Category ID', 'required|numeric');
		$this->form_validation->set_rules('new_category_id', 'New Category', 'required|numeric');
		
		if ($this->form_validation->run() === FALSE) {
			$response['message'] = validation_errors();
		} else {
			$category_id = $this->input->post('category_id');
			$new_category_id = $this->input->post('new_category_id');
			
			$this->load->model('CategoryModel');
			
			try {
				// Pindahkan artikel terlebih dahulu
				$move_success = $this->CategoryModel->move_articles($category_id, $new_category_id);
				
				if ($move_success) {
					// Hapus kategori setelah artikel dipindahkan
					$delete_success = $this->CategoryModel->delete($category_id);
					
					if ($delete_success) {
						$response['success'] = true;
						$response['message'] = 'Kategori berhasil dihapus dan artikel telah dipindahkan';
					} else {
						$response['message'] = 'Artikel berhasil dipindahkan tetapi gagal menghapus kategori';
					}
				} else {
					$response['message'] = 'Gagal memindahkan artikel ke kategori baru';
				}
			} catch (Exception $e) {
				$response['message'] = 'Terjadi kesalahan: ' . $e->getMessage();
			}
		}
	
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
}
