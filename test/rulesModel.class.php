<?php
/**
 * RulesModel class.
 */
class RulesModel {	
	private $dir;

	public function __construct($dir){
		$this->dir = $dir;
	}
	  
  /*Hlavní metoda, která má na starost sloučení základního souboru pravidel a vybraných položek z wargearu*/
  public function getXMLRules($name,array $sets = array()){                
    $unit = $this->getXMLFile($name);
        
    /*Pokud sets není prázné*/
    if (!empty($sets)) {  
        /*Otevřeme wargear*/
        $wargear = $this->getXMLFile($name,true);
        $xpath = new DOMXPath($wargear);
       
        /*Přidat položky v poli $sets*/
        foreach($sets as $in){
          /*Najdeme požadovanou položku*/
          $node = $xpath->query("/wargear/*/*[name='$in']")->item(0);
          
          /*Pokud položka existuje*/
          if ($node) {   
            /*Najdeme nadřazenou položku*/
            $parent_name = $node->parentNode->tagName;            
            /*Pokud neexistuje nadřazená kategorie, tak jí vytvoří*/
            if (!$unit->getElementsByTagName($parent_name)->length) {
              $new = $unit->createElement($parent_name);
              $parent = $unit->documentElement->appendChild($new);
            } else $parent = $unit->getElementsByTagName($parent_name)->item(0);
            
            /*Přidá položku z wargearu do svého místa v pravidlech*/
            $import = $unit->importNode($node, true); 
            $parent->appendChild($import);
          }
        }
      unset($wargaer);
      unset($xpath);
      }
    return $unit;
  }

  /*Metoda která vrací xml souubor postavy nebo její wargear jako DOMDocument*/
  public function getXMLFile($name,$wargear = false){
    $path = $this->dir.'/'.$name;
    if ($wargear) $path.= '_wargear.xml'; else $path.= '.xml';    
  
    $xml = new DOMDocument;
    $xml->load($path);
    return $xml;
  }    

  /*Metoda která vrací html stránku*/
  public function getHTMLRules($name,$sets){
    $unit = $this->getXMLRules($name,$sets);            
    return $this->XSLTransform($this->dir.'/unit_html.xsl', $unit);
  }
  
  /*Metoda pro XSL transfomraci DOMDocumentu*/
  public function XSLTransform($path, DOMDocument $xml, array $params = array()){ 
    $xsl = new DOMDocument;
    $xsl->load($path);
    
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);
    
    /*Pokud jsou předány nějaké paramety, zpracující se*/
    foreach($params as $param => $value) $proc->setParameter('', $param, $value); 
    
    return $proc->transformToXML($xml);
  }    
  
}