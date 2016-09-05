<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/ContractServiceGroup">
    <xsl:variable name="contractor_id" select="@contractor_id" />
    <xsl:variable name="status" select="@status" />
    	<div id="adminpanel-content">
    	<form name="dynamicdataform" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="10">Редактирование карточки группы услуг</th>
    		</thead>
    		<!-- <tr>
    			<td class="first"></td>
    			<td width="150">Идентификатор</td>
    			<td><xsl:value-of disable-output-escaping = "yes" select="@id" /></td>
    			<td class="last"></td>
    		</tr>  -->
    		<tr class="even">
    			<td class="first"></td>
    			<td>Наименование</td>
    			<td><input type="text" name="name" value="{@name}"/></td>
    			<td class="last"></td>
    		</tr>   		
    		    		
    		<tr>
    			<td class="first"></td>
    			<td>Статус</td>    			
    			
    			<td>
					<select name="status">
					
					<xsl:if test="0 = @status"> 
    					<option selected = "selected" value="{@status}">проект</option>
    					<option value= "1">действующий</option>
    					<option value= "2">недействующий</option>    					
    				</xsl:if>
    				
					<xsl:if test="1 = @status"> 
						<option value= "0">проект</option>
    					<option selected = "selected" value="{@status}">действующий</option>
    					<option value= "2">недействующий</option>    					
    				</xsl:if>
    				
    				<xsl:if test="2 = @status"> 
    					<option value= "0">проект</option>
    					<option value= "1">действующий</option>
    					<option selected = "selected" value="{@status}">недействующий</option>    					
    				</xsl:if>
    				
    				</select>
    			</td>
    			    			
    			<td class="last"></td>
    		</tr>
    		    		    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="saveandexit" value="Сохранить" /><input type="submit" name="saveandedit" value="Применить" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="servicegroup-edit" />
    	<input type="hidden" name="contract_id" value="{@contract_id}" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>