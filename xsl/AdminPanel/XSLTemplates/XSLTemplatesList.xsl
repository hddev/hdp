<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/XSLTemplates"/>
    </xsl:template>
    
    <xsl:template match="XSLTemplates">
    	<div id="adminpanel-content">
    	<form name="xsltemplates" id="ajaxform" action="." method="POST">
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th class="first"></th>
    			<th></th>
    			<th>
    				Название&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				Действия
    			</th>
    			<th class="last"></th>
    		</thead>
    		<xsl:apply-templates select="XSLDir"/>
    		<xsl:apply-templates select="XSLTemplate"/>
    		<tr>
    			<td class="first"></td>
    			<td colspan="5" align="right">
    			<xsl:if test="@itemdir != ''">
    				<a href="/admin/admin-ajax/?action=xsltemplates-list&amp;dir={@itemdir}/.." class="remote-url"><img src="/images/iicons/arrow_left.png" alt="Назад" title="Назад"/></a>
    			</xsl:if>
    			<a href="/admin/admin-ajax/?action=xsltemplate-form&amp;id=0" class="remote-url"><img src="/images/iicons/layout_add.png" alt="Создать XSL шаблон." title="Создать XSL шаблон."/></a>&#160;
    			<input type="image" src="/images/iicons/folder.png" name="xsltemplates_move" alt="Переместить выбранные XSL шаблоны." title="Переместить выбранные XSL шаблоны." style="ajaxsubmit" />&#160;
    			<input type="image" src="/images/iicons/cross.png" name="xsltemplates_delete" alt="Удалить выбранные XSL шаблоны." title="Удалить выбранные XSL шаблоны." style="ajaxsubmit" />
    			</td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="5" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="xsltemplates-list" />
    	<!--<input type="hidden" name="page" value="{//Pagination/@page}" />-->
    	</form>
    	</div>
    </xsl:template>
    
     <xsl:template match="XSLDir">
    	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td>
    		</td>
    		<td><a href='/admin/admin-ajax/?action=xsltemplates-list&amp;dir={@dir}' class='remote-url'><xsl:value-of disable-output-escaping = "yes" select = "@name" /></a></td>
    		<td></td>
    		<td class="last"></td>
    	</tr>
    </xsl:template>
    
    <xsl:template match="XSLTemplate">
    	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td>
    			<input type="checkbox" name="xsltemplates[{@id}]" value="1"/>
    		</td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@name" /></td>
    		<td>
    			<a href="/admin/admin-ajax/?action=xsltemplate-form&amp;path={@dir}" class="remote-url"><img src="/images/iicons/layout_edit.png" alt="Редактировать XSL шаблон." title="Редактировать XSL шаблон."/></a>&#160;
    			<a href="#"><img src="/images/iicons/layout_delete.png" alt="Удалить XSL шаблон." title="Удалить XSL шаблон."/></a>
    		</td>
    		<td class="last"></td>
    	</tr>
    </xsl:template>
    
   
    
</xsl:stylesheet>