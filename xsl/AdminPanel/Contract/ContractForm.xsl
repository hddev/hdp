<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
		<xsl:apply-templates select="/Contract"/>
    </xsl:template>  
    
    <xsl:template match="Contract">
    <xsl:variable name="contractor_id" select="@contractor_id" />
    <xsl:variable name="status" select="@status" />
    	<div id="adminpanel-content">
    	<form name="dynamicdataform" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="10">Редактирование карточки договора</th>
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
    			<td>Номер договора</td>
    			<td><input type="text" name="number" value="{@number}"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td>Дата начала</td>
    			<td><input type="datetime" name="date_start" value="{@date_start}"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Ответственный</td>
    			<td><input type="text" name="responsible_id" value="{@responsible_id}"/></td>
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
    					<option value= "2">закрыт</option>
    					<option value= "3">расторгнут</option>
    				</xsl:if>
					<xsl:if test="1 = @status"> 
						<option value= "0">проект</option>
    					<option selected = "selected" value="{@status}">действующий</option>
    					<option value= "2">закрыт</option>
    					<option value= "3">расторгнут</option>
    				</xsl:if>
    				<xsl:if test="2 = @status"> 
    					<option value= "0">проект</option>
    					<option value= "1">действующий</option>
    					<option selected = "selected" value="{@status}">закрыт</option>
    					<option value= "3">расторгнут</option>
    				</xsl:if>
    				<xsl:if test="3 = @status"> 
    					<option value= "0">проект</option>
    					<option value= "1">действующий</option>
    					<option value= "2">закрыт</option>
    					<option selected = "selected" value="{@status}">расторгнут</option>
    				</xsl:if>
    				</select>
    			</td>
    			    			
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Котрагент</td>
    			<td>    			
    				<select name="contractor_id">
    					<xsl:if test="0 != $contractor_id">
	                    <xsl:for-each select="//ExternalData/Organizations/Organization">
	                    <xsl:if test="$contractor_id = @id">
                        	<option selected="selected" value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:if>
                    	<xsl:if test="$contractor_id != @id">
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:if>
                        </xsl:for-each>
                        </xsl:if>                           
                        
                        <xsl:if test="0 = $contractor_id">                        
                        <option selected="selected">не  указан</option>
                        <xsl:for-each select="//ExternalData/Organizations/Organization"> 
                    	<xsl:if test="$contractor_id != @id">
    					<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:if> 
                        </xsl:for-each>    
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
    	<input type="hidden" name="action" value="contract-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>