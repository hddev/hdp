<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
        <xsl:apply-templates select="/Notifications"/>                        
    </xsl:template>
    
    <xsl:template match="Notifications">
    	<xsl:apply-templates select="Notification"/> 
    </xsl:template>
    
    <xsl:template match="Notification">
       	<div id="adminpanel-content">
       	
       	<script>
       		function Notify(id, number, fio, text) {       		
       			var popupnotification = new Notification("Infotech Service Desk", {
    			body : "Поступил запрос № " + number + "\n"
    			+ "Автор: " + fio + "\n"
    			+ "Описание: " + text + "\n",
    			icon : "/images/logo/160-160.png",    		
				});
			popupnotification.onclick = function(){
				window.open("http://sd/requests/?action=request-form&amp;id=" + id);
			};
       		}
       	</script>	

		<script>
       		function NotifyUser(id, number, fio, text) {       			
       			if (!("Notification" in window)) {
   					return;
 				}
 									
 				Notification.requestPermission(function () { 						
 					Notify(id, number, fio, text);
 				});			
       		}
       	</script>
    	
    	<xsl:variable name="request_number" select="@request_number" />
    	<xsl:variable name="fio" select="@fio" />
    	<xsl:variable name="description" select="@requesttext" />    	
   	
    	<!-- 	
    	<script language = "javascript">
    		var popupnotification = new Notification("Поступил новый запрос " + <xsl:value-of disable-output-escaping = "yes" select = "@id" /> , {
    		body : "Поступил запрос № " + <xsl:value-of disable-output-escaping = "yes" select = "@id" /> + "\n"
    		+ "Автор \n"
    		+ "Описание: \n",
    		icon : "/images/logo/logo-sd-1.png",    		
			});
			popupnotification.onclick = function(){
				window.open("http://sd/requests/?action=request-form&amp;id=<xsl:value-of disable-output-escaping = "yes" select = "@id" />");
			};
    	</script> 
    	-->
    	
   		<script>
    	 	NotifyUser(<xsl:value-of disable-output-escaping = "yes" select="@id" />, "<xsl:value-of disable-output-escaping = "yes" select = "$request_number" />", "<xsl:value-of disable-output-escaping = "yes" select = "$fio" />", "<xsl:value-of disable-output-escaping = "yes" select = "$description" />");
    		<!--notifyUser();-->
    	</script>
    	    	    	    	
    	</div>
    </xsl:template>
          
</xsl:stylesheet>