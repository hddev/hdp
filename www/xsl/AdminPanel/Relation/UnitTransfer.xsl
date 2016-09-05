<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/Relation"/>
    </xsl:template>
    
    <xsl:template match="Relation">
    	<div id="adminpanel-content">    	
    	<form name="staticdata" id="ajaxform" action="." method="POST">
    	<input name = "source_id" type="hidden" value = "{@source_id}"/>
		<input name = "source_type" type="hidden" value = "{@source_type}"/>
    	<table cellspacing="0" cellpadding="0" border="0">
    	
    		<thead>
    			<th colspan="4">Перемещение</th>
    		</thead>
    	
    		<tr>
    			<td class="first"></td>
    			<td>Организация</td>
    			<td width = "60%">    			
    				<select name="parent_organization_id">   
    				<option value="0" selected="selected">Укажите организацию</option>	 					
	                    <xsl:for-each select="//ExternalData/Organizations/Organization">                    	
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:for-each>
    				</select>
    			</td>
    			
	   			<td class="last"></td>
    		</tr> 
    		
    		<tr class="even">
    			<td class="first"></td>
    			<td >Подразделение</td>
    			<td>    			
    				<select name="parent_department_id">    	
    					<option value="0" selected="selected">Укажите подразделение</option>				
	                    <xsl:for-each select="//ExternalData/Departments/Department">                    	
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:for-each>
    				</select>
    			</td>
    			
    			<td class="last"></td>
    		</tr> 
    		
   			 <tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="saveandexit" value="Сохранить" /></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="unit-transfer-edit" />
    	<!--<input type="hidden" name="page" value="{//Pagination/@page}" />//ExternalData/UsersGroups/UsersGroup[@id = $group_id]/@name-->
    	</form>
    	</div>
    </xsl:template>    
   
</xsl:stylesheet>