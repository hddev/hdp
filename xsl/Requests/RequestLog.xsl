<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">      
        <xsl:apply-templates select="/LogActions"/>                      
    </xsl:template>  
    
    <xsl:template match="LogActions">
    	 <table id="table-history" cellspacing="0" cellpadding="0" border="0" style="width:100%;" class="rc-ex-backend table-white-bg">
			<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">Дата</td>
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">ФИО</td>
    			<td style="border-bottom:1px solid #a1a1a1;" width="60%">Действие</td>
    		</tr>  			 
   			<xsl:apply-templates select="LogAction"/>
   		</table>
    </xsl:template>
    
   <xsl:template match="LogAction">
		<tr style="font-weight: normal;text-align:center">
			<td style="border-right:1px solid  #a1a1a1;" >
			<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@date,' '),9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@date,' '),6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@date,' '),1,4)" />
			&#160;<xsl:value-of disable-output-escaping = "yes" select = "substring-after(@date,' ')" />
			</td>
	    	<td style="border-right:1px solid  #a1a1a1;" ><xsl:value-of disable-output-escaping = "yes" select = "@fio" /></td>
	    	<td style="text-align:left;">&#160;
	    		<xsl:if test="@action = ''">-</xsl:if>
	    		<xsl:if test="@action != ''"><xsl:value-of disable-output-escaping = "yes" select = "@action" /></xsl:if>
	    	</td>
	    </tr>
	</xsl:template>	
            
</xsl:stylesheet>