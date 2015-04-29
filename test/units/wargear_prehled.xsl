<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" encoding="utf-8" doctype-public="-//W3C//DTD HTML 4.01//EN"/>

<xsl:key name="polozky" match="/wargear/*/*" use="cond"/>

<xsl:template match="wargear">      
  <html>
  <head> 
    <title><xsl:value-of select="jmeno" /> | Přehled</title>
    <link rel="stylesheet" href="css/wargear_prehled.css" type="text/css" media="screen" />
  </head>
  <body>
  <div id="vizual">
  <ul><xsl:apply-templates select="*/*[not(cond)]"/></ul>
  </div>
  </body>
  </html>
</xsl:template>

<xsl:template match="*"> 
  <xsl:param name="id" select="name"/>
  <li>
    <a class="{concat('elem ',name())}" href="#{name}"><xsl:value-of select="name" /></a>
    <xsl:if test="key('polozky',$id)"><ul><xsl:apply-templates select="key('polozky',$id)"/></ul></xsl:if>
  </li>
</xsl:template>
     
</xsl:stylesheet> 