<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
 	 <xsl:template match="/">
    	<xsl:variable name="temp">
    		<xsl:if test="//CompletedWork/ExternalData/External/User/@id = //CompletedWork/@executor_id and //CompletedWork/ExternalData/External/Request/@status = '3'">true</xsl:if>
    		<!-- <xsl:if test="(//CompletedWork/ExternalData/External/User/@id != //CompletedWork/@executor_id) or (//CompletedWork/ExternalData/External/Request/@status != 3)">
    			false
    		</xsl:if> -->
    	</xsl:variable>

    	<div class="request-card">
    		<xsl:apply-templates select="/CompletedWork">
    			<xsl:with-param name="edittrue" select="$temp"/>
    		</xsl:apply-templates>
    	</div>
    </xsl:template>
	
	<xsl:template match="CompletedWork">
	
		<xsl:variable name="allow_material" select="//ExternalData/External/RequestRoute/@allow_material" />	
			
		<script>
 		$(function() {   
			$('[id *= "term"]').each(function() {
				var target = $(this);
   				target.autocomplete({
    				source: "/autocomplete/"
    			});	
    		});			
		});
 		
		function addAutocomplete(id) {
			$('#term-' + id).autocomplete({
    				source: "/autocomplete/"
    			});	
		}
		
		$(function() {		
   			$('[id *= "datepicker"]').each(function() {
   				$(this).datepicker({
    				showOtherMonths: true,
    		 		selectOtherMonths: true
    			});	
    		});
  		});
  		
  		function addDatePicker(id) {
			$('#datepicker-' + id).datepicker({
    				showOtherMonths: true,
    		 		selectOtherMonths: true
    			});	
		}
		
		function addInput() { 
 			var id = document.getElementById("works-count").value;
  			id++;
  			
  			$('#append').before(function() {
  				return '<div id="div-' + id + '">
  			<div style="border-top:1px solid #a1a1a1">
  			
  			<!-- <input name="input-' + id + '" id="input-' + id + '" value="' + id + '"/>   -->
  			
			<table cellspacing="2" cellpadding="1" border="0" class="table-general">
    			<tr>
    				<td class="cw-itemname">Пункт договора:</td>
    				<td>
    					<select name="service_contract-' + id + '" required="required">
                            <option value="" selected = "selected"></option>
	    					<xsl:for-each select="//CompletedWork/ExternalData/External/ContractServiceGroup">                    	
	    					<option value="{@id}" disabled = "disabled"><xsl:value-of disable-output-escaping = "yes" select = "@name"/></option>
	    					<xsl:variable name="servicegroup_id" select="@id" />
	    					<xsl:variable name="default_service_id1" select="//CompletedWork/@service_contract" />	
	    						<xsl:for-each select="//ExternalData/External/ContractServiceGroup/ContractServices/ContractService">    						
	    							<xsl:if test="$servicegroup_id = @servicegroup_id">    								
	    								<xsl:choose>
											<xsl:when test="$default_service_id1 = @id">
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
    				</td>
    			</tr>
    		
    			<tr>
    				<td class="cw-itemname">Окончание оказания услуг:</td>
    				<td>
    					<!-- <a href="javascript:{}" onclick="addDatePicker(\'' + id + '\')">  
    						<input type="text" id="datepicker-' + id + '"/>
    					</a> -->				
    					<input type="date" name="date_start-' + id + '" value="{@date_start}" required="required"/><input type="time" name="time_start-' + id + '" value="{@time_start}" required="required"/>
	   				</td>
    			</tr>
    		
    			<tr>
    				
    				<td class="cw-itemname">Продолжительность исполнения:</td>
    				<td>
    					<input type="text" name="period-' + id + '" required="required" /> &#160;<font>минут</font>
    				</td>
    			</tr>
    			
    			<xsl:if test="$allow_material = '1'">
    				<tr>
    					<td class="cw-itemname">Расходный материал:</td>
    					<td>
    						<input type="text" id="term-' + id + '" onfocus="addAutocomplete('+id+')" name="material-' + id + '" style="width:70%"/>
    						<font> в количестве </font>
    						<input type="text" name="count-' + id + '" style="width:5%"/>
    					</td>
    				</tr>
    			</xsl:if>
    		
    			<tr>
    				<td class="cw-itemname">Комментарий:</td>
    				<td>
    					<input type="text" name="comment-' + id + '" placeholder = "Комментарий ..." style="width:95%"/>
    				</td>
    			</tr> 
    			    			    			
    			<tr>
    				<td class="cw-itemname"><a href="javascript:{}" onclick="removeInput(\'' + id + '\')">Удалить</a></td>
    				<td></td>
    			</tr>   		
    		</table>  			
  				
  			</div></div>';
			});
  			
  			document.getElementById("works-count").value = id;			
		}
		    	
		function removeInput(id) {
			$("#div-" + id).remove();
		}
		</script>	
		
		<xsl:variable name="id" select="@id" />
    	
    	<xsl:variable name="edittrue">
    		<xsl:if test="//CompletedWork/ExternalData/External/User/@id = //CompletedWork/@executor_id and //CompletedWork/ExternalData/External/Request/@status = '3'">true</xsl:if>
    		<!-- <xsl:if test="(//CompletedWork/ExternalData/External/User/@id != //CompletedWork/@executor_id) or (//CompletedWork/ExternalData/External/Request/@status != 3)">
    			false
    		</xsl:if> -->
    	</xsl:variable>
	
		<div id="container">
    		<form name="testform" id="ajaxform" action="/requests/" method="POST">
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
	    				<select name="service_contract" width="100px" required="required">
                            <option value="" selected = "selected"></option>
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
    			<!-- <input type="text" id="datepicker"/>  -->
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
    					<input type="text" name="period" value="" required="required" /> &#160; минут
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
    						<input type="text" id="term" name="material" placeholder = "Расходный материал ..." style="width:70%" />
    						в количестве
    						<input type="text" name="count" placeholder = "Количество ..." style="width:5%" />
    					</td>
    				</tr>
    			</xsl:if>
    				
    			<xsl:if test="$edittrue != 'true'">
    				<xsl:if test = "(//ExternalData/External/RequestMaterial)">
    					<tr>
    						<td class="cw-itemname">Расходный материал:</td>
    						<td>
    							<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/External/RequestMaterial/@material" />  
    							&#160;количество - &#160;<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/External/RequestMaterial/@count" />  							
    						</td>
    					</tr>    
    				</xsl:if>    									
    			</xsl:if>    				
    		</xsl:if>    		    		
    		    		    		
    		<tr>
    			<td class="cw-itemname">Комментарий:</td>
    			<td>
    				<xsl:if test="$edittrue = 'true'">
    					<input type="text" name="comment" value="{@comment}" placeholder = "Комментарий ..." style="width:95%" />
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
    	
    	<xsl:if test="$edittrue = 'true'">
    	
    	 <div id="append"></div>
    	
    	<div>
    		<table cellspacing="3" cellpadding="3" border="0" align="center">
			
				<tr>
					<td colspan="3"	align="center">
						<input type="hidden" name="works-count" id="works-count" value="0"/>
						<a href="javascript:{}" onclick="addInput()" style="font-weight:normal;border-bottom:1px dashed #000;font-size: 14px;text-decoration:none">
						<img src="/images/iicons/add.png" alt="" title=""/>
						Добавить выполненную работу</a><br/>
					</td>
				</tr>
			</table>
    	</div>
    	</xsl:if>
    	
    	<div style="border-top:1px solid #a1a1a1">
			<table cellspacing="3" cellpadding="3" border="0" align="center">
						
		    	<tr>
	    			<td><input type="submit" name="exit" class="back remote-url" formnovalidate="formnovalidate" value="&lt;&#160;Назад" /></td>
	    			<xsl:if test="$edittrue = 'true'">
	    				<td><input type="submit" name="obsolete" class="send remote-url" value="Аннулировать" /></td>
	    				<td><input type="submit" name="saveandexit" class="send remote-url" value="Отправить&#160;&gt;" /></td>
	    			</xsl:if>
	    		</tr>
	    		
	    	</table>
	    </div>
    	<input type="hidden" name="action" value="completedwork-multi-edit" />
    	</form>
    	</div>		
		
		</xsl:template> 
					 
</xsl:stylesheet>
	