<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
		<!-- <xsl:apply-templates select="/Routes"/>  -->
		
		<div id="adminpanel-content">
    	<form name="dynamicdataform" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="10">Редактирование распределяющих по направлениям деятельности</th>
    		</thead>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Наименование маршрута</td>
    			<td>
    			
    			<select name="route_id">
    				<xsl:for-each select="//Routes/Route">
    					<xsl:if test = "7 = @id">
    						<option selected="selected" value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@route_name" /></option>
    					</xsl:if>
    					
    					<xsl:if test = "7 != @id">
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@route_name" /></option>
    					</xsl:if>
    				</xsl:for-each>
    			</select>
    				
    			</td>
    			<td class="last"></td>
    		</tr> 
    		
    		<tr class="even">
    			<td class="first"></td>
    			<td>Список пользователей</td>
    			<td>
    				<xsl:for-each select="//Routes/ExternalData/Users/User">
    					<input type="checkbox" name="staticdata[{@id}]" value="1" />
    					<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@firstname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@patronymic" />
    					<br/>
    				</xsl:for-each>
    			</td>
    			<td class="last"></td>
    		</tr>    		
    		    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="saveandedit" value="Сохранить" /></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="route-resposible-edit" />
    	</form>
    	</div>
    
    </xsl:template>
    
    <!-- 
    <xsl:template match="Routes">
    
    	<div id="adminpanel-content">
    	<form name="dynamicdataform" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="10">Редактирование распределяющих по направлениям деятельности</th>
    		</thead>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Наименование маршрута</td>
    			<td>
    				<xsl:for-each select="/Route">
    				12
    				</xsl:for-each>
    			</td>
    			<td class="last"></td>
    		</tr> 
    		
    		<tr class="even">
    			<td class="first"></td>
    			<td>Список пользователей</td>
    			<td>
    				<xsl:for-each select="//ExternalData/Users/User">
    				12
    				</xsl:for-each>
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
    	<input type="hidden" name="action" value="route-resposible-edit" />
    	</form>
    	</div>
    
    </xsl:template>
     -->
    
</xsl:stylesheet>