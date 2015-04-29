<?php
//načteme model a vytvoříme model
require 'rulesModel.class.php';
//modelu je potřeba předat složku ve které se nachází soubory postav
$model = new RulesModel(__DIR__.'/units');

//vytvoříme seznam položek z wargearu, tu můžeme načíst třeba z databáze nebo odjinud
//prohlédněte si soubor noble_wargear.xml pro více možností
$set = array('Alter kindred','Regenerace');

//z modelu si vytáhleme pravidla postavy podle jejího jména a předáme seznam položek z wargearu
//a necháme si z modelu vytvořit novou XML strukturu s vybranými položkami z wargearu   
$doc = $model->getXMLRules('noble',$set);

//můžeme zkusit vypsat si popis postavy
print '<p>Popis postavy: '.$doc->getElementsByTagName('popis')->item(0)->textContent.'</p>';

//nebo si spočítat počty životů
print 'Životy: ';
$i = 0;
foreach($doc->getElementsByTagName('lives') as $live) $i = $i + intval($live->nodeValue);
print $i;

//pokud nechte pracovat se třídou DOM, můžete si objekt převést na instanci SimpleXML
$xml = simplexml_import_dom($doc);

//výpis všech zbraní pomocí SimpleXML
print '<h4>Zbraně:</h4><dl>';
foreach ($xml->zbrane->zbran as $zbran){
  print '<dt>'.$zbran->name.'</dt>';
  print '<dd>'.$zbran->desc->asXML().'</dd>'; 
}
print '</dl>';

//se souborem můžeme udělat i jiné věci, vytvořit z něj html stránku, pdf, nebo ho jen vypsat jako XML
/*header('Content-type: text/xml');
print $doc->saveXML();
*/
?>