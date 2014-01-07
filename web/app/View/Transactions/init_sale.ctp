<?php $this->extend('corps_transaction_sale') ?>

<?php if(!$this->Session->check('Transaction.achat.Client')): ?>

<section ng-app="app" ng-controller="Controller">
  <div class="formulaire" style="width: 400px;margin: auto;padding-bottom:10px;">
    <legend>Choix du parent :</legend>
    <div ng-init="urlSearch='<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'getClient')); ?>';
            urlStep1='<?php echo $this->Html->Url(array('controller' => 'transactions', 'action' => 'initSale')) ?>'">
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
            <td><a href="{{urlStep1}}/{{c.Client.id}}" class="btn btn-primary">Selectionner</a></td>
          </tr>
      </tbody>
  </table>
  <div ng-show="!match && search.length >1" style="margin:auto;text-align : center;"><p><h2>Parent non trouvé</h2></p></div>
  <div><?php echo $this->Html->Link('Créer le parent', array('controller' => 'clients', 'action' => 'add'),
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
      <h2>Le parent : <?php echo $this->Session->read('Transaction.achat.Client.name').' '.$this->Session->read('Transaction.achat.Client.lastname'); ?></h2>
      <?php echo $this->Html->link('Désélectionner ?', array('controller' => 'transactions', 'action' => 'refresh'), array('confirm' => 'Etes-vous sûr?', 'class' => 'btn btn-danger')) ?>
  </div>
 <?php endif; ?>