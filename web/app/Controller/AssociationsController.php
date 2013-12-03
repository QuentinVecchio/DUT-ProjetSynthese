<?php 
class AssociationsController extends AppController{

	public function admin_add(){

	}

	public function admin_edit($id){
		$this->data = $this->Association->findById($id);
	}

}
 ?>