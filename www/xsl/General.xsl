<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
    	<br/>
    	   	<br/><a href="/requests/?action=request-form&amp;id=0"><div id="Main-Block-New-Request" /></a><br/>
			<br/><a href="/requests/?action=requests-list&amp;type=inwork&amp;category=inwork"><div id="Main-Block-List-Requests" /></a><br/><br/>
    </xsl:template>
</xsl:stylesheet>