<?php $this->extend('corps_transaction') ?>

<?php if(!$this->Session->check('Transaction.depot.Client')): ?>
  <?php if(!empty($listEnCours)): ?>
<section>
  <table class="table table-bordered">
      <br>
      <caption><h3>Vos sessions en cours</h3></caption>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Adresse</th>
          <th>Date</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listEnCours as $key => $value): ?>
          <tr>
            <td><?php echo $value['Client']['name'].' '.$value['Client']['lastname'] ?></td>
            <td><?php echo $value['Client']['houseNumber'].' '.$value['Client']['street'] ?></td>
            <td><?php echo $value['Transaction']['date'] ?></td>
            <td>
              <div class="btn-group">
                <button type="button" class="btn btn-primary">Actions</button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>              
                <ul class="dropdown-menu" role="menu">
                  <li><?php echo $this->Html->Link(' Reprendre',
                                    array('controller' => 'transactions', 'action' => 'resume', $value['Transaction']['id']),
                                    array('class' => 'glyphicon glyphicon-pencil')); ?>
                  </li>
                  <li><?php echo $this->Html->Link(' Suppression',
                              array('controller' => 'transactions', 'action' => 'deleteTransactionSale', $value['Transaction']['id']),
                              array('confirm' => 'Etes-vous sûr de vouloir le supprimer ?',
                                  'class' => 'glyphicon glyphicon-remove')); ?></li>
                </ul>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
  </table>
  <?php endif; ?>

</section>
<section ng-app="app" ng-controller="Controller">
  <div class="formulaire" style="width: 400px;margin: auto;padding-bottom:10px; text-align :center;">
    <legend>Choix du parent :</legend>
    <div ng-init="urlSearch='<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'getClient')); ?>';
            urlStep1='<?php echo $this->Html->Url(array('controller' => 'transactions', 'action' => 'init')) ?>'">
      <label for="searchParent">Rechercher le parent :</label>
      <input type="text" name="searchParent" id="searchParent" ng-model="search" ng-change="refresh()">
    </div>
  </div>
  <table ng-show="match" class="table table-bordered">
    <br>
    <caption>
        <h3>Résultat de la recherche :</h3><br>
    </caption>
    <thead>
      <tr>
          <th class="thNom">Nom</th>
          <th class="thAdresse">Adresse</th>
          <th style="width : 115px">Réglages</th>
      </tr>
    </thead>
      
      <tbody>
          <tr ng-repeat="c in Clients">
            <td >{{c.Client.name}} {{c.Client.lastname}}</td>
            <td >{{c.Client.houseNumber}} {{c.Client.street}} {{c.Town.name}}</td>
            <td><a href="{{urlStep1}}/{{c.Client.id}}" class="btn btn-primary">Sélectionner</a></td>
          </tr>
      </tbody>
  </table>
  <div ng-show="!match && search.length >1" style="margin:auto;text-align : center;"><p><h2>Parent non trouvé</h2></p></div>
  <div><?php echo $this->Html->Link('Créer le parent', array('controller' => 'clients', 'action' => 'add', '?' => array('action' => 'depot')),
                               array('class' => 'btn btn-primary')) ?>
  </div>
</section>
 <?php 
$this->start('script');
  echo $this->Html->script('transactionChoixParent');
$this->end();

 ?>

 <?php else: ?>
    <div style="text-align:center;width: 1000px;margin: auto;padding-bottom:10px;">
      <h1>Le parent est déjà séléctionné</h1>
    </div>
    <div class="formulaire" style="width: 600px;margin: auto;padding:10px;">
      <h2>Le parent : <?php echo $this->Session->read('Transaction.depot.Client.name').' '.$this->Session->read('Transaction.depot.Client.lastname'); ?></h2>
      <?php echo $this->Html->link('Désélectionner ?', array('controller' => 'transactions', 'action' => 'refresh', '?' => array('type' => 'depot')), array('confirm' => 'Etes-vous sûr?', 'class' => 'btn btn-danger')) ?>
  </div>
 <?php endif; ?>