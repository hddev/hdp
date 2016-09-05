<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/Log"/>
    </xsl:template>
    
    <xsl:template match="Log">
    	<div id="adminpanel-content">
    	<form name="log" id="ajaxform" action="." method="POST">
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th class="first"></th>
    			<th></th>
    			<th>
    				#&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				Пользователь&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				Дата действия&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				Действие&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th>
    				IP&#160;
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    			</th>
    			<th class="last"></th>
    		</thead>
    		<xsl:apply-templates select="Action"/>
    		<!-- <tr>
    			<td class="first"></td>
    			<td colspan="5" align="right">
    			<a href="/admin/admin-ajax/?action=rcm-lection-form&amp;id=0" class="remote-url"><img src="/images/iicons/add.png" alt="Создать нового пользователя" title="Создать нового пользователя"/></a>&#160;
                <a href="/admin/admin-ajax/?action=rcm-lection-delete&amp;id={@id}" class="remote-url"><img src="/images/iicons/cross.png" alt="Удалить пользователя" title="Удалить пользователя"/></a>
    			</td>
    			<td class="last"></td>
    		</tr> -->
    		<xsl:apply-templates select="Pagination"/> 
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="6" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="log-list" />
    	<!--<input type="hidden" name="page" value="{//Pagination/@page}" />-->
    	</form>
    	</div>
    </xsl:template>
    
    <xsl:template match="Action">
    	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td>
    			<input type="checkbox" name="staticdata[{@id}]" value="1"/>
    		</td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@id" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@user_id" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@action_date" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@action_type" /></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@ip" /></td>
    		<td class="last"></td>
    	</tr>
    </xsl:template>
    
    <xsl:template match="Pagination">
    	<xsl:variable name="per_page" select="@per_page" />
    	<xsl:variable name="page" select="@page" />
    	<xsl:variable name="prev_page" select="number(@page)-1" />
    	<xsl:variable name="next_page" select="number(@page)+1" />
    	<xsl:variable name="total_pages" select="@total_pages" />
    	<tr>
    		<td class="first"></td>
    		<td colspan="6" align="right">
    			<div class="pagination"><a href="/admin/admin-ajax/?action=log-list&amp;page=0" id="page_prev_start" class="remote-post" style="text-decoration: none;">&lt;&lt;</a></div>
    			<xsl:if test="@page &gt; 0">
    				<div class="pagination"><a href="/admin/admin-ajax/?action=log-list&amp;page={$prev_page}" id="page_prev" class="remote-post" style="text-decoration: none;">&lt;</a></div>
    			</xsl:if>
    			<xsl:call-template name="page">
    				<xsl:with-param name="i" select="0"/>
    				<xsl:with-param name="current" select="@page"/>
    				<xsl:with-param name="max" select="@total_pages"/>
    			</xsl:call-template>
    			<xsl:if test="@page &lt; @total_pages">
    				<div class="pagination"><a href="/admin/admin-ajax/?action=log-list&amp;page={$next_page}" id="page_next" class="remote-post" style="text-decoration: none;">&gt;</a></div>
    			</xsl:if>
    			<div class="pagination"><a href="/admin/admin-ajax/?action=log-list&amp;page={@total_pages}" id="page_next_end" class="remote-post" style="text-decoration: none;">&gt;&gt;</a></div>
    			<select name="per_page" id="per_page" onchange="LoadContentWFormPost();">
    				<option value="1"><xsl:if test="$per_page = 1"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>1</option>
    				<option value="5"><xsl:if test="$per_page = 5"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>5</option>
    				<option value="10"><xsl:if test="$per_page = 10"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>10</option>
    				<option value="20"><xsl:if test="$per_page = 20"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>20</option>
    				<option value="30"><xsl:if test="$per_page = 30"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>30</option>
    				<option value="40"><xsl:if test="$per_page = 40"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>40</option>
    				<option value="50"><xsl:if test="$per_page = 50"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>50</option>
    				<option value="100"><xsl:if test="$per_page = 100"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>100</option>
    			</select>
    		</td>
    		<td class="last"></td>
    	</tr>
    </xsl:template>
    
    <xsl:template name="page">
    	<xsl:param name="i" />
    	<xsl:param name="current" />
    	<xsl:param name="max" />
    	<xsl:variable name="last_visible" select="number($current)+3"/>
    	<xsl:variable name="first_visible" select="number($current)-3"/>
    	
    	<xsl:if test="$first_visible &gt; 0 and $i = $first_visible"><div class="pagination">...</div></xsl:if>
    	<xsl:if test="$i = 0 or $i = $max or ($i &gt; $first_visible and $i &lt; $last_visible)">
    		<div class="pagination"><xsl:if test="$i = $current"><xsl:attribute name="style">background-color: #ccd74f;</xsl:attribute></xsl:if><a href="/admin/admin-ajax/?action=log-list&amp;page={$i}" id="page{$i}" class="remote-post">
    			<xsl:if test="$i = $current"><xsl:attribute name="style">font-weight: bold;</xsl:attribute></xsl:if>
    			<xsl:value-of disable-output-escaping = "yes" select="$i+1" />
    		</a></div>
    	</xsl:if>
    	<xsl:if test="$last_visible &lt; $max and $i = $last_visible"><div class="pagination">...</div></xsl:if>
    		<xsl:if test = "$i &lt; $max">
    			<xsl:call-template name="page">
    				<xsl:with-param name="i" select="$i+1"/>
    				<xsl:with-param name="max" select="$max"/>
    				<xsl:with-param name="current" select="$current"/>
    			</xsl:call-template>
    		</xsl:if>
    	
    </xsl:template>
    
</xsl:stylesheet>