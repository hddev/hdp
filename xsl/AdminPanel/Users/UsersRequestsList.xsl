<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/UsersRequests"/>
    </xsl:template>
    
    <xsl:template match="UsersRequests">
    	<div id="adminpanel-content">
    	<form name="staticdata" id="ajaxform" action="." method="POST">
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th class="first"></th>
    			<th>
    				&#160;
    			</th>
    			<th>
    				Пользователь&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				Ф.И.О.&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				Указанная группа&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				Дата добавления&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th class="last"></th>
    		</thead>
    		<xsl:apply-templates select="UsersRequest"/>
    		<tr>
    			<td class="first"></td>
    			<td colspan="6" align="right">
    			<select name="group_id">
    				<option selected="selected" value="0">Выберите группу</option>
    				<xsl:for-each select="//UsersRequests/ExternalData/RCMStudentsGroup">
						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@title" /></option>
					</xsl:for-each>
    			</select>
    			<input type="submit" name="add_students" value="Добавить" />
    			<input type="submit" name="del_requests" value="Удалить" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="6" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="users-editrequests" />
    	<!--<input type="hidden" name="page" value="{//Pagination/@page}" />//ExternalData/UsersGroups/UsersGroup[@id = $group_id]/@name-->
    	</form>
    	</div>
    </xsl:template>
    
    <xsl:template match="UsersRequest">
    	<xsl:variable name="group_id" select="@group_id" />
    	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td><input type="checkbox" name="checkarray[{@request_id}]" value="{@user_id}"/><xsl:value-of disable-output-escaping = "yes" select = "@index" /></td>
			<td><xsl:value-of disable-output-escaping = "yes" select = "@login" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@firstname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@patronymic" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@group_name" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@creation_date" /></td>
    		<td class="last"></td>
    	</tr>
    </xsl:template>
   
</xsl:stylesheet>