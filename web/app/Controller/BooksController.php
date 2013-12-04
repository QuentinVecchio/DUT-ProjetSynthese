<?php 
class BooksController extends AppController{

	public function admin_index(){
		$listLivre = $this->Book->find('all');
		$this->set('listLivre', $listLivre);
	}


	public function admin_add(){
		
	}
} ?>