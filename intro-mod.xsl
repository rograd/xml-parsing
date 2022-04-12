<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="xml" indent="yes" encoding="UTF-8" omit-xml-declaration="yes" />
  <xsl:template match="/">
    <html>
      <head>
        <title>Firma krzak</title>        
      </head>
      <body>
        <label class="gtkLabelCateg">
          <xsl:value-of select="intro/title" />
        </label>
        <section class="gtkListBox">
          <ul>
            <xsl:for-each select="intro/list/item">
              <li>
                <xsl:value-of select="." />
              </li>
              <!--//li><xsl:copy-of select="current()"/></li//-->
            </xsl:for-each>
          </ul>
        </section>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>