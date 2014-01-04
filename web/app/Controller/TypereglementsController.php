<?php 
class TypereglementsController extends AppController{

	public function admin_index(){

		$listType = $this->Typereglement->find('all', array('recursive' => 2));
		$this->set('listType', $listType);
	}
}
 ?>