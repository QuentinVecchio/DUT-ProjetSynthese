<h1>Vente</h1>
<div ng-app="todo" ng-controller="CtrlLivres">
<section id="" ng-show="clicked" ng-init="clicked=false" class="container" style="clear:both;">
        <header id="header" ng-init="etats=<?php echo htmlentities(json_encode($test)); ?>">

          <div ng-init="filieres=<?php echo htmlentities(json_encode($listFiliere)) ?>"></div>
          <div ng-init="urlGetGrades='<?php echo $this->Html->url(array('controller' =>'transactions', 'action' => 'getGrades', 'full_base' => true)) ?>'"></div>
          <div ng-init="urlGetBooks='<?php echo $this->Html->url(array('controller' =>'transactions', 'action' => 'getBooks', 'full_base' => true)) ?>'"></div>

          <h1>Choix des livres</h1>
            <form action="#" id="filieres-form" ng-submit="">
                <span id="filieres-list">
                  <strong>Filière</strong> : <select  ng-model="choixFiliere" ng-options="value.sector.name for value in filieres track by value.sector.id" ng-change="updateGrades()" required></select>
                </span>

                <span id="classes-list">
                 <strong>Classe</strong> : <select ng-model="choixClasse" ng-options="value.grade.name for value in classes track by value.grade.id"
                  ng-change="updateBooks()"required></select>
                </span>
            </form>
        </header>
<!--=======================================================================================================================================================-->
        <section id="main">
          <input title="Tout cocher" class="checkbox" type="checkbox" ng-model="allchecked" ng-click="checkAllTodo(allchecked)">
          <ul class="list-unstyled">
            <li class="list-group-item" ng-repeat="livre in livres | orderBy:name" ng-class="{completed : livre.completed}">
                <input type="checkbox" class="checkbox" ng-model="livre.completed">
                <label class="form-control">{{livre.Subject.name}}: {{livre.book.name}}</label>
            </li>
          </ul>

        </section>
<!--=======================================================================================================================================================-->
        <footer id="footer">
          <div class="panel-footer"><strong>{{variable}}</strong> livres selectionnés
            <button class="btn btn-primary" ng-click="TransfertLivre()">Valider</button>
            <input type="reset" value="Annuler" ng-click="clicked=false" class="btn btn-primary">
          </div>
        </footer>
<!--=======================================================================================================================================================-->
      </section>
<!--============================================================== Fin de section des livres =================================================================-->




<!--=======================================================================================================================================================-->
<!--============================================================== Section des achats =====================================================================-->
<!--=======================================================================================================================================================-->
      <section id="achats" class="container" ng-show="!clicked" ng-hide="clicked">
        <header id="header">
          <h1>Les achats</h1>
        </header>

  <!--=======================================================================================================================================================-->

        <section id="main">
          <ul class="list-unstyled">
              <li>
                <div class="view_vos_achats">
                <label id="vos_achats">
                 <table class="table table-bordered">
                    <thead>
                      <tr>
                        <td><strong>Options</strong></td>
                        <td><strong>Libellé</strong></td>
                        <td><strong>Etat</strong></td>
                        <td><strong>Quantité</strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="achat in achats">
                        <td><a class="btn btn-danger" ng-click="removeAchat($index)" title="Supprimer cet achat" href="#">Supprimer</a></td>
                        <td>{{achat.Subject.name}}: {{achat.book.name}}</td>
                        <td><select ng-model="achat.book.etat" ng-options="value.conditions.name for value in etats track by value.conditions.id"></select></td>
                        <td><input type="number" ng-model="achat.book.qte" style="width:50px; height:25px;"></td>
                      </tr>
                    </tbody>
                </table>
              </label>
            </div>
          </li>
          </ul>
        </section>

  <!--=======================================================================================================================================================-->

        <footer id="footer">
          <div class="panel-footer" id="footer_boutons">
              <input type="submit" value="Valider" class="btn btn-primary">
              <a class="btn btn-primary" ng-click="clicked=true" href="#">Nouveau</a>
          </div>
        </footer>

<!--=======================================================================================================================================================-->
    </section>
<!--=============================================================== Fin de la section des achats ==========================================================-->



<!--=======================================================================================================================================================-->
<!--============================================================== Section de la facture ==================================================================-->
<!--=======================================================================================================================================================-->

      <section id="facture" class="container" ng-show="!clicked" ng-hide="clicked">
        <header id="header">
          <h1>Aperçu facture</h1>
        </header>

  <!--=======================================================================================================================================================-->

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
                        <td>{{((achat.book.prize- achat.book.prize*achat.book.etat.conditions.reducing / 100)*achat.book.qte) || 0}} €</td>
                      </tr>
                    </tbody>
                </table>
                  <div class="panel-footer">
                    Montant total TTC : <strong>{{mt}}</strong> €
                  </div>
              </label>
            </div>
          </li>
          </ul>
        </section>

<!--=======================================================================================================================================================-->
    </section>

</div>
 <?php 
$this->start('script');
	echo $this->Html->script('ventes');
$this->end();

$this->start('css');
  echo $this->Html->css('vente_depot');
$this->end();

 ?>