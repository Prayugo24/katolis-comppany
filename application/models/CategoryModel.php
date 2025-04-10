<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
    public function insert($data) {
        
        $slug = url_title($data['name'], '-', TRUE);
        
        $unique_slug = $this->generate_unique_slug($slug, $data['parent_id'] ?? null);
        
        $insert_data = [
            'name' => $data['name'],
            'slug' => $unique_slug,
            'parent_id' => $data['parent_id'] ?? null,
            'level' => $data['level'] ?? 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('categories', $insert_data);
        return $this->db->insert_id();
    }
	public function count_articles($category_id) {
        $this->db->where('category_id', $category_id);
        return $this->db->count_all_results('article_category');
    }

    
    private function generate_unique_slug($slug, $parent_id = null) {
        $original_slug = $slug;
        $counter = 1;

        while ($this->slug_exists($slug, $parent_id)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function slug_exists($slug, $parent_id = null) {
        $this->db->where('slug', $slug);
        $this->db->where('parent_id', $parent_id);
        $query = $this->db->get('categories');
        return $query->num_rows() > 0;
    }

    
    public function get_all() {
        $this->db->order_by('level', 'ASC');
        $this->db->order_by('name', 'ASC');
        return $this->db->get('categories')->result_array();
    }

    public function get_by_level($level) {
        $this->db->where('level', $level);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('categories')->result_array();
    }

    
    public function get_by_parent($parent_id) {
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('categories')->result_array();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('categories');
        return $query->row_array();
    }

	public function get_all_exclude($exclude_id) {
		$this->db->where('id !=', $exclude_id);
		$this->db->order_by('level', 'ASC');
		$this->db->order_by('name', 'ASC');
		return $this->db->get('categories')->result_array();
	}

	public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }


	public function move_articles($old_category_id, $new_category_id) {
		// Cek apakah kategori tujuan ada
		$this->db->where('id', $new_category_id);
		$query = $this->db->get('categories');
		if ($query->num_rows() == 0) {
			return false;
		}
	
		// Mulai transaction
		$this->db->trans_start();
		
		// 1. Update artikel yang memiliki kategori lama sebagai primary
		$this->db->where('category_id', $old_category_id);
		$this->db->where('is_primary', 1);
		$this->db->update('article_category', ['category_id' => $new_category_id]);
		
		// 2. Update artikel yang memiliki kategori lama sebagai secondary
		$this->db->where('category_id', $old_category_id);
		$this->db->where('is_primary', 0);
		$this->db->update('article_category', ['category_id' => $new_category_id]);
		
		// 3. Untuk artikel yang sudah memiliki relasi dengan kategori baru, hapus relasi lama
		$subquery = $this->db->select('article_id')
			->from('article_category')
			->where('category_id', $new_category_id)
			->get_compiled_select();
		
		$this->db->where('category_id', $old_category_id);
		$this->db->where("article_id IN ($subquery)", null, false);
		$this->db->delete('article_category');
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
}
