<?php 
class TypereglementsController extends AppController{

	public function admin_index(){

		$listType = $this->Typereglement->find('all');
		$this->set('listType', $listType);
	}
}
 ?>