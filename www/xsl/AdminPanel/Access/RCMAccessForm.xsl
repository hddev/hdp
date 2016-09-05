<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
      	<xsl:apply-templates select="/RCMAccess"/>
  
	   <script language="JavaScript">
			$(".datetimepickerEx").datetimepicker({
				dateFormat: 'yy-mm-dd',
				timeFormat: 'hh:mm:ss'
			});	
		</script>
    </xsl:template>
    
    <xsl:template match="RCMAccess">
       	<div id="adminpanel-content">
       	<xsl:variable name="course_id" select="@course_id" />
       	<xsl:variable name="access_id_type" select="@access_id_type" />
       	<xsl:variable name="access_id" select="@access_id" />
    	<form name="RCMTestInfoForm" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<input type="hidden" name="access_id_type" value="{@access_id_type}" />
        <table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="4">Редактирование параметров доступа</th>
    		</thead>
            <tr>
    			<td class="first"></td>
    			<td width="150">Курс</td>
    			<td>
    				<select name="course_id">
					<xsl:for-each select="//RCMCourses/RCMCourse">
					    <xsl:if test="$course_id = @id">
						<option selected="selected" value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@title" /></option>
					    </xsl:if>
					    <xsl:if test="$course_id != @id">
					        <option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@title" /></option>
					    </xsl:if>
					</xsl:for-each>
	    			</select>
	    		</td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td width="150"><xsl:if test="$access_id_type = 0">Группа</xsl:if>
    			<xsl:if test="$access_id_type = 1">Студент</xsl:if></td>
    			<td> 
    				<select name="access_id">
    				<xsl:if test="$access_id_type = 0">
						<xsl:for-each select="//ExternalData/RCMStudentsGroups/RCMStudentsGroup">
						    <xsl:if test="$access_id = @id">
							<option selected="selected" value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@title" /></option>
						    </xsl:if>
						    <xsl:if test="$access_id != @id">
						        <option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@title" /></option>
						    </xsl:if>
						</xsl:for-each>
					</xsl:if>
					<xsl:if test="$access_id_type = 1">
						<xsl:for-each select="//ExternalData/RCMStudents/RCMStudent">
						    <xsl:variable name="user_id" select="@user_id" />
							<xsl:if test="$access_id = @id">
							<option selected="selected" value="{@id}">
							<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/Users/User[@id = $user_id]/@secondname" />&#160;
							<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/Users/User[@id = $user_id]/@firstname" />&#160;
							<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/Users/User[@id = $user_id]/@patronymic" />
							</option>
						    </xsl:if>
						    <xsl:if test="$access_id != @id">
						        <option value="{@id}">
						        <xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/Users/User[@id = $user_id]/@secondname" />&#160;
						        <xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/Users/User[@id = $user_id]/@firstname" />&#160;
								<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/Users/User[@id = $user_id]/@patronymic" />
							</option>
						    </xsl:if>
						</xsl:for-each>
					</xsl:if>
	    			</select></td>
	    		<td class="last"></td>
	    	</tr>
	    	<tr class="even">
    			<td class="first"></td>
    			<td>Дата начала</td>
    			<td><input type="text" name="start_date" class="datetimepickerEx" value="{@start_date}" size="30"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr class="even">
    			<td class="first"></td>
    			<td>Дата окончания</td>
    			<td><input type="text" name="end_date" class="datetimepickerEx" value="{@end_date}" size="30"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="exit" value="Отмена" /><input type="submit" name="save" value="Сохранить" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="rcm-access-save" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>