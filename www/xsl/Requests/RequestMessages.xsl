<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">      
        <xsl:apply-templates select="/Messages"/>                      
    </xsl:template>  
    
    <xsl:template match="Messages">
    	 <table id="table-chat" cellspacing="0" cellpadding="0" border="0" style="width:100%;" class="rc-ex-backend table-white-bg">
			<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">Дата</td>
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">ФИО</td>
    			<td style="border-bottom:1px solid #a1a1a1;" width="60%">Сообщение</td>
    		</tr>  		   			
   			
   			<xsl:apply-templates select="Message"/>
   		</table>
    </xsl:template>
    
   <xsl:template match="Message">
		<tr style="font-weight: normal;text-align:center">
			<td style="border-right:1px solid  #a1a1a1;" >
			<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),1,4)" />
			&#160;<xsl:value-of disable-output-escaping = "yes" select = "substring-after(@creation_date,' ')" />
			</td>
	    	<td style="border-right:1px solid  #a1a1a1;" >
	    		<xsl:if test="0 != @user_id">
	    			<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
	    			<xsl:value-of disable-output-escaping = "yes" select = "substring(@firstname, 1, 1)" />.
	    			<xsl:value-of disable-output-escaping = "yes" select = "substring(@patronymic, 1, 1)" />.
	    		</xsl:if>
	    		<xsl:if test="0 = @user_id">
	    			Диспетчер
	    		</xsl:if>
	    	</td>
	    	<td style="text-align:left;">&#160;
	    		<xsl:value-of disable-output-escaping = "yes" select = "@comment" />
	    	</td>
	    </tr>
	</xsl:template>	
            
</xsl:stylesheet>