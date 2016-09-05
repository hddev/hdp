<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
            <xsl:apply-templates select="/Users"/>
    </xsl:template>
    
    <xsl:template match="Users">
    	<xsl:variable name="id" select="//Users/ExternalData/Request/@id" />
    	<div id="adminpanel-content" class="request-card request-card-font" style="width:600px">
    	
    	<form name="staticdata" id="ajaxform" action="/requests/?type=inwork&amp;category=inwork" method="POST">
    	<input type="hidden" name="action" value="request-choose-executors" />
    	
    	<input type="hidden" name="id" value="{$id}" />
    	
    	<!-- <table cellspacing="0" cellpadding="0" border="0">  -->
        <br/>
    	<table cellspacing="2" cellpadding="1" border="0" class="r-table-ex">
    		<thead>
    			<th class="first"></th>
    			<th>
    				&#160;
    			</th>
    							
    			<th>
    				Список исполнителей&#160;
    			<!--	<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a> -->
    			</th>
    			
    			<th class="last"></th>
    		</thead>
            <tr><td>&#160;</td>
            <xsl:apply-templates select="User"/>
            </tr>
            <tr>
    			<td class="first"></td>
    			<td colspan="6" align="right">
    			<!-- <a href="/admin/admin-ajax/?action=user-form&amp;id=0" class="remote-url"><img src="/images/iicons/add.png" alt="Создать нового пользователя" title="Создать нового пользователя"/></a>&#160;
                <a href="/admin/admin-ajax/?action=user-delete&amp;id={@id}" class="remote-url"><img src="/images/iicons/cross.png" alt="Удалить пользователя" title="Удалить пользователя"/></a>  -->
    			</td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td colspan="6" class="table-seporater"></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="6" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<!-- <input type="hidden" name="action" value="users-list" /> -->
    	<!--<input type="hidden" name="page" value="{//Pagination/@page}" />-->
    	
    	<br/><center>
    	<input type="submit" name="cancel" class="send remote-url" value="&lt;&#160;Отмена" />
    	&#160;&#160;&#160;
    	<input type="submit" name="saveandexit" class="send remote-url" value="Отправить&#160;&gt;" />
    	</center><br/>
    	
    	</form>
    	</div>
    </xsl:template>
    
    <xsl:template match="User">  
    	<xsl:if test = "(218 !=@id)">
      		<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td><input type="checkbox" name="staticdata[{@id}]" value="1" /></td>			
    		<td><xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@firstname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@patronymic" /></td>
    		<td class="last"></td>
    	</tr>
      	</xsl:if>
    	
    </xsl:template> 
    
</xsl:stylesheet>