<?php
//načteme model a vytvoříme model
require 'rulesModel.class.php';
//modelu je potřeba předat složku ve které se nachází soubory postav
$model = new RulesModel(__DIR__.'/units');

//z modelu si vytáhleme všechyn položky v pravidlech wargearu
//a necháme si z ní vytvořit novou XML strukturu    
$xml = $model->getXMLFile('noble',true);

//necháme si pomocí modelu z XML struktury wargearu vytvořit html stránku podle wargear_prehled.xsl
$html = $model->XSLTransform(__DIR__.'/units/wargear_vizual.xsl',$xml);
//alternativně můžeme použít i jiné šablony například
//$html = $model->XSLTransform(__DIR__.'/units/wargear_prehled.xsl',$xml);

//vypíšeme html stránku
print $html;
?>