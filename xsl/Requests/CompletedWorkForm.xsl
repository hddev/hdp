<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">    
    	    
    	<script>
    	
    	$(function() {    				
			$( "#term" ).autocomplete({
				source: "/autocomplete/"
			});
		});
 
 		</script>
    
    	<xsl:variable name="temp">    	 
    		<xsl:if test="//CompletedWork/ExternalData/External/User/@id = //CompletedWork/@executor_id and //CompletedWork/ExternalData/External/Request/@status = '3'">true</xsl:if>
    	</xsl:variable>

    	<div class="request-card">
    		<xsl:apply-templates select="/CompletedWork">
    			<xsl:with-param name="edittrue" select="$temp"/>
    		</xsl:apply-templates>
    	</div>
    </xsl:template>
      
    <xsl:template match="CompletedWork">
    	<xsl:variable name="id" select="@id" />
    	
    	<xsl:variable name="allow_material" select="//ExternalData/External/RequestRoute/@allow_material" />
    	
    	<xsl:variable name="edittrue">
    		<xsl:if test="//CompletedWork/ExternalData/External/User/@id = //CompletedWork/@executor_id and //CompletedWork/ExternalData/External/Request/@status = '3'">true</xsl:if>    		
    	</xsl:variable>
    	
    	<div id="container">
    		<form name="CompletedWorkForm" id="ajaxform" action="/requests/" method="POST">
    			<input  name="id" type="hidden" value="{@id}" />
    			<input type="hidden" name="status" value="{@status}"/>
    			
    			<div class="rc-title">Регистрация факта оказания услуги</div>
    	    		
    	<table cellspacing="2" cellpadding="1" border="0" class="table-general">
    		<tr>
    			<td class="cw-itemname">Запрос:</td>
    			<td>
    				<b><a href="/requests-ajax?action=request-form&amp;id={@request_id}" class="remote-url">Ссылка на запрос</a>
    				<input type="hidden" name="request_id" value="{@request_id}"/></b>   				
    			</td>
    		</tr>
    		
    		<tr>
    			<td class="cw-itemname">Договор:</td>
    			<td>
    				<xsl:for-each select="//ExternalData/External/Contract">
    					<xsl:value-of disable-output-escaping = "yes" select = "@name" />
    				</xsl:for-each>
    			</td>
    		</tr>    		
    		
    		<tr>
    			<td class="cw-itemname">Пункт договора:</td>
    			<td>
    				<xsl:variable name="default_service_id" select="@service_contract" />						
		            <xsl:if test="$edittrue = 'true'">
	    				<select name="service_contract">    
	    					<xsl:for-each select="//ExternalData/External/ContractServiceGroup">                    	
	    						<option value="{@id}" disabled = "disabled"><xsl:value-of disable-output-escaping = "yes" select = "@name"/></option>
	    						<xsl:variable name="servicegroup_id" select="@id" />
	    						<xsl:for-each select="//ExternalData/External/ContractServiceGroup/ContractServices/ContractService">    						
	    							<xsl:if test="$servicegroup_id = @servicegroup_id">    								
	    								<xsl:choose>
											<xsl:when test="$default_service_id = @id">
												<option value="{@id}" selected = "selected">&#160;&#160;<xsl:value-of disable-output-escaping = "yes" select = "@name"/></option>
											</xsl:when>
											<xsl:otherwise>
												<option value="{@id}">&#160;&#160;<xsl:value-of disable-output-escaping = "yes" select = "@name"/></option>
											</xsl:otherwise>
										</xsl:choose>
	
	    							</xsl:if>    							
	    						</xsl:for-each>
	                        </xsl:for-each>
	    				</select>
	    			</xsl:if>
	    			<xsl:if test="$edittrue != 'true'">
	    				<xsl:value-of disable-output-escaping = "yes" select = "//CompletedWork/ExternalData/External/ContractServiceGroup/ContractServices/ContractService[@id = $default_service_id]/@name"/>
	    			</xsl:if>
    			</td>
    		</tr>
    		
    		<tr>
    			<td class="cw-itemname">Исполнитель:</td>
    			<td>
    				<xsl:for-each select="//ExternalData/External/Executor">
    					<xsl:value-of disable-output-escaping = "yes" select = "@secondname" /> <xsl:text> </xsl:text> <xsl:value-of disable-output-escaping = "yes" select = "@firstname"/> <xsl:text> </xsl:text> <xsl:value-of disable-output-escaping = "yes" select = "@patronymic"/>
    				</xsl:for-each>
    				<input type="hidden" name="executor_id" value="{@executor_id}"/>
    			</td>
    		</tr>
    		
    		<tr>
    			<td class="cw-itemname">Окончание оказания услуг:</td>
    			<td>
    				<xsl:if test="$edittrue = 'true'">
    					<input type="date" name="date_start" value="{@date_start}" required="required"/><input type="time" name="time_start" value="{@time_start}" required="required"/>
    				</xsl:if>
    				<xsl:if test="$edittrue != 'true'">
    					<xsl:value-of disable-output-escaping = "yes" select = "@date_start" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@time_start" />
    				</xsl:if>
    			</td>
    		</tr>
    		
    		<tr>
    			<td class="cw-itemname">Продолжительность исполнения:</td>
    			<td>
    				<xsl:if test="$edittrue = 'true'">
    					<input type="text" name="period" value="{@period}"/> &#160; минут
    				</xsl:if>
    				<xsl:if test="$edittrue != 'true'">
    					<xsl:value-of disable-output-escaping = "yes" select = "@period" />&#160;минут
    				</xsl:if>
    			</td>
    		</tr>
    		
    		<xsl:if test="$allow_material = '1'">    		
    			<xsl:if test="$edittrue = 'true'">
    				<tr>
    					<td class="cw-itemname">Расходный материал:</td>
    					<td>
    						<input type="text" id="term" name="material" value="{//ExternalData/External/RequestMaterial/@material}" placeholder = "Расходный материал ..." style="width:70%" />&#160;
    						в количестве &#160; <input type="text" name="count" value="{//ExternalData/External/RequestMaterial/@count}" placeholder = "Количество ..." style="width:5%" />
    					</td>
    				</tr>
    			</xsl:if>
    				
    			<xsl:if test="$edittrue != 'true'">
    				<xsl:if test = "(//ExternalData/External/RequestMaterial)">
    					<tr>
    						<td class="cw-itemname">Расходный материал:</td>
    						<td>
    							<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/External/RequestMaterial/@material" />
    							&#160;в количестве &#160;<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/External/RequestMaterial/@count" /> 							
    						</td>
    					</tr>    
    				</xsl:if>    									
    			</xsl:if>    				
    		</xsl:if>
    		    		    		
    		<tr>
    			<td class="cw-itemname">Комментарий:</td>
    			<td>
    				<xsl:if test="$edittrue = 'true'">
    					<input type="text" name="comment" value="{@comment}" placeholder = "Комментарий ..." style="width:95%"  required="required"/>
    				</xsl:if>
    				<xsl:if test="$edittrue != 'true'">
    					<xsl:value-of disable-output-escaping = "yes" select = "@comment" />
    				</xsl:if>
    			</td>
    		</tr>
    		
    		<tr>
    			<td class="cw-itemname">    				
    			</td>
    			<td>
    			<!-- 	<xsl:variable name="knowmark" select="@knowmark" />	
    				<xsl:if test="$edittrue = 'true'">
    					<xsl:if test="$knowmark = '1'">
		            		<input name = "markknow" type="checkbox" checked = "checked"/> Добавить в базу знаний
		           		</xsl:if>
    			
    				 	<xsl:if test="$knowmark != '1'">
		            		<input name = "markknow" type="checkbox"/> Добавить в базу знаний
		            	</xsl:if>
    				</xsl:if>	
    				
    				<xsl:if test="$edittrue != 'true'">
    					<xsl:if test="$knowmark = '1'">
		            		<input name = "markknow" type="checkbox" checked = "checked" disabled="disabled"/> Добавить в базу знаний
		           		</xsl:if>
    			
    				 	<xsl:if test="$knowmark != '1'">
		            		<input name = "markknow" type="checkbox" disabled="disabled"/> Добавить в базу знаний
		            	</xsl:if>
    				</xsl:if>			
		           --> 
    			</td>
    		</tr>
    		
    	</table>
    	
    	<div style="border-top:1px solid #a1a1a1">
			<table cellspacing="3" cellpadding="3" border="0" align="center">
		    	<tr>
	    			<td><input type="submit" name="exit" class="back remote-url" value="&lt;&#160;Назад" /></td>
	    			<xsl:if test="$edittrue = 'true'">
	    				<td><input type="submit" name="obsolete" class="send remote-url" value="Аннулировать" /></td>
	    				<td><input type="submit" name="saveandexit" class="send remote-url" value="Отправить&#160;&gt;" /></td>
	    			</xsl:if>
	    		</tr>
	    	</table>
	    </div>
    	<input type="hidden" name="action" value="completedwork-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>