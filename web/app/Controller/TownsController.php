<?php 
class TownsController extends AppController{

	public function getTown($zipCode){
		
		echo json_encode($this->Town->find('all', array('conditions' => array('zip_code LIKE ' => $zipCode.'%'))));
		$this->autoRender = null;
	}
}


 ?>