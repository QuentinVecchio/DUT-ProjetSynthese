<?php 
class TownsController extends AppController{

	public function admin_getTown($zipCode){
		
		echo json_encode($this->Town->find('all', array('conditions' => array('zip_code' => $zipCode))));
		//echo json_encode(array('test', 'toto', 'tata'));
		$this->autoRender = null;
	}
}


 ?>