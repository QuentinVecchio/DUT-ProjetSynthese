<?php if($this->Session->read('Auth.User.status') == 'admin'): ?>

<nav class="navbar navbar-inverse" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">Gestion Bourse aux Livres</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
		<li><?php echo $this->Html->Link('Opérateurs', array('controller' => 'users', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Filières', array('controller' => 'sectors', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Livres', array('controller' => 'books', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->Link('Parents', array('controller' => 'clients', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Associations', array('controller' => 'associations', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Factures', array('controller' => 'associations', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Stock', array('controller' => 'associations', 'action' => 'index', 'admin' => true)); ?></li>
        <li> <?php echo $this->Html->Link('', array('controller' => 'users', 'action' => 'choice', 'admin' => true), array('class' => 'glyphicon glyphicon-user')) ?></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><?php echo $this->Html->link('', array('controller' => 'users', 'action' => 'logout', 'admin' => false),
                                            array('class' => 'pull-right glyphicon glyphicon-off')) ?></li>
    </ul>   
  </div>
</nav>
<?php else: ?>
  
<nav class="navbar navbar-inverse" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">Gestion Bourse aux Livres</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
    <li class="divider-vertical"></li>
    <li> <a href="#">Vente</a> </li>
    <li class="divider-vertical"></li>
	 	<li> <a href="#">Dépôt</a> </li>
	 	<li class="divider-vertical"></li>
		<li> <a href="#">Parents</a> </li>
		<li class="divider-vertical"></li>
		<li> <a href="#">Livres</a> </li>
	 	<li class="divider-vertical"></li>
	 	<li> <a href="#">Stock</a> </li>
	  	<li class="divider-vertical"></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
        <li><?php echo $this->Html->link('', array('controller' => 'users', 'action' => 'logout', 'admin' => false),
                                            array('class' => 'pull-right glyphicon glyphicon-off')) ?></li>
    </ul> 
    </ul>   
  </div>
</nav>
<?php endif; ?>