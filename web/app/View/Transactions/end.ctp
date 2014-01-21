<div style="width : 300px;margin: auto; text-align:center;">
<h2>Fin de vente.</h2>
<h1>Merci beaucoup.</h1>
<?php 
    echo $this->Html->Link('Imprimer', array('controller' => 'transactions', 'action' => 'imprime', $facture_id), array('class' => 'btn btn-primary'));
?>
</div>