<?php if($this->Session->read('Auth.User.status') == 'admin' && $this->params['prefix'] == 'admin'): ?>

<nav class="navbar navbar-inverse" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">GBL</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
		<li><?php echo $this->Html->Link('Opérateurs', array('controller' => 'users', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Filières', array('controller' => 'sectors', 'action' => 'index', 'admin' => true)); ?></li>
    <li><?php echo $this->Html->Link('Livres', array('controller' => 'books', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->Link('Etats', array('controller' => 'conditions', 'action' => 'index','admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Parents', array('controller' => 'clients', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Associations', array('controller' => 'associations', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Factures', array('controller' => 'transactions', 'action' => 'index', 'admin' => true)); ?></li>
    <li><?php echo $this->Html->Link('Stock', array('controller' => 'associations', 'action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->Link('Règlements', array('controller' => 'typereglements', 'action' => 'index', 'admin' => true)); ?></li>
    <li><?php echo $this->Html->Link('', array('controller' => 'users', 'action' => 'choice', 'admin' => true),
                                          array('class' => 'glyphicon glyphicon-user')) ?></li>
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
    <a class="navbar-brand" href="#">GBL</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
    <li class="divider-vertical"></li>
    <li> <?php echo $this->Html->Link('Vente', array('controller' => 'transactions', 'action' =>'initSale', 'admin' => false)) ?></li>
    <li class="divider-vertical"></li>
    <li> <?php echo $this->Html->Link('Dépôt', array('controller' => 'transactions', 'action' =>'init', 'admin' => false)) ?></li>
	 	<li class="divider-vertical"></li>
		<li> <a href="#">Parents</a> </li>
		<li class="divider-vertical"></li>
		<li> <a href="#">Livres</a> </li>
	 	<li class="divider-vertical"></li>
	 	<li> <a href="#">Stock</a> </li>
	  <li class="divider-vertical"></li>
  <?php if($this->Session->read('Auth.User.status') == 'admin'): ?>
    <li> <?php echo $this->Html->Link('', array('controller' => 'users', 'action' => 'choice', 'admin' => true),
                                          array('class' => 'glyphicon glyphicon-user')) ?></li>
  <?php endif; ?>

	</ul>
	<ul class="nav navbar-nav navbar-right">
        <li><?php echo $this->Html->link('', array('controller' => 'users', 'action' => 'logout', 'admin' => false),
                                            array('class' => 'pull-right glyphicon glyphicon-off')) ?></li>
    </ul> 
    </ul>   
  </div>
</nav>
<?php endif; ?>