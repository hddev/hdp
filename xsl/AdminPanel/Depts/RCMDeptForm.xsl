<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/RCMDept"/>
    </xsl:template>
  
    
    <xsl:template match="RCMDept">
    	<div id="adminpanel-content">
    	<form name="RCMDeptForm" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    	    <thead>
			<th colspan="4">Редактирование задолжности пользователя</th>
    	    </thead>
            <tr class="even">
    			<td class="first"></td>
    			<td width="150">Идентификатор</td>
    			<td><xsl:value-of disable-output-escaping = "yes" select="@id" /></td>
    			<td class="last"></td>
    	    </tr>
    	     <tr>
    			<td class="first"></td>
    			<td>Студент</td>
    			<td><xsl:value-of disable-output-escaping = "yes" select="@secondname" /></td>
    			<td class="last"></td>
    		</tr> 
    		<tr>
    			<td class="first"></td>
    			<td>Группа</td>
    			<td><xsl:value-of disable-output-escaping = "yes" select="@group_title" /></td>
    			<td class="last"></td>
    		</tr>
    		 <tr>
    			<td class="first"></td>
    			<td>Курс</td>
    			<td><xsl:value-of disable-output-escaping = "yes" select="@course_title" /></td>
    			<td class="last"></td>
    		</tr> 
    		 <tr>
    			<td class="first"></td>
    			<td>Тест</td>
    			<td><xsl:value-of disable-output-escaping = "yes" select="@test_title" /></td>
    			<td class="last"></td>
    		</tr>   
    		 <tr>
    			<td class="first"></td>
    			<td>Ссылка на реферат</td>
    			<td>
	    			<xsl:if test="@name != ''">
	    				<a href='{@filepath}'><xsl:value-of disable-output-escaping = "yes" select = "@name" /></a>
	    			</xsl:if>
	    		</td>
    			<td class="last"></td>
    		</tr>        	
            <tr>
    			<td class="first"></td>
    			<td>Добавить попытки</td>
    			<td><input type="text" size="3" name="attempts" value="{@attempts}"/></td>
    			<td class="last"></td>
    		</tr>    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="exit" value="Отмена" /><input type="submit" name="saveandexit" value="Сохранить" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="rcm-dept-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>