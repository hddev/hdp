<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">      
        <xsl:apply-templates select="/CompletedWorks"/>                      
    </xsl:template>  
    
    <xsl:template match="CompletedWorks">
    	 <table id="table-works" cellspacing="0" cellpadding="0" border="0" class="rc-ex-backend table-white-bg" style="width:100%;">
	    	
	    	<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1; border-left:1px solid #a1a1a1; border-top:1px solid #a1a1a1;" width="120px">Исполнители</td>
    			<td colspan = "2" style="border-bottom:1px solid #a1a1a1; border-top:1px solid #a1a1a1; border-right:1px solid #a1a1a1;">
    				 <xsl:for-each select="//ExternalData/RequestExecutants/RequestExecutor/Executant">    
    					<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
   						<xsl:value-of select='substring(@firstname, 1, 1)'/>.
   						<xsl:value-of select='substring(@patronymic, 1, 1)'/>.	    					 						
   						&#160;&#160;
    				</xsl:for-each>
    			</td>    			
    		</tr>
    		
    		<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1; border-left:1px solid #a1a1a1; " width="120px">В работе</td>
    			<td colspan = "2" style="border-bottom:1px solid #a1a1a1; border-right:1px solid #a1a1a1;">
    				<xsl:for-each select="//ExternalData/RequestExecutants/RequestExecutor">     				
    					<xsl:if test="1 = @take_in_work">
    						<xsl:value-of disable-output-escaping = "yes" select = "Executant/@secondname" />&#160;
   							<xsl:value-of select='substring(Executant/@firstname, 1, 1)'/>.
   							<xsl:value-of select='substring(Executant/@patronymic, 1, 1)'/>.
   							&#160;&#160;
    					</xsl:if>       					   						
    				</xsl:for-each>    		
    			</td>    			
    		</tr>
    		
    		<tr>
    			<td colspan = "3">&#160;&#160;</td>
    		</tr>
	    
			<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="120px">Дата</td>
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="120px">ФИО</td>
    			<td style="border-bottom:1px solid #a1a1a1;">Наименование</td>
    		</tr>  
    					 
   			<xsl:apply-templates select="CompletedWork"/>
  			<!--<xsl:apply-templates select="Defect"/>  	
  			<xsl:apply-templates select="TrustReceipt"/>  -->

   		</table>
    </xsl:template>
    
	<xsl:template match="CompletedWork">
		<xsl:variable name="executor_id" select="@executor_id"/>    	    	
    	<tr style="font-weight:normal">
    		<td align="center" ><a href = "/requests/?action=registration-completedwork&amp;request_id={@request_id}&amp;id={@id}">
    		<xsl:value-of disable-output-escaping = "yes" select = "substring(@date_start,9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@date_start,6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@date_start,1,4)" />
    		</a></td>
   			<td><a href = "/requests-ajax/?action=registration-completedwork&amp;request_id={@request_id}&amp;id={@id}" class="remote-url">
   			<xsl:value-of disable-output-escaping = "yes" select = "//CompletedWorks/ExternalData/RequestExecutants/RequestExecutor[@executor_id = $executor_id]/Executant/@secondname" />&#160;
   			<xsl:value-of select='substring(//CompletedWorks/ExternalData/RequestExecutants/RequestExecutor[@executor_id = $executor_id]/Executant/@firstname, 1, 1)'/>.<xsl:value-of select='substring(//CompletedWorks/ExternalData/RequestExecutants/RequestExecutor[@executor_id = $executor_id]/Executant/@patronymic, 1, 1)'/>.
   			</a>
   			</td>
   			<td><a href = "/requests-ajax/?action=registration-completedwork&amp;request_id={@request_id}&amp;id={@id}" class="remote-url"><xsl:value-of disable-output-escaping = "yes" select = "@comment" /></a></td>
		</tr>
	</xsl:template>	
	
	<!-- пережиток старого шаблона
	<xsl:template match="Defect">
	
    	<xsl:variable name="status" select="//Request/@status"/>
    	<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
    	
    	<tr style="font-weight:normal">
    		<td align="center" ><a href = "/requests-ajax/?action=print-defect&amp;defect_id={@id}&amp;id={@request_id}" target="_blank" download="download">
    		<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '), 9, 2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '), 6, 2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '), 1, 4)" />
    		</a></td>
   			<td><a href = "/requests-ajax/?action=print-defect&amp;defect_id={@id}&amp;id={@request_id}" target="_blank" download="download">
   			<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
   			<xsl:value-of select='substring(@firstname, 1, 1)'/>.<xsl:value-of select='substring(@patronymic, 1, 1)'/>.
   			</a>
   			</td>
   			<td>
   				<a href = "/requests-ajax/?action=print-defect&amp;defect_id={@id}&amp;id={@request_id}" target="_blank" download="download">Акт о дефектации № <xsl:value-of disable-output-escaping = "yes" select = "@number" /></a>
   				&#160;&#160;
   				
   				<xsl:if test="3 = $status and @author_id = $current_user_id">
   					<a href = "requests-ajax/?action=defect-remove&amp;defect_id={@id}&amp;id={@request_id}"> Отменить </a>
   				</xsl:if>
   				
   			</td>
		</tr>
	</xsl:template>
	
	<xsl:template match="TrustReceipt">
	
    	<xsl:variable name="status" select="//Request/@status"/>
    	<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
    	
    	<tr style="font-weight:normal">
    		<td align="center" >
    		<a href = "/requests-ajax/?action=print-receipt&amp;receipt_id={@id}&amp;id={@request_id}" target="_blank" download="download">
    		<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),1,4)" />
    		</a></td>
   			<td><a href = "/requests-ajax/?action=print-receipt&amp;receipt_id={@id}&amp;id={@request_id}" target="_blank" download="download">
   				<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
   				<xsl:value-of select='substring(@firstname, 1, 1)'/>.<xsl:value-of select='substring(@patronymic, 1, 1)'/>.
   			</a>
   			</td>
   			<td>
   				<a href = "/requests-ajax/?action=print-receipt&amp;receipt_id={@id}&amp;id={@request_id}" target="_blank" download="download">
   				Сохранная расписка
   				<xsl:if test = "@status = 2">(отменена)
   				</xsl:if>
   				</a>
   				&#160;&#160;
   				 
   				<xsl:if test="3 = $status and @author_id = $current_user_id">   				 				
   					<a href = "requests-ajax/?action=receipt-cancel&amp;receipt_id={@id}&amp;id={@request_id}"> Отменить </a>
   					&#160;&#160;
   					<a href = "requests-ajax/?action=receipt-remove&amp;receipt_id={@id}&amp;id={@request_id}"> Удалить </a>   				
   				</xsl:if> 
   			</td>
		</tr>
	</xsl:template>
     -->
             
</xsl:stylesheet>