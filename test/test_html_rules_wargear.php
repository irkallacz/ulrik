<?php
//načteme model a vytvoříme model
require 'rulesModel.class.php';
//modelu je potřeba předat složku ve které se nachází soubory jednotek
$model = new RulesModel(__DIR__.'/units');

//načteme seznam položek z wargearu z parametru předanému skripu
$set = array_key_exists('set', $_GET) ? $_GET['set'] : $set = array(); 

//z modelu si vytáhleme pravidla postavy podle jejího jména a předáme seznam položek z wargearu
//a necháme si z modelu vytvořit novou XML strukturu s vybranými položkami z wargearu   
//my necháme si z modelu vytvořit html stránku podle units_html.xsl
$html = $model->getHTMLRules('noble',$set);

//vypíšeme html stránku
print $html;
?>