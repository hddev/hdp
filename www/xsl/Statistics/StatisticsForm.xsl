<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
                encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml"
                standalone="no"/>

    <xsl:template match="/">
        <xsl:apply-templates select="StatisticsForm"/>
    </xsl:template>

    <xsl:template match="StatisticsForm">
    	<script>
			$(function() {
				$( "#tabs" ).tabs({
					beforeLoad: function( event, ui ) {
						ui.jqXHR.fail(function() {
							ui.panel.html(
								"Не удальсь отобразить данные. Обратитесь в службу подержки. " +
								);
							});
 						}
					});
				});			
		</script>
		
		<script>
			function OnChange(){								
				var datestart = $('#datestart').val();
				var datefinish = $('#datefinish').val();
				var type = $('#type').val();
				var category = $('#category').val();
				
				if (datestart=='' || datefinish=='' || type=='' || type=='0' || category=='') {						 
					$('#apply-enabled').hide();	
					$('#apply-disabled').show();					 					   					
				}
				else {					
					$('#apply-enabled').show();	
					$('#apply-disabled').hide();
				}
			}
			
			function LoadResult(){
				var type = $('#type').val();
				var category = $('#category').val();
				var datestart = $('#datestart').val();
				var datefinish = $('#datefinish').val();
				
				var g_sStatResultHref = '/statistics-ajax/?action=statistics-retrieve&amp;type='+type+'&amp;category='+category+'&amp;date_start='+datestart+'&amp;date_finish='+datefinish;
			
				$("#statistics-result").load(g_sStatResultHref);
			}
		</script>
    
        <xsl:variable name="route_id" select="@category"></xsl:variable>

        <div class="request-card request-card-font">
           <!--  <form name="name" id="ajaxform" action="/statistics/" method="GET"> -->
                <br/>
                
                 <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <thead>
                        <th colspan="4">Тип отчета</th>
                    </thead>
                    
                    <tr>
                        <td class="first"></td>
                        <td width="150px" style="padding:5px" align="right">&#160;</td>
                        <td width="">

                            <select name="type" id="type" style="width:80%" required="required" onchange="OnChange();">                            
                            	<xsl:if test="0 = @type">
                            		<option value="0" selected="selected">--- Выберите тип отчета --- </option>
                               		<option value="1">Перечень выполненных работ</option>
                               		<option value="2">По расходным материалам</option>
                               		<option value="3">По общему количеству запросов</option>
                            	</xsl:if>
                            	
                            	<xsl:if test="1 = @type">                            	
                               		<option value="1" selected="selected">Перечень выполненных работ</option>
                               		<option value="2">По расходным материалам</option>
                               		<option value="3">По общему количеству запросов</option>
                            	</xsl:if>
                            	
                            	<xsl:if test="2 = @type">                            		
                               		<option value="1">Перечень выполненных работ</option>
                               		<option value="2" selected="selected">По расходным материалам</option>
                               		<option value="3">По общему количеству запросов</option>
                            	</xsl:if>
                            	
                            	<xsl:if test="3 = @type">                            		
                               		<option value="1">Перечень выполненных работ</option>
                               		<option value="2">По расходным материалам</option>
                               		<option value="3" selected="selected">По общему количеству запросов</option>
                            	</xsl:if>
                            	
                            </select>
                            
                        </td>
                        <td class="last"></td>
                    </tr>
                    
				</table>
                
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                   <!--  <thead>
                        <th colspan="4">Перечень выполненных работ</th>
                    </thead>  -->

                    <tr>
                        <td class="first"></td>
                        <td colspan="2">
                            &#160;
                        </td>
                        <td class="last"></td>
                    </tr>

                    <tr>
                        <td class="first"></td>
                        <td width="150px" style="padding:5px" align="right">Категория&#160;</td>
                        <td width="">

                            <select name="category" id="category" style="width:80%" required="required"  onchange='OnChange()'>
                                <option value="7" >Все</option>
                                <xsl:for-each select="Routers/Routes/Route">
                                    <xsl:if test = "$route_id = @id">
                                        <option value="{@id}" selected="selected">
                                            <xsl:value-of disable-output-escaping="yes" select="@route_name"/>
                                        </option>
                                    </xsl:if>
                                    <xsl:if test = "$route_id != @id">
                                        <option value="{@id}">
                                            <xsl:value-of disable-output-escaping="yes" select="@route_name"/>
                                        </option>
                                    </xsl:if>
                                </xsl:for-each>
                            </select>
                        </td>
                        <td class="last"></td>
                    </tr>
                    
                    <tr>
                        <td class="first"></td>
                        <td align="right"  style="padding:5px">Период с&#160;</td>
                        <td>
                            <input type="date" name="date_start" id="datestart" value="{@date_start}" required="required"  onchange='OnChange()'/>
                            &#160;по&#160;
                            <input type="date" name="date_finish" id="datefinish" value="{@date_finish}" required="required"  onchange='OnChange()'/>
                        </td>
                        <td class="last"></td>
                    </tr>

                    <tr>
                        <td class="first"></td>
                        <td colspan="2">
                            &#160;
                        </td>
                        <td class="last"></td>
                    </tr>

                    <tr>
                        <td class="bfirst"></td>
                        <td colspan="2" class="bbottom"></td>
                        <td class="blast"></td>
                    </tr>
                </table>
                
                <div id="apply-disabled" style="border-top:1px solid #a1a1a1; text-align:center;padding:5px">
                    <input type="button" disabled="disabled" name="apply-disabled" align="center" value="Получить сведения" class="apply-statistics-disabled"/>
                </div>
                
                <a onclick="LoadResult();">
                <div id="apply-enabled" style="border-top:1px solid #a1a1a1; text-align:center;padding:5px; display:none">
                    <input type="button" name="apply-enabled" align="center" value="Получить сведения" class="apply-statistics-enabled"/>
                </div>
                </a>
                
                <input type="hidden" name="action" value="statistics-retrieve"/>
          <!-- </form>  -->
        </div>
        <br/>
        <xsl:apply-templates select="StatisticsData"/>
        
        <div id="statistics-result"></div>

    </xsl:template>

    
</xsl:stylesheet>