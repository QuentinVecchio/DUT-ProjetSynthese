<div id="choixAdm" class="choixStat"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index', 'admin' => true)) ?>">
	<div  class="glyphicon glyphicon-user" style="font-size : 5em; margin-top: 170px;"></div>
	<br>Administrateur</a>
</div>
<div id="choixOpe" class="choixStat"><a href="<?php echo $this->Html->url(array('controller' => 'transactions', 'action' => 'sale', 'admin' => false)); ?>">
	<div  class="glyphicon glyphicon-book" style="font-size : 5em; margin-top: 170px;"></div>
	<br>Opérateur</a>
</div>
<div class="span4 offset6" id="choixDeco"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout', 'admin' => false)) ?>">
	<div  class="glyphicon glyphicon-off" style="font-size : 3em; margin-top: 7px"></div>
	<br>Déconnexion</a>
</div>


 <?php 
$this->start('css');
	echo $this->Html->css('choix');
$this->end();
 ?>