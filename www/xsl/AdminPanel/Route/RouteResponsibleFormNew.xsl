<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
	
		<style>
  			h1 { padding: .2em; margin: 0; }
 			#products { float:left; width: 500px; margin-right: 2em; } 			
 			#cart { float:left; width: 500px; margin-right: 2em; }
  			#cart ol { margin: 0; padding: 1em 0 1em 3em; }
  			#products ol:hover {
    background: #f3bd48; /* Цвет фона при наведении */
    color: #fff; /* Цвет текста при наведении */
   }
  		</style>
  		
  		<script>
			$(function() {
				$( "#catalog" ).accordion();
   				$( "#catalog ol" ).draggable({
      			appendTo: "body",
      			helper: "clone"
   			});
   			
   			$( "#cart ol" ).droppable({
      			activeClass: "ui-state-default",
     			hoverClass: "ui-state-hover",
				accept: ":not(.ui-sortable-helper)",
      			drop: function( event, ui ) {
       				$( this ).find( ".placeholder" ).remove();
        			$( "<ol></ol>" ).text( ui.draggable.text() ).appendTo( this );
     			}
    		}).sortable({
      			items: "li:not(.placeholder)",
      			sort: function() {
		        $( this ).removeClass( "ui-state-default" );
      				}
    			});
  			});
  		</script>
		
		<div id="adminpanel-content">
    	<form name="dynamicdataform" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="10">Редактирование распределяющих по направлениям деятельности</th>
    		</thead>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Наименование маршрута</td>
    			<td>
    			
    			<select name="route_id">
    				<xsl:for-each select="//Routes/Route">
    					<xsl:if test = "7 = @id">
    						<option selected="selected" value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@route_name" /></option>
    					</xsl:if>
    					
    					<xsl:if test = "7 != @id">
    						<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@route_name" /></option>
    					</xsl:if>
    				</xsl:for-each>
    			</select>
    				
    			</td>
    			<td class="last"></td>
    		</tr> 
    		
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	
    	<div id="products">
  			
 			<div id="catalog"> 			
    		<h2>
    		<a onClick='$( "#table-users" ).toggle( "highlight", "", 500 );' style="border-bottom:1px dashed #000;">
    		Список пользователей</a>
    		</h2>
   			<div id = "table-users">
     		<ul align="left">
       		
       		<xsl:for-each select="//Routes/ExternalData/Users/User">
       		<ol>
    			<!-- <input type="checkbox" name="staticdata[{@id}]" value="1" />  -->
    			
    			<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
       			<xsl:value-of disable-output-escaping = "yes" select = "@firstname" />&#160;
       			<xsl:value-of disable-output-escaping = "yes" select = "@patronymic" />
    			
    		</ol>
	   		</xsl:for-each>       		
      		
     		</ul>
    		</div>
    		</div>
		</div>
		
		<div id="cart">
		<h2 class="ui-widget-header">Список распределяющих</h2>
		<div class="ui-widget-content">
		<ol>
		
		</ol>
		</div>
		</div>

    	<input type="hidden" name="action" value="new-route-resposible-edit" />
    	</form>
    	</div>
    
    </xsl:template>    
        
</xsl:stylesheet>