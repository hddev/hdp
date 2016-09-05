<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/User"/>
    </xsl:template>
  
    
    <xsl:template match="User">
    <xsl:variable name="group_id" select="@group_id" />
    	<div id="adminpanel-content">
    	<form name="UserForm" id="ajaxform" action="." method="POST">
    	<input  name="id" type="hidden" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="4">Редактирование карточки пользователя</th>
    		</thead>
            <tr>
    			<td class="first"></td>
    			<td width="150">Логин</td>
    			<td><input type="text" name="login" value="{@login}"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td width="150">Пароль</td>
    			<td><input type="password" name="password" value=""/></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td width="150">Подключен</td>
    			<td>
    			<xsl:if test="@connected = '1'">
    				<input type="checkbox" name="connected" checked="checked"/>
    			</xsl:if>
    			<xsl:if test="@connected = '0'">
    				<input type="checkbox" name="connected"/>
    			</xsl:if>
    			</td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>Имя</td>
    			<td><input type="text" name="firstname" value="{@firstname}"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>Фамилия</td>
    			<td><input type="text" name="secondname" value="{@secondname}"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>Отчество</td>
    			<td><input type="text" name="patronymic" value="{@patronymic}"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>E-mail</td>
    			<td><input type="text" name="email" value="{@email}"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>Группа</td>
    			<td>
    				<select name="group_id">
	                    <xsl:for-each select="//ExternalData/UsersGroups/UsersGroup">
	                    <xsl:if test="$group_id = @id">
                        	<option selected="selected" value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:if>
                    	<xsl:if test="$group_id != @id">
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:if>
                        </xsl:for-each>
    				</select>
    			</td>
    			<td class="last"></td>
    		</tr>    		    		
    		
    		<input type="hidden" name="parent_type" value="{//ParentData/@type}"/>  
    		  				
			<xsl:variable name="type" select="//ParentData/@type"/>
    		<xsl:if test="1=$type">
    			<input type="hidden" name="parent_id" value="{//ParentData/Organization/@id}"/> 
    		</xsl:if>
    				
    		<xsl:if test="2=$type">
    			<input type="hidden" name="parent_id" value="{//ParentData/Department/@id}"/> 
    		</xsl:if>
    		    		
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
    	</table>
    	<input type="hidden" name="action" value="user-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>