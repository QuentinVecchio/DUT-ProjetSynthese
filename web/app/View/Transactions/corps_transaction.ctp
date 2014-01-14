<?php 
	$texte;
	if($this->Session->check('Transaction.depot.Client')){
		$texte = 'Parent: '. $this->Session->read('Transaction.depot.Client.name').' '.$this->Session->read('Transaction.depot.Client.lastname');
	}else{
		$texte = 'Aucun parent selectionné';
	}

 ?>
<?php debug($this->Html->url(array('controller' => 'transactions', 'action' => 'depot'))); ?>
<section>
	<h1 class="jumbotron"><p><font size="6"><strong>Depôt</strong></font></p><?php echo $texte; ?></h1>
	<div>
		<ul id="barreProgress" class="step-5">	
			<li class="etape <?php if($step_for_progress_bar == 1)echo 'focus'; ?>">
				<a href="<?php echo ($this->Html->url(array('controller' => 'transactions', 'action' => 'init'))); ?>"><span>1</span><h1> - Parent</h1><p>Choix du parent</p></a>
			</li><!--
			--><li class="etape <?php if($step_for_progress_bar == 2)echo 'focus'; ?>">
				<a href="<?php echo ($this->Html->url(array('controller' => 'transactions', 'action' => 'depot'))); ?>"><span>2</span><h1> - Dépôt</h1><p>Liste des livres à déposer</p></a>
			</li><!--
			--><li class="etape <?php if($step_for_progress_bar == 3)echo 'focus'; ?>">
				<a href="<?php echo ($this->Html->url(array('controller' => 'transactions', 'action' => 'recapDepot'))); ?>"><span>3</span><h1> - Recapitulation</h1><p>Liste des livres déposer</p></a>
			</li><!--
			--><li class="etape <?php if($step_for_progress_bar == 4)echo 'focus'; ?>">
				<a href="<?php echo ($this->Html->url(array('controller' => 'transactions', 'action' => 'depot'))); ?>"><span>4</span><h1> - Facture</h1><p>Visualisation facture</p></a>
			</li><!--
			--><li class="etape <?php if($step_for_progress_bar == 5)echo 'focus'; ?>">
				<a href="<?php echo ($this->Html->url(array('controller' => 'transactions', 'action' => 'depot'))); ?>"><span>5</span><h1> - Validation</h1><p>Validation du dépôt</p></a>
			</li><!--
			--></ul>
		<div id="btnGroup">
			<a id="btnPred" class="btn btn-primary " href="<?php echo $this->Html->url($pred_for_progress_bar); ?>"><span class="glyphicon glyphicon-chevron-left"></span> Pred</a>
			<a id="btnSuiv" class="btn btn-primary" href="<?php echo $this->Html->url($suiv_for_progress_bar); ?>">Suiv <span class="glyphicon glyphicon-chevron-right"></a>
		</div>
	</div>
</section>
<section>
	<?php echo $this->fetch('content'); ?>

</section>