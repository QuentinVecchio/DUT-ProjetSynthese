<?php debug($this->Session->read('Transaction')); ?>
<section>
	<div>
		<ul id="barreProgress" class="step-5">	
			<li class="etape <?php if($step_for_progress_bar == 1)echo 'focus'; ?>">
				<span>1</span><h1> - Parent</h1><p>Choix du parent</p>
			</li>
			<li class="etape <?php if($step_for_progress_bar == 2)echo 'focus'; ?>">
				<span>2</span><h1> - Vente</h1><p>Liste des livres à vendre</p>
			</li>
			<li class="etape <?php if($step_for_progress_bar == 3)echo 'focus'; ?>">
				<span>3</span><h1> - Recapitulation</h1><p>Liste des livres à vendre</p>
			</li>
			<li class="etape <?php if($step_for_progress_bar == 4)echo 'focus'; ?>">
				<span>4</span><h1> - Facture</h1><p>Visualisation facture</p>
			</li>
			<li class="etape <?php if($step_for_progress_bar == 5)echo 'focus'; ?>">
				<span>5</span><h1> - Validation</h1><p>Validation du dépôt</p>
			</li>
		</ul>
		<div id="btnGroup">
			<a id="btnPred" class="btn btn-primary " href="<?php echo $this->Html->url($pred_for_progress_bar); ?>"><span class="glyphicon glyphicon-chevron-left"></span> Pred</a>
			<a id="btnSuiv" class="btn btn-primary" href="<?php echo $this->Html->url($suiv_for_progress_bar); ?>">Suiv <span class="glyphicon glyphicon-chevron-right"></a>
		</div>
	</div>
</section>
<section>
	<?php echo $this->fetch('content');

	?>
</section>