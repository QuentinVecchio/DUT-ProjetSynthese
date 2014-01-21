<?php $this->extend('corps_transaction_sale') ?>
<script type="text/javascript">
</script>


<div style="text-align: center;">
  <h1>Espace vente</h1>
</div>
<div ng-app="GBL" ng-controller="CtrlLivres" class="clearFix">
<ul>
  <li ng-repeat="error in errors">{{error}}</li>
</ul>
<section id="book_choice" ng-show="clicked" ng-init="clicked=false" class="container animated fadeIn" style="clear:both;">
        <header id="header" ng-init="transaction_id=<?php echo $this->Session->read('Transaction.achat.transaction_id') ?>">
          <div ng-init="filieres=<?php echo htmlentities(json_encode($listFiliere)) ?>;<?php if(isset($listAchat)) echo 'achats='.htmlentities(json_encode($listAchat)).';copyAchats='.htmlentities(json_encode($listAchat)).';'; ?>"></div>
          <div ng-init="urlGetGrades='<?php echo $this->Html->url(array('controller' =>'transactions', 'action' => 'getGrades', 'full_base' => true)) ?>';urlAddRow='<?php echo $this->Html->url(array('controller' => 'transactions', 'action' => 'addRow', 'full_base' => true)) ?>';
                urlDeleteRow='<?php echo $this->Html->url(array('controller' => 'transactions', 'action' => 'deleteRow', 'full_base' => true)) ?>';
                urlUpdateRow='<?php echo $this->Html->url(array('controller' => 'transactions', 'action' => 'updateRow', 'full_base' => true)) ?>';
                "></div>
          <div ng-init="urlGetBooks='<?php echo $this->Html->url(array('controller' =>'transactions', 'action' => 'getBooks', 'full_base' => true)) ?>'"></div>
          <h3>Choix des livres</h3>
            <form action="#" id="filieres-form" ng-submit="">
                <span id="filieres-list">
                  <strong>Filière</strong> : <select  ng-model="choixFiliere" ng-options="value.Sector.name for value in filieres track by value.Sector.id" ng-change="updateGrades()" required></select>
                </span>

                <span id="classes-list">
                 &nbsp&nbsp<strong>Classe</strong> : <select ng-model="choixClasse" ng-options="value.Grade.name for value in classes track by value.Grade.id"
                  ng-change="updateBooks()"required></select>
                </span>
            </form>
        </header>
        <section id="main">
         <input title="Tout cocher" type="checkbox"  id="toggle-all" class="" ng-model="allchecked" ng-click="checkAllTodo(allchecked)"><strong>&nbspTout cocher</strong>
          <ul class="list-unstyled" id="todo-list">
            <li class="list-group-item" ng-repeat="livre in livres | orderBy:name" ng-init="livre.completed=false" ng-class="{completed : livre.completed}">
                <input type="checkbox" class="toggle" ng-model="livre.completed">
                <label id="book_name" class="form-control">{{livre.Subject.name}}: {{livre.Book.name}}</label>
            </li>
          </ul>
        </section>
        <footer id="footer">
          <div id="footer_choice" class="panel-footer"><strong>{{variable}}</strong> livres selectionnés
            <button class="btn btn-primary" ng-click="TransfertLivre()">Valider</button>
            <input type="reset" value="Annuler" ng-click="clicked=false" class="btn btn-primary">
          </div>
        </footer>
      </section>
      <section id="achats" class="container animated fadeIn" ng-show="!clicked" ng-hide="clicked">
        <header id="header">
          <h3>Les achats</h3>
        </header>
        <?php echo $this->Form->create('Row'); ?>
        <section id="main">
          <ul class="list-unstyled">
              <li>
                <div class="view_vos_achats">
                <label id="vos_achats">
                 <table class="table table-bordered">
                    <thead>
                      <tr>
                        <td><strong>Options</strong></td>
                        <td><strong>Matière</strong></td>
                        <td><strong>Livre</strong></td>
                        <td><strong>Prix / U</strong></td>
                        <td><strong>Etat</strong></td>
                        <td><strong>%</strong></td>
                        <td><strong>Quantité</strong></td>
                        <td><strong>Max</strong></td>
                        <td><strong>Total</strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="achat in achats">
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options&nbsp
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a class="glyphicon glyphicon-remove" ng-click="removeAchat($index)" href="#">&nbspSupprimer</a></li>
                              <li><a class="glyphicon glyphicon-plus" ng-click="duplicateAchat($index)" href="#">&nbspDupliquer</a></li>
                            </ul>
                          </div>
                            <input type="text" style="display:none" name="{{$index}}[Row][transaction_id]" ng-value="transaction_id">
                            <input type="text" style="display:none" name="{{$index}}[Row][book_id]" ng-model="achat.Row.book_id">
                            <input type="text" style="display:none" name="{{$index}}[Row][name_book]" ng-model="achat.Row.name_book">
                            <input type="text" style="display:none" name="{{$index}}[Row][name_subject]" ng-model="achat.Row.name_subject">
                            <input type="text" style="display:none" name="{{$index}}[Row][prize_unit]" ng-model="achat.Row.prize_unit">
                            <input type="text" style="display:none" name="{{$index}}[Row][prize_total]" ng-model="achat.Row.prize_total">
                            <input type="text" style="display:none" name="{{$index}}[Row][name_condition]"  ng-model="achat.Row.name_condition">
                        </td>
                        <td>{{achat.Row.name_subject}}</td>
                        <td>{{achat.Row.name_book}}</td>
                        <td class="prix">{{achat.Row.prize_unit | number:2}}&nbsp€</td>
                        <td><select name="{{$index}}[Row][condition_id]" ng-model="achat.Row.Condition"  ng-options="value.Condition.name for value in achat.Row.ConditionList track by value.Condition.id" ng-change="updateCondition($index)"></select></td>

                        <td><input type="text" name="{{$index}}[Row][reducing]" ng-model="achat.Row.reducing"  ng-change="changeRow($index)" style="width:50px; height:25px; text-align:center;"></td>


                        <td><input name="{{$index}}[Row][amount]" type="number" ng-init="achat.Row.amount" min="1" ng-model="achat.Row.amount" style="width:50px; height:25px;" ng-change="changeRow($index)" ></td>

                        <td>{{achat.Row.Condition.Condition.max}}</td>

                        <td class="prix">{{achat.Row.prize_total | number:2}}&nbsp€</td>

                      </tr>
                    </tbody>
                </table>
                <span class="TotalTTC">Montant total TTC : <strong>{{mt | number:2}}</strong> €</span>
              </label>
            </div>
          </li>
          </ul>
        </section>
        <!--<footer id="footer">
          <div class="panel-footer" id="footer_boutons">-->
              <a class="btn btn-primary" ng-click="saveAchats()" href="#" style="margin-left: 700px;">Nouveau</a>
        <!--  </div>
        </footer>-->
        <input id="BtnSubmit" type="submit" ng-click="VerifBook()" value="Acheter" class="btn btn-success">
        </section>
        <?php echo $this->Form->end(); ?>
        <!--
      <section id="facture" class="container animated fadeIn" ng-show="!clicked" ng-hide="clicked">
        <header id="header">
          <h3>Aperçu facture</h3>
        </header>
        <section id="main">
          <ul class="list-unstyled">
              <li>
                <div class="view_vos_achats">
                <label id="vos_achats">
                 <table class="table table-bordered" id="choix">
                    <thead>
                      <tr>
                        <td><strong>Livre</strong></td>
                        <td><strong>Etat</strong></td>
                        <td><strong>Quantité</strong></td>
                        <td><strong>Prix</strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="achat in achats">
                        <td>{{achat.Subject.name}}: {{achat.book.name}}</td>
                        <td>{{achat.book.etat.conditions.name}}</td>
                        <td>{{achat.book.qte}}</td>
                        <td class="prix">{{((achat.book.prize- achat.book.prize*achat.book.etat.conditions.reducing / 100)*achat.book.qte) | number:2 || 0}} €</td>
                      </tr>
                    </tbody>
                </table>
                  <div class="panel-footer">
                    Montant total TTC : <strong>{{mt | number:2}}</strong> €
                  </div>
              </label>
            </div>
          </li>
          </ul>
        </section>
    </section>
  -->

</div>
<link rel="stylesheet" href="https://daneden.me/animate/animate.css">
<script type="text/javascript" source="http://code.angularjs.org/1.2.0/angular-animate.min.js"></script>
<script type="text/javascript" source="http://code.angularjs.org/1.2.5/MINERR_ASSET"></script>
 <?php 
$this->start('script');
  echo $this->Html->script('ventes');
$this->end();
$this->start('css');
  echo $this->Html->css('vente_depot');
$this->end();
 ?>