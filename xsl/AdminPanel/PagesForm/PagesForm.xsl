<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
		<xsl:apply-templates select="/PageForm"/>
    </xsl:template>
    
    <xsl:template match="PageForm">
		<xsl:apply-templates select="PageElement"/>
    </xsl:template>  
    
    <xsl:template match="PageElement">
   
    	<div id="adminpanel-content">
    	<form name="name" id="ajaxform" action="." method="POST">
    	
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="4">Редактирование элементов</th>
    		</thead>
    		
    		<tr>
    			<td class="first"></td>
    			<td >Тип элемента</td>
    			<td width = "60%">
    				<xsl:if test="1 = @content-type">
    					<input type="radio" checked="checked" name="content-type" value="1" size = "5000" /> Статический элемент <br/>
    				</xsl:if>
    			
    				<xsl:if test="1 != @content-type">
    					<input type="radio" name="content-type" value="1" onclick='this.form.submit()' size = "5000"/> Статический элемент <br/>
    				</xsl:if>
    			
    				<xsl:if test="2 = @content-type">
    					<input type="radio" checked="checked" name="content-type" value="2" size = "5000"/> Динамический элемент <br/>
    				</xsl:if>
    			
    				<xsl:if test="2 != @content-type">
    					<input type="radio" name="content-type" value="2" onclick='this.form.submit()' size = "5000"/> Динамический элемент <br/>
    				</xsl:if>
    			
    			</td>
    			<td class="last"></td>
    		</tr>
    		
    		<xsl:if test="2 = @content-type">
    		<tr>
    			<td class="first"></td>
    			<td>Наименование элемента</td>
    			<td>    			
    				<select name="content_id">    					
	                    <xsl:for-each select="//PageElement/DynamicDataList/DynamicData">                    	
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:for-each>
    				</select>
    			</td>
    			
    			<td class="last"></td>
    		</tr> 
    		</xsl:if>
    		
    		<xsl:if test="1 = @content-type">
    		<tr>
    			<td class="first"></td>
    			<td>Наименование шаблона</td>
    			<td>    			
    				<select name="content_id">    	
    					<option value="0" selected="selected">- Укажите наименование шаблона -</option>				
	                    <xsl:for-each select="//PageElement/StaticDataList/StaticData">                    	
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:for-each>
    				</select>
    			</td>
    			
    			<td class="last"></td>
    		</tr> 
    		</xsl:if>
    		
    		<tr>
    			<td class="first"></td>
    			<td >Соответствующая страница</td>
    			<td width = "60%">
    				<xsl:if test="0 = @page-type">
    					<input type="radio" checked="checked" name="page-type" value="0" size = "5000" /> Новая страница <br/>
    				</xsl:if>
    			
    				<xsl:if test="0 != @page-type">
    					<input type="radio" name="page-type" value="0" onclick='this.form.submit()' size = "5000"/> Новая страница <br/>
    				</xsl:if>
    			
    				<xsl:if test="1 = @page-type">
    					<input type="radio" checked="checked" name="page-type" value="1" size = "5000"/> Существующая страница <br/>
    				</xsl:if>
    			
    				<xsl:if test="1 != @page-type">
    					<input type="radio" name="page-type" value="1" onclick='this.form.submit()' size = "5000"/> Существующая страница <br/>
    				</xsl:if>
    			
    			</td>
    			<td class="last"></td>
    		</tr>
    		
    		<xsl:if test="1 = @page-type">    		
    		<tr>
    			<td class="first"></td>
    			<td>Соответствующая страница</td>
    			<td>
    				<select name="page_id">  
    					<option value="0" selected="selected">- Укажите страницу -</option>	  					
	                    <xsl:for-each select="//PagesTable/PageTable">                    	
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                        </xsl:for-each>
    				</select>
				</td>
    			<td class="last"></td>
    		</tr>
    		</xsl:if>
    		
    		<xsl:if test="0 = @page-type"> 
    		<tr class="even">
    			<td class="first"></td>
    			<td>PARENT</td>
    			<td><input type="text" name="page_parent"/></td>
    			<td class="last"></td>
    		</tr>   		
    		<tr class="even">
    			<td class="first"></td>
    			<td>Наименование</td>
    			<td><input type="text" name="page_name"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>url</td>
    			<td><input type="text" name="page_url"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>Наименование шаблона</td>
    			<td><input type="text" name="page_template"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>ID меню</td>
    			<td><input type="text" name="page_menu_id"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>Отображение</td>
    			<td><input type="checkbox" name="page_show" value = "1"/>Отображать в меню</td>
    			<td class="last"></td>
    		</tr>
    		</xsl:if>
    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="saveandexit" value="Сохранить" /><input type="submit" name="saveandedit" value="Применить" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
		</table>
    	
    	<input type="hidden" name="action" value="page-form-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>