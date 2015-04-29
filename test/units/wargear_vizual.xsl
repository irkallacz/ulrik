<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" encoding="utf-8" doctype-public="-//W3C//DTD HTML 4.01//EN"/>

<xsl:key name="polozky" match="/wargear/*/*" use="cond"/>

<xsl:template match="wargear">      
  <html>
  <head> 
    <title><xsl:value-of select="jmeno" /> | Vizual</title>
    <link rel="stylesheet" href="css/wargear_vizual.css" type="text/css" media="screen" />
    <script type="text/javascript">
    <xsl:text>
    function spocti(){
      var a = 0;
      var nodes = document.getElementsByTagName('input');
      for (var i = 0; i &lt; nodes.length; i++)        
       if (nodes[i].checked) a = a + parseInt(nodes[i].getAttribute('data-cost'));
        
      document.getElementById('count').textContent = a +' pt';
    };
    </xsl:text>
    </script>
  </head>
  <body>
  <form method="get" action="test_html_rules_wargear.php" target="_blank">
  <div id="vizual">
  <h2><xsl:value-of select="jmeno" /></h2>
  <ul><xsl:apply-templates select="*/*[not(cond)]"/></ul>
  <div id="count"></div>
  </div>
  <p><input type="submit" value="Zobrazit pravidla"/></p>
  </form>                                                                        
  </body>
  </html>
</xsl:template>

<xsl:template match="*"> 
  <xsl:param name="id" select="name"/>
  
  <li><div class="{concat('elem ',name())}">
    <input type="checkbox" onchange="spocti()" name="set[]" id="{generate-id()}" value="{$id}" data-cost="{points}" />      
    <label for="{generate-id()}"><xsl:value-of select="name" /></label>
     
    <div class="flow">
      <xsl:if test="name()='skill'"><p>(<xsl:value-of select="attr"/>)</p></xsl:if>
      <xsl:if test="name()='spell'"><p>(<xsl:value-of select="attr"/>, <xsl:value-of select="cost"/>)</p></xsl:if>
      
      <p><xsl:apply-templates select="desc"/></p>
      
      <p>Body: <xsl:value-of select="points"/></p>
    </div>
  </div>
    <xsl:if test="key('polozky',$id)"><ul><xsl:apply-templates select="key('polozky',$id)"/></ul></xsl:if>
  </li>
</xsl:template>
     
<xsl:template match="desc"> 
  <xsl:apply-templates select="text()|b|i|u|cite|br"/>  
</xsl:template>

<xsl:template match="b|i|u|cite"> 
  <xsl:element name="{name()}">
    <xsl:value-of select="."/>
  </xsl:element>  
</xsl:template>

<xsl:template match="br"><br /></xsl:template>

</xsl:stylesheet> 