﻿<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
    	<script>
    		<xsl:comment>
    			<![CDATA[
    			$(document).ready(function(){
    				$('#content').tinymce({
    					script_url: '/tinymce/tiny_mce.js',
    					theme: "advanced",
    					plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
    					
    					theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
					
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",
						
					theme_advanced_buttons3 : "insertdate,inserttime,preview,|,tablecontrols,|,hr,removeformat,visualaid",
						
					theme_advanced_buttons4 : "sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,forecolor,backcolor",

					theme_advanced_buttons5 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",

					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					width : 400,
					height : 600,
						
					content_css: "/templates/1.css"
    				});
    			});
    			]]>
    		</xsl:comment>
    	</script>
            <xsl:apply-templates select="/StaticData"/>
    </xsl:template>
  
    
    <xsl:template match="StaticData">
    	<div id="adminpanel-content">
    	<form name="staticdataform" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="4">Редактирование статического элемента</th>
    		</thead>
    		<tr>
    			<td class="first"></td>
    			<td width="150">Идентификатор</td>
    			<td><xsl:value-of disable-output-escaping = "yes" select="@id" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr class="even">
    			<td class="first"></td>
    			<td>Название</td>
    			<td><input type="text" name="name" value="{@name}"/></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td>Группа</td>
    			<td>
    				<select name="group_id">
    					<option value="0">Вне групп</option>
    				</select>
    			</td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td>XSL шаблон</td>
    			<td>
    				<textarea name="content" id="content" style="width: 600px; height: 400px;">
    					<xsl:value-of disable-output-escaping = "yes" select="Content" />
    				</textarea>
    			</td>
    			<td class="last"></td>
    		</tr>
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
    	<input type="hidden" name="action" value="static-data-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>