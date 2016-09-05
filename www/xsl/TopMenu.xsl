<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/MenuItems"/>
    </xsl:template>
    
    <xsl:template match="MenuItems">
    	<table cellspacing="0" cellpadding="0" border="0" id="topmenu">
    		<tr>
    			<td>
    				<table cellspacing="0" cellpadding="0" border="0" id="subtopmenu">
    					<tr>
 							<xsl:apply-templates select="MenuItem"/>
 						</tr>
 					</table>
 				</td>
 			</tr>
 		</table>
    </xsl:template>
    
    <xsl:template match="MenuItem">
    	<xsl:variable name="real_url"><xsl:call-template name="URLBuilder"><xsl:with-param name="parent" select="@parent" /></xsl:call-template>/<xsl:value-of select="@url" />/</xsl:variable>
    	<td>
    		<xsl:if test="@active = 1">
    			<xsl:attribute name="class">active</xsl:attribute>
    		</xsl:if>
 			<a href="{$real_url}"><xsl:value-of disable-output-escaping = "yes" select="@name" /></a>
 		</td>
 		<td class="divider"></td>
    </xsl:template>
    
    
    <xsl:template name="URLBuilder">
    	<xsl:param name="parent" />
    	<xsl:if test="$parent &gt; 0">
    		/<xsl:value-of select="/MenuItems/MenuItem[@id=$parent]/@url" /><xsl:call-template name="URLBuilder"><xsl:with-param name="parent" select="/MenuItems/MenuItem[@id=$parent]/@parent" /></xsl:call-template>
    	</xsl:if>
    </xsl:template>
</xsl:stylesheet>