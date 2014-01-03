<?php $this->extend('corps_transaction_sale') ?>

<?php if(!$this->Session->check('Transaction.Client')): ?>

<section ng-app="app" ng-controller="Controller">
  <h1>Choix du parent:</h1>
  <div ng-init="urlSearch='<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'getClient')); ?>';
          urlStep2='<?php echo $this->Html->Url(array('controller' => 'transactions', 'action' => 'sale')) ?>'">
    <label for="searchParent">Rechercher le parent:</label>
    <input type="text" name="searchParent" id="searchParent" ng-model="search" ng-change="refresh()">
  </div>
    <div><?php echo $this->Html->Link('Créer le parent', array('controller' => 'clients', 'action' => 'add'),
                               array('class' => 'btn btn-primary')) ?>
    </div>
  <table ng-show="match" class="table table-bordered">
    <caption>
        <h5>Résultat de la recherche:</h5><br>
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
        <td><a href="{{urlStep2}}/{{c.Client.id}}" class="btn btn-primary">Selectionner</a></td>
          </tr>
      </tbody>
  </table>
  <div ng-show="!match && search.length >1"><p>Parent non trouvé</p></div>
</section>
 <?php 
$this->start('script');
  echo $this->Html->script('transactionChoixParent');
$this->end();

 ?>

 <?php else: ?>
  <h1>Le parent est déjà séléctionné</h1>
  <h2>Le parent: <?php echo $this->Session->read('Transaction.Client.name').' '.$this->Session->read('Transaction.Client.lastname'); ?></h2>
  <?php echo $this->Html->link('Désélectionner ?', array('controller' => 'transactions', 'action' => 'refresh'), array('confirm' => 'Etes-vous sûr?', 'class' => 'btn btn-danger')) ?>
 <?php endif; ?>