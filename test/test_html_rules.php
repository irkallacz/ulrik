<?php
//načteme model a vytvoříme model
require 'rulesModel.class.php';
//modelu je potřeba předat složku ve které se nachází soubory jednotek
$model = new RulesModel(__DIR__.'/units');

//vytvoříme seznam položek z wargearu, tu můžeme načíst třeba z databáze nebo odjinud
//prohlédněte si soubor noble_wargear.xml pro více možností
$set = array('Alter kindred','Regenerace');

//z modelu si vytáhleme pravidla postavy podle jejího jména a předáme seznam položek z wargearu
//a necháme si z modelu vytvořit novou XML strukturu s vybranými položkami z wargearu   
$xml = $model->getXMLRules('noble',$set);

//se souborem můžeme udělat libovolné věci, vytvořit z něj html stránku, pdf, nebo ho jen vypsat
/*
header('Content-type: text/xml');
print $xml->saveXML();
exit;
*/

//my necháme si z modelu vytvořit html stránku podle units_html.xsl
$html = $model->XSLTransform(__DIR__.'/units/unit_html.xsl',$xml);

//alternativně můžeme předchozí dva kroky sloučit do jednoho pomocí $html = $model->getHTMLRules('noble',$set);

//vypíšeme html stránku
print $html;
?>