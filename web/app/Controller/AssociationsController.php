<?php 
class AssociationsController extends AppController{

	/**
	*	Liste les associations
	*/
	public function admin_index(){
		$listAssoc = $this->Association->find('all');
		$this->set('listAssoc', $listAssoc);
	}


	/**
	*	Formulaire d'ajout d'une association
	*/
	public function admin_add(){
		if(!empty($this->data)){
			$this->request->data = array('Association' =>$this->data);
			if($this->Association->save($this->data)){
				$this->Session->setFlash('<strong>Félicitation:</strong> Vous venez d\'ajouter une association !','message', array('type' => 'success'));
				$this->redirect(array('action' => 'index'));
			}
			if(isset($this->data['Association']['town_id'])){
				$this->request->data['Town'] = current($this->Association->Town->findById($this->data['Association']['town_id']));
			}

		}
	}


	/**
	*	Formulaire d'édition d'une association
	*/
	public function admin_edit($id){
			if(!empty($this->data)){
				$this->request->data = array('Association' =>$this->data);
				$this->Association->id = $id;
				if($this->Association->save($this->data)){
					$this->Session->setFlash('<strong>Félicitation:</strong> Vous venez de mettre à jour une association !','message', array('type' => 'success'));
					$this->redirect(array('action' => 'index'));
				}
			}else{
					$this->data = $this->Association->findById($id);
			}
	}


	/**
	*	Permet la suppression d'une association
	*/
	public function admin_delete($id){
		if($this->Association->delete($id)){
				$this->Session->setFlash('Vous venez de supprimer une association !','message', array('type' => 'danger'));
				$this->redirect(array('action' => 'index'));			
		}
	}

	public function admin_print() 
    { 
		$listAssoc = $this->Association->find('all');
		$this->set('listAssoc', $listAssoc); 
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render();    
    }

}
 ?>