<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
    	<script>
    		<xsl:comment>
    			<![CDATA[
    			$(document).ready(function(){
    				$('#Content').tinymce({
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
        <div id="adminpanel-content">
    	<form name="RCMMaterialPartData" id="ajaxform" action="." method="POST">
    		<input type="hidden" name="action" value="rcm-materials-list" />    	
    	</form>
    	</div>
    </xsl:template>         
</xsl:stylesheet>