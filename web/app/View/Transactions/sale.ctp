<h1>Vente</h1>
<div ng-app="todo" ng-controller="CtrlLivres">
<section id="" ng-show="clicked" ng-init="clicked=false" class="container" style="clear:both;">
        <header id="header" ng-init="etats=<?php echo htmlentities(json_encode($test)); ?>">
        	<div>
        		{{etats[0].name}}

        	</div>
          <h1>Choix des livres</h1>
            <form action="#" id="filieres-form" ng-submit="">
                <span id="filieres-list">
                  <strong>Filière</strong> : <select ng-selected="addLivre()" ng-init="filieres='<?php echo htmlentities(json_encode($listFiliere)) ?>'" ng-model="filiere" ng-options="f for f in filieres" required></select>
                </span>

                <span id="classes-list">
                 <strong>Classe</strong> : <select ng-init="" ng-model="classe" ng-options="c.name for c in classes" required></select>
                </span>
            </form>
        </header>
<!--=======================================================================================================================================================-->
        <section id="main">
          <input title="Tout cocher" class="checkbox" type="checkbox" ng-model="allchecked" ng-click="checkAllTodo(allchecked)">
          <ul class="list-unstyled">
            <li class="list-group-item" ng-repeat="livre in livres | orderBy:name" ng-class="{completed : livre.completed}">
                <input type="checkbox" class="checkbox" ng-model="livre.completed">
                <label class="form-control">{{livre.name}}</label>
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
                        <td>{{achat.name}}</td>
                        <td><select ng-model="achat.etat" ng-options="e.name for e in etats"></select></td>
                        <td><input type="number" ng-model="achat.qte" style="width:50px; height:25px;"></td>
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
                        <td>{{achat.name}}</td>
                        <td>{{achat.etat}}</td>
                        <td>{{achat.qte}}</td>
                        <td>{{achat.prix*achat.qte}} €</td>
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
 ?>