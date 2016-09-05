<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/Department"/>
    </xsl:template>
  
    
    <xsl:template match="Department">
    <xsl:variable name="id" select="@id" />
    	<div id="adminpanel-content">
    	<form name="DepartmentForm" id="ajaxform" action="." method="POST">
    	<input  name="id" type="hidden" value="{@id}" />
    	
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="4">Редактирование карточки подразделения</th>
    		</thead>
    		
    		<tr>
    			<td class="first"></td>
    			<td width="150">Наименование подразделения</td>
    			<td><input type="text" name="name" value="{@name}"/></td>
    			<td class="last"></td>
    		</tr>
    		
            <tr>
    			<td class="first"></td>
    			<td width="150">Краткое наименование подразделения</td>
    			<td><input type="text" name="short_name" value="{@short_name}"/></td>
    			<td class="last"></td>
    		</tr>
    		    		
    		<tr class="even">
    			<td class="first"></td>
    			<td>Описание</td>
    			<td><input type="text" name="description" value="{@description}"/></td>
    			<td class="last"></td>
    		</tr>
    		    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="exit" value="Отмена" /><input type="submit" name="saveandedit" value="Применить" /><input type="submit" name="saveandexit" value="Сохранить" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>    		
    	
			<input type="hidden" name="parent_type" value="{//Department/ParentData/@type}"/>

    		<xsl:variable name="type" select="//Department/ParentData/@type"/>
    		<xsl:if test="1=$type">
    			<input type="hidden" name="parent_id" value="{//Department/ParentData/Organization/@id}"/> 
    		</xsl:if>
    				
    		<xsl:if test="2=$type">
    			<input type="hidden" name="parent_id" value="{//Department/ParentData/Department/@id}"/> 
    		</xsl:if>    			
    		    		
    	</table>
    	<input type="hidden" name="action" value="department-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>