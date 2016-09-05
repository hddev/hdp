<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/Users"/>
    </xsl:template>
    
    <xsl:variable name="CountPrivileges" />
    
    <xsl:template match="Users">
    	<div id="adminpanel-content">
    	<form name="staticdata" id="ajaxform" action="." method="POST">
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th class="first"></th>
    			<th style="text-align:center;">
    				#&#160;
    			</th>
    			<th style="text-align:center;">
    				Пользователь&#160;
    			</th>
    			<th style="text-align:center;">
    				Группа&#160;
    			</th>
    			<xsl:apply-templates select="//ExternalData/PrivilegesList/PrivilegeItem"/>
    			<th class="last"></th>
    		</thead>
    		<xsl:apply-templates select="User"/>
    		<tr>
    			<td class="bfirst"></td>
    			<xsl:variable name="countColumns" select="count(//ExternalData/PrivilegesList/PrivilegeItem)+5" />
    			<td colspan="{$countColumns}" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="users-list" />
    	<!--<input type="hidden" name="page" value="{//Pagination/@page}" />-->
    	</form>
    	</div>
    </xsl:template>
    
    <xsl:template match="PrivilegeItem">
     	<th style="text-align:center;">
			<xsl:value-of disable-output-escaping = "yes" select="@description" />
		</th>
    </xsl:template>
    
    <xsl:template match="User">
    	<xsl:variable name="group_id" select="@group_id" />  	
    	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td><input type="checkbox" name="staticdata[{@id}]" value="1"/></td>
			<td><xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@firstname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@patronymic" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/UsersGroups/UsersGroup[@id = $group_id]/@name" /></td>
    		<xsl:call-template name="for">
			    <xsl:with-param name="n" select="count(//ExternalData/PrivilegesList/PrivilegeItem)"/>
			    <xsl:with-param name="user_id" select="@id" />
			</xsl:call-template>
    		<td class="last"></td>
    	</tr>
    </xsl:template>
    
    <xsl:template name="for">
	  <xsl:param name="i" select="0"/>
	  <xsl:param name="n"/>
	   <xsl:param name="user_id"/>
	  	<xsl:if test="$i &lt; $n">
	  	<xsl:choose>
			<xsl:when test="//ExternalData/Privileges/Privilege[@access_id = $user_id]/@alias = (//ExternalData/PrivilegesList/PrivilegeItem[@index = $i]/@alias)">
				<td align="center"><a href="/admin/admin-ajax/?action=privilege-delete&amp;access_user_id={$user_id}&amp;access_alias={//ExternalData/PrivilegesList/PrivilegeItem[@index = $i]/@alias}" class="remote"><img src="/images/iicons/tick.png" name="tick" alt="Переместить выбранные XSL шаблоны." title="Переместить выбранные XSL шаблоны." style="ajaxsubmit" /></a></td>
			</xsl:when>
			<xsl:otherwise>
				<td align="center"><a href="/admin/admin-ajax/?action=privilege-add&amp;access_user_id={$user_id}&amp;access_alias={//ExternalData/PrivilegesList/PrivilegeItem[@index = $i]/@alias}" class="remote"><img src="/images/iicons/cross.png" name="xsltemplates_move" alt="Переместить выбранные XSL шаблоны." title="Переместить выбранные XSL шаблоны." style="ajaxsubmit" /></a></td>
			</xsl:otherwise>
		</xsl:choose>
	    <xsl:call-template name="for">
	      <xsl:with-param name="i" select="$i + 1"/>
	      <xsl:with-param name="n" select="$n"/>
	       <xsl:with-param name="user_id" select="$user_id"/>
	    </xsl:call-template>
	  </xsl:if>
	</xsl:template>
    
</xsl:stylesheet>