<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
    	
    	<script type='text/javascript' language='javascript'>
    		//<![CDATA[
    		function getParameter(param) { 
  				var params = window.location.href.substr(1).split('&');
  				
  				for (var i = 0; i < params.length; i++) {
  					var p=params[i].split('=');
  					if (p[0] == param) {
  						return decodeURIComponent(p[1]);
  					}
  				}
			}			
			//]]>
    	</script>
    	     	
        <xsl:if test="not(/Requests/AutoReloadRequestsList)">
            <script type='text/javascript' language='javascript'>              	
                      	
                var g_bSearchIsActive = false;
                var g_bAutoReloadRequestsList = true;                         
                var g_sAutoReloadRequestsListHref = "/requests-ajax/?action=requests-list&amp;type=inwork&amp;category=inwork&amp;auto-reload-mode";

	            function AutoReloadList(parameters) {                	
                    if (g_bAutoReloadRequestsList) {                                                
                            $("#jquery_load").load(g_sAutoReloadRequestsListHref, parameters, HideAjaxLoader);                                                                              
                        }
                    }

            	 if (g_bAutoReloadRequestsList) setInterval("AutoReloadList()",10000);                    	
            </script>

        </xsl:if>
         
        <xsl:if test="(/Requests/AutoReloadAll)">
            <script type='text/javascript' language='javascript'>              	
                      	
                var g_bSearchIsActive = false;
                var g_bAutoReloadRequestsList = true;                         
                var g_sAutoReloadRequestsListHref = "/requests-ajax/?action=requests-list&amp;type=inwork&amp;category=all&amp;auto-reload-mode";

	            function AutoReloadList(parameters) {                	
                    if (g_bAutoReloadRequestsList) {                                                
                            $("#jquery_load").load(g_sAutoReloadRequestsListHref, parameters, HideAjaxLoader);                                                                              
                        }
                    }

            	 if (g_bAutoReloadRequestsList) setInterval("AutoReloadList()",10000);                    	
            </script>

        </xsl:if>
		  
        <script type="text/javascript">
            function ToggleVisibilitySearchTab(id) {
                var e = document.getElementById(id);
                if(e.style.display == '') {
                    e.style.display = 'none';
                    g_bSearchIsActive = false;
                    g_bAutoReloadRequestsList = true;
                } else {
                    e.style.display = '';
                    g_bSearchIsActive = true;
                    g_bAutoReloadRequestsList = false;
                }
            }
        </script>

    	<xsl:apply-templates select="/Requests"/>
    </xsl:template>
    
    <xsl:template match="Requests">
       <div id="container">

    	<form name="requestdata" id="ajaxform" action="/requests/" method="POST">
    	
    	<table style="width:100%" border="0" cellspacing="0" cellpadding="0">
    		<input type="hidden" id="category" name="category" value="{//UIView/@category}" />
    		<input type="hidden" id="rl_status" name="rl_status" value="{//Pagination/@rl_status}" />

            <!-- auto-reload-mode - параметр необходим для исключения запуска рекурсивного обновления контента в контенте -->
            <input type="hidden" id="auto-reload-mode" name="auto-reload-mode" value="" /> 

    		<xsl:variable name="category" select="//UIView/@category" />
    		<xsl:variable name="rl_status" select="//Pagination/@rl_status" />
    		<xsl:variable name="search" select="//Search/@query" />
    		
    		<tr>
    			<td style="vertical-align: top; " align="center" width="250px">
    				<div class="sub-request-menu-header"><table align="center" border="0" cellspacing="0" cellpadding="0"><tr height="30px"><td>Категории запросов</td></tr></table></div>
    				<div class="sub-request-menu">
    					<div class="empty-line">&#160;</div>  
    					    								
    						<div class="sub-request-menu-item">
    							<xsl:if test="//Requests/UIView/@category = 'inwork'">
    								<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    							</xsl:if>
     							<a href="/requests-ajax/?action=requests-list&amp;type=inwork&amp;category=inwork&amp;q={$search}&amp;auto-reload-mode"
                                   onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;type=inwork&amp;category=inwork&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">В работе</a>
    						</div>
    						
    						<div class="sub-request-menu-item">
    							<xsl:if test="//Requests/UIView/@category = 'oncontrol'">
    								<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    							</xsl:if>
     							<a href="/requests-ajax/?action=requests-list&amp;type=all&amp;category=oncontrol&amp;q={$search}&amp;auto-reload-mode"
                                   onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;type=inwork&amp;category=oncontrol&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">На контроле</a>
    						</div>
    						
    						<div class="sub-request-menu-item">
    						<xsl:if test="//Requests/UIView/@category = 'all'">
    								<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    							</xsl:if>
    							
    							 <!-- 
     							 <a href="/requests-ajax/?action=requests-list&amp;category=all&amp;q={$search}&amp;auto-reload-mode"
                                   onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;category=all&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">Все запросы</a>
    							  -->
    							     							
    							<a href="/requests-ajax/?action=requests-list&amp;category=all&amp;q={$search}&amp;auto-reload-mode"
                                   onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;category=all&amp;q={$search}&amp;auto-reload-mode';
                                   window.history.pushState
			(LoadContent('/requests-ajax?action=requests-list&amp;category=all&amp;auto-reload-mode', ''), null, '?action=requests-list&amp;category=all')" class="remote-url">Все запросы</a>
    						
    						    							
    						</div>  
    											
    					  <!--   					
    					<div class="sub-request-menu-item">
    						<xsl:if test="//Requests/UIView/@category = 'inwork'">
    							<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    						</xsl:if>
    						<a href="/requests-ajax/?action=requests-list&amp;type=inwork&amp;category=inwork&amp;q={$search}&amp;auto-reload-mode"
                               onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;type=inwork&amp;category=inwork&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">В работе</a>
    					</div>
    					
    					<div class="sub-request-menu-item">
    						<xsl:if test="//Requests/UIView/@category = 'approving'">
    							<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    						</xsl:if>
    						<a href="/requests-ajax/?action=requests-list&amp;rl_status=1&amp;category=approving&amp;q={$search}&amp;auto-reload-mode"
                               onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;rl_status=1&amp;category=approving&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">На согласовании</a>
    					</div>
    					
    					<div class="sub-request-menu-item">
    						<xsl:if test="//Requests/UIView/@category = 'signing'">
    							<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    						</xsl:if>
    						<a href="/requests-ajax/?action=requests-list&amp;rl_status=10&amp;category=signing&amp;q={$search}&amp;auto-reload-mode"
                               onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;rl_status=10&amp;category=signing&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">На подтверждении</a>
    					</div>
    					
    					<div class="sub-request-menu-item">
    						<xsl:if test="//Requests/UIView/@category = 'done'">
    							<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    						</xsl:if>
    						<a href="/requests-ajax/?action=requests-list&amp;rl_status=4&amp;category=done&amp;q={$search}&amp;auto-reload-mode"
                                onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;rl_status=4&amp;category=done&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">Выполненные</a>
    					</div>
    					
    					<div class="sub-request-menu-item">
    						<xsl:if test="//Requests/UIView/@category = 'all'">
    							<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    						</xsl:if>
    						<a href="/requests-ajax/?action=requests-list&amp;category=all&amp;q={$search}&amp;auto-reload-mode"
                               onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;category=all&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">Все запросы</a>
    					</div>
    					 -->
					
 						<xsl:if test="(//Requests/CurrentUserGroup/@sname = 'ADMINS') or (//Requests/CurrentUserGroup/@sname = 'CONTROLERS') or (//Requests/CurrentUserGroup/@sname = 'MANAGERS')"><div style="hiegth:1px; border-top:1px solid #a1a1a1;margin:15px 15px"/></xsl:if>
 						<xsl:if test="(//Requests/CurrentUserGroup/@sname = 'ADMINS') or (//Requests/CurrentUserGroup/@sname = 'CONTROLERS') or (//Requests/CurrentUserGroup/@sname = 'MANAGERS')" >	
    						<!-- <div style="hiegth:1px; border-top:1px solid #a1a1a1;margin:15px 15px"/>  -->
    						<div class="sub-request-menu-item">
    							<xsl:if test="//Requests/UIView/@category = 'extreme'">
    								<xsl:attribute name="class">sub-request-menu-item-active</xsl:attribute>
    							</xsl:if>
    							<a href="/requests-ajax/?action=requests-list&amp;type=all&amp;category=extreme&amp;q={$search}&amp;auto-reload-mode"
                                   onclick="g_sAutoReloadRequestsListHref='/requests-ajax/?action=requests-list&amp;type=all&amp;category=extreme&amp;q={$search}&amp;auto-reload-mode';" class="remote-url">Полный список<b style="color:red">&#160;*</b></a>
    						</div>
    					</xsl:if>
    					
    					<!-- ДОБАВЛЯЕМ НОВЫЕ КАТЕГОРИИ -->
    					<xsl:if test="(//Requests/CurrentUserGroup/@sname = 'TESTERS')">
    						category = <xsl:value-of disable-output-escaping = "yes" select="UIView/@category"/>
    					</xsl:if>
    					<!-- ДОБАВЛЯЕМ НОВЫЕ КАТЕГОРИИ -->
    					
    					<br/>

    				</div>
					<!--<img id="newyear2014" src="/images/newyear2014.png" width="240px" style="z-index:-1;position:fixed;bottom:30px;left:10px"/>-->
					
    			</td>
    			<td valign="top" align="center">
    				<div class="requests-list-header">
    				<table height="30px"  align="center" border="0" cellspacing="0" cellpadding="0" class="table-request-info-header">
    				<tr class="table-request-info-header_tr">
    					<td class="table-request-info-header-td-empty">&#160;</td>
    					<td class="table-request-info-header-td-general">
    					
    						<xsl:if test = "$category = 'approving'">
    							<xsl:if test = "$rl_status != ''">
    							<a href="/requests-ajax/?action=requests-list&amp;orderby=id&amp;ordertype=DESC&amp;category={$category}&amp;rl_status={$rl_status}&amp;q={$search}" class="remote-url a_request_list_header">
    							Запрос 						
    							</a>
                                  
    							</xsl:if>
    						</xsl:if>
    						
    						<xsl:if test = "$category != 'approving'">
    							<a href="/requests-ajax/?action=requests-list&amp;orderby=id&amp;ordertype=DESC&amp;category={$category}&amp;q={$search}" class="remote-url a_request_list_header">
    							Запрос   					
    							</a>
    						</xsl:if>

                                &#160;
                                
                                <xsl:if test = "$search = ''">
                                	<input type="text" id="q" placeholder = "Найти ..." name="q" style="width:300px;display:none;"/>
                                </xsl:if>
                                
                                 <xsl:if test = "$search != ''">
                                	<input type="text" id="q" value = "{$search}" name="q" style="width:300px;"  />
                                </xsl:if>
                                
                                &#160;<a class="a_request_list_header" style="border-bottom:0px" onclick="
                                    if (document.getElementById('q').value == '') ToggleVisibilitySearchTab('q');
                                    if (g_bSearchIsActive) document.getElementById('q').focus();

                                    if(document.getElementById('q').value == '') return false;

                                    LoadContent('/requests-ajax/?action=requests-list&amp;page={@total_pages}&amp;type={@rl_type}&amp;rl_status={@rl_status}&amp;category={$category}&amp;auto-reload-mode&amp;q='+document.getElementById('q').value);
                                ">&#160;<img src="/images/iicons/magnifier.png" title="Поиск" /></a>
    					</td>
    					
    					<td class="table-request-info-header-td-prioritet">&#160;</td>
    					
    					<td class="table-request-info-header-td-status">
    					
    						<xsl:if test = "$category = 'inwork'">
    							Статус
    						</xsl:if>
    						
    						<xsl:if test = "$category != 'inwork'">   							
    							<a href="/requests-ajax/?action=requests-list&amp;orderby=status&amp;ordertype=DESC&amp;category={$category}&amp;rl_status={$rl_status}&amp;q={$search}" class="remote-url a_request_list_header">
    							Статус 						
    							</a>    							
    						</xsl:if>
    					    					
    					</td>
    					
    					<td class="table-request-info-header-td-date">
    					
    						<xsl:if test = "$category = 'approving'">
    							<xsl:if test = "$rl_status != ''">
    							<a href="/requests-ajax/?action=requests-list&amp;orderby=creation_date&amp;ordertype=DESC&amp;category={$category}&amp;rl_status={$rl_status}&amp;q={$search}" class="remote-url a_request_list_header">
    							Дата создания    						
    							</a>
    							</xsl:if>    						
    						</xsl:if>
    						
    						<xsl:if test = "$category != 'approving'">
    							<a href="/requests-ajax/?action=requests-list&amp;orderby=creation_date&amp;ordertype=DESC&amp;category={$category}&amp;q={$search}" class="remote-url a_request_list_header">
    							Дата создания   					
    							</a>
    						</xsl:if>		
    						
    					</td>
    					
    					<td class="table-request-info-header-td-update-date"> 
    					
    					<xsl:if test = "$category = 'approving'">
    						<xsl:if test = "$rl_status != ''">
    							<a href="/requests-ajax/?action=requests-list&amp;orderby=change_date&amp;ordertype=DESC&amp;category={$category}&amp;rl_status={$rl_status}&amp;q={$search}" class="remote-url a_request_list_header">
    							Дата обновления    						
    							</a>
    						</xsl:if>    						
    					</xsl:if>
    						
    					<xsl:if test = "$category != 'approving'">
    						<a href="/requests-ajax/?action=requests-list&amp;orderby=change_date&amp;ordertype=DESC&amp;category={$category}&amp;q={$search}" class="remote-url a_request_list_header">
    						Дата обновления    					
    						</a>
    					</xsl:if>  
    					  					
    					</td>
    						
    				</tr></table></div>
    				<div class="requests-list"><div class="div-requests-list">
    					<xsl:if test="not (//Requests/Request)">
    						<br/><p align="center">Нет запросов на оказание услуг ...</p><br/>
    					</xsl:if>
    					<xsl:apply-templates select="Request"/>
    				</div></div>
    				<xsl:if test="(//Requests/Request)">
	    				<div class="requests-list-pagination">
	    					<xsl:apply-templates select="Pagination"/>
	    				</div>
	    			</xsl:if>
    			</td>
    		</tr>    		
    	</table>
    	
       	<!--  <center>
    		<a href="/requests/?action=request-form&amp;id=0" class="remote-url"><img src="/images/iicons/add.png" alt="Создать новый запрос" title="Создать новый запрос"/></a>&#160;	
    	</center>  -->
    	<br/>
    	<input type="hidden" name="action" value="requests-list" />
    	<!--<input type="hidden" name="page" value="{//Pagination/@page}" />-->
    	</form>
    	</div>
    	
    </xsl:template>
    
    <xsl:template match="Request">
    	<xsl:variable name="request_id" select="@id" />    	
    	    	
    	<center>
    	<a onClick="
    	    g_bAutoReloadRequestsList = false;
    		window.history.pushState(LoadContent('/requests-ajax?action=request-form&amp;id={@id}', ''), null, '?action=request-form&amp;id={@id}')" style="text-decoration:none">
    	<div class="div-request-info-2">
    	<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">div-request-else</xsl:attribute>
    	</xsl:if>
    	
    	<xsl:if test="not (//Requests/ReadMarks/ReadMark[@request_id = $request_id]/@status = 1)">
    			<xsl:attribute name="class">div-request-unread</xsl:attribute>
    	</xsl:if>  
    	
    	<table border="0" cellspacing="0" cellpadding="0" class="table-request-info">
    		<tr>
    			<td class="td-empty">
    				<div class="icon-request">
    				<xsl:if test="0 = @status"><xsl:attribute name="style">background-color:#666666;</xsl:attribute></xsl:if><!-- Черновик -->  
    				<xsl:if test="0 = @status"><xsl:attribute name="title">Статус: "Черновик"</xsl:attribute></xsl:if><!-- Черновик -->
		    		
		    		<xsl:if test="1 = @status"><xsl:attribute name="style">background-color:#a9a700;</xsl:attribute></xsl:if><!-- Согласование -->
		    		<xsl:if test="1 = @status"><xsl:attribute name="title">Статус: "Согласование"</xsl:attribute></xsl:if><!-- Согласование -->		    		  
		    		
		    		<xsl:if test="6 = @status"><xsl:attribute name="style">background-color:#a9a700;</xsl:attribute></xsl:if><!-- Принятие в работу -->  
		    		<xsl:if test="6 = @status"><xsl:attribute name="title">Статус: "Принятие в работу"</xsl:attribute></xsl:if><!-- Принятие в работу -->
		    		
		    		<xsl:if test="2 = @status"><xsl:attribute name="style">background-color:#a9a700;</xsl:attribute></xsl:if><!-- Распределение -->  
		    		<xsl:if test="2 = @status"><xsl:attribute name="title">Статус: "Распределение"</xsl:attribute></xsl:if><!-- Распределение -->
		    		
		    		<xsl:if test="3 = @status"><xsl:attribute name="style">background-color:#005c00;</xsl:attribute></xsl:if><!-- Исполнение -->
		    		<xsl:if test="3 = @status"><xsl:attribute name="title">Статус: "Исполнение"</xsl:attribute></xsl:if><!-- Исполнение -->    
		    		
		    		<xsl:if test="7 = @status"><xsl:attribute name="style">background-color:#005c00;</xsl:attribute></xsl:if><!-- Подтверждение исполнителя -->  
		    		<xsl:if test="7 = @status"><xsl:attribute name="title">Статус: "Подтверждение исполнителя"</xsl:attribute></xsl:if><!-- Подтверждение исполнителя -->
		    		
		    		<xsl:if test="10 = @status"><xsl:attribute name="style">background-color:#900000;</xsl:attribute></xsl:if><!-- Подтверждение заказчика -->  
					<xsl:if test="10 = @status"><xsl:attribute name="title">Статус: "Подтверждение заказчика"</xsl:attribute></xsl:if><!-- Подтверждение заказчика -->
		    		
		    		<xsl:if test="5 = @status"><xsl:attribute name="style">background-color:#666666;</xsl:attribute></xsl:if><!-- Подтверждение заказчика -->  
					<xsl:if test="5 = @status"><xsl:attribute name="title">Статус: "Отклонен"</xsl:attribute></xsl:if><!-- Подтверждение заказчика -->
		    				    		
		    		<xsl:if test="4 = @status"><xsl:attribute name="style">background-color:#000000;</xsl:attribute></xsl:if><!-- Выполнено -->  
		    		<xsl:if test="4 = @status"><xsl:attribute name="title">Статус: "Выполнено"</xsl:attribute></xsl:if><!-- Выполнено -->
    				&#160;</div>
    			</td>
    			<td class="td-request-general" align="left">
    				<table border="0" cellspacing="0" cellpadding="0">
    					<tr>
    						<td class="td-request-atr-number">Запрос № <xsl:value-of disable-output-escaping = "yes" select = "@request_number" /></td>
    					</tr>
    					<tr>
    						<!-- Описание запроса-->
    						<td class="td-request-atr-text"><b>Содержание:&#160;</b>
    						<xsl:if test = "string-length(@requesttext)&gt;=150">
    							<xsl:value-of disable-output-escaping = "yes" select = "substring(@requesttext,1,150)" />...
    						</xsl:if>
    						
    						<xsl:if test = "string-length(@requesttext)&lt;150">
    							<xsl:value-of disable-output-escaping = "yes" select = "@requesttext" />
    						</xsl:if>

    						</td>
    					</tr>
						<tr>
    						<!-- Контактная информация -->
    						<td class="td-request-atr-author">
    						<b>Автор:&#160;</b>
    							 <xsl:value-of disable-output-escaping = "yes" select = "ExternalData/External/Author/@secondname" />&#160;
    							 <xsl:value-of disable-output-escaping = "yes" select = "ExternalData/External/Author/@firstname" />&#160;
    							 <xsl:value-of disable-output-escaping = "yes" select = "ExternalData/External/Author/@patronymic" />
    						<xsl:if test="'' != @phone">,&#160;<xsl:value-of disable-output-escaping = "yes" select = "@phone" /></xsl:if>
    						</td>
    					</tr>	
    				</table>
    			</td>
    			<td class="td-request-atr-prioritet" align="center">
    				<!-- <xsl:value-of disable-output-escaping = "yes" select = "ExternalData/External/Importance/@value" /> -->
    				
    				<!--<xsl:if test="//Requests/UnreadMarks/UnreadMark[@request_id = $request_id]/@status = 1">
    					<div class="icon-update" align="center" title="Имеется обновление информации в запросе">update</div>
    				</xsl:if>-->
    				<xsl:if test="ExternalData/External/Importance/@value = 'Критический'">
    					<div class="icon-hight-prioritet" align="center" title="Запрос с высоким приоритетом">! !</div>
    				</xsl:if>
                    <xsl:if test="not (//Requests/ReadMarks/ReadMark[@request_id = $request_id]/@status = 1)">
                        <div class="icon-new" align="center" title="Новый запрос">НОВЫЙ</div>
                    </xsl:if>
    			</td>
    			<td class="td-request-atr-status">
    				<xsl:if test="0 = @status"><div style="color:#666666"> Черновик </div></xsl:if>  
		    		<xsl:if test="1 = @status"><div style="color:#a9a700"> Согласование </div></xsl:if> 
		    		<xsl:if test="6 = @status"><div style="color:#a9a700"> Принятие в работу </div></xsl:if> 
		    		<xsl:if test="2 = @status"><div style="color:#a9a700"> Распределение </div></xsl:if> 
		    		<xsl:if test="3 = @status"><div style="color:#005c00"> Исполнение </div></xsl:if> 
		    		<xsl:if test="7 = @status"><div style="color:#005c00"> Подтверждение исполнителя </div></xsl:if> 
		    		<xsl:if test="10 = @status"><div style="color:#900000"> Подтверждение заказчика </div></xsl:if> 
		    		<xsl:if test="4 = @status"><div style="color:#000000"> Выполнено </div></xsl:if>
		    		<xsl:if test="5 = @status"><div style="color:#000000"> Отклонен </div></xsl:if>
	    		</td>
    			<td class="td-request-atr-creation-date"><xsl:value-of disable-output-escaping = "yes" select = "@creation_date" /></td>
    			<td class="td-request-atr-change-date"><xsl:value-of disable-output-escaping = "yes" select = "@change_date" /></td>
    		</tr>
    	</table>
    	</div>
    	
    	</a>
    	</center>
    	<!-- <input type="checkbox" name="staticdata[{@id}]" value="1" />  -->
    	
    </xsl:template>
    
    <xsl:template match="Pagination">
    	<xsl:variable name="per_page" select="@per_page" />
    	<xsl:variable name="page" select="@page" />
    	<xsl:variable name="prev_page" select="number(@page)-1" />
    	<xsl:variable name="next_page" select="number(@page)+1" />
    	<xsl:variable name="total_pages" select="@total_pages" />
    	<xsl:variable name="category" select="//Requests/UIView/@category" />
    	<xsl:variable name="search" select="//Requests/Search/@query" />
    	
    	<table cellspacing="0" cellpadding="0" border="0">
    	<tr>
    		
    		<td align="center">    		
    			
    		
    			<div class="pagination"><a href="/requests-ajax/?action=requests-list&amp;page=0&amp;type={@rl_type}&amp;rl_status={@rl_status}&amp;category={$category}&amp;q={$search}&amp;auto-reload-mode"
                                           onclick="g_bAutoReloadRequestsList = true;" id="page_prev_start" class="remote-url a-pagination">&lt;&lt;</a></div>
    			<xsl:if test="@page &gt; 0">
    				<div class="pagination">
                        <a href="/requests-ajax/?action=requests-list&amp;page={$prev_page}&amp;type={@rl_type}&amp;rl_status={@rl_status}&amp;category={$category}&amp;q={$search}&amp;auto-reload-mode"
                           onclick="g_bAutoReloadRequestsList = false;" id="page_prev" class="remote-url a-pagination">&lt;</a>
                    </div>
    			</xsl:if>
    		
    			<xsl:call-template name="PageElement">
    				<xsl:with-param name="i" select="0"/>
    				<xsl:with-param name="current" select="@page"/>
    				<xsl:with-param name="max" select="@total_pages"/>
    				<!--<xsl:with-param name="rlx_status" select="@rl_status"/>
    				<xsl:with-param name="rlx_type" select="@rl_type"/>-->
    			</xsl:call-template>

    			<xsl:if test="@page &lt; @total_pages">
    				<div class="pagination"><a href="/requests-ajax/?action=requests-list&amp;page={$next_page}&amp;type={@rl_type}&amp;rl_status={@rl_status}&amp;category={$category}&amp;q={$search}&amp;auto-reload-mode"
                                               onclick="g_bAutoReloadRequestsList = false;" id="page_next" class="remote-url a-pagination">&gt;</a></div>
    			</xsl:if>
    			<div class="pagination"><a href="/requests-ajax/?action=requests-list&amp;page={@total_pages}&amp;type={@rl_type}&amp;rl_status={@rl_status}&amp;category={$category}&amp;q={$search}&amp;auto-reload-mode"
                                           onclick="g_bAutoReloadRequestsList = false;" id="page_next_end" class="remote-url a-pagination">&gt;&gt;</a></div>
				
				<!-- <select name="per_page" id="per_page" onchange="this.form.submit();" style="float:left;font-size: 12px;">
					<option value="10"><xsl:if test="$per_page = 10"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>10</option>
    				<option value="20"><xsl:if test="$per_page = 20"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>20</option>
    				<option value="50"><xsl:if test="$per_page = 50"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>50</option>
    			</select> -->
    		</td>	
    		   		
    	</tr>
    	</table>
    	<input type="hidden" name="rl_status" id="rl_status" value="{@rl_status}"/>
    	<input type="hidden" name="type" id="type" value="{@rl_type}"/>

        <xsl:if test="@page = 0">
            <script type='text/javascript' language='javascript'>
                g_bAutoReloadRequestsList = true;
            </script>
        </xsl:if>        
        
       
        
    </xsl:template>
    
     <xsl:template name="PageElement">
    	<xsl:param name="i" />
    	<xsl:param name="current" />
    	<xsl:param name="max" />
    	<xsl:variable name="last_visible" select="number($current)+3"/>
    	<xsl:variable name="first_visible" select="number($current)-3"/>
    	<xsl:variable name="rlx_status" select="//Requests/Pagination/@rl_status"/>
    	<xsl:variable name="rlx_type" select="//Pagination/@rl_type"/>
    	<xsl:variable name="category" select="//Requests/UIView/@category" />
    	<xsl:variable name="search" select="//Requests/Search/@query" />
    	
    	<xsl:if test="$first_visible &gt; 0 and $i = $first_visible"><div class="pagination">...</div></xsl:if>
    	<xsl:if test="$i = 0 or $i = $max or ($i &gt; $first_visible and $i &lt; $last_visible)">
    		<div class="pagination"><xsl:if test="$i = $current"><xsl:attribute name="style">background-color: #e8641b;</xsl:attribute></xsl:if>
                <a href="/requests-ajax/?action=requests-list&amp;page={$i}&amp;type={$rlx_type}&amp;rl_status={$rlx_status}&amp;category={$category}&amp;q={$search}&amp;auto-reload-mode"
                   onclick="g_bAutoReloadRequestsList = false;" id="page{$i}" class="remote-url a-pagination">
                    <xsl:if test="$i = $current"><xsl:attribute name="style">font-weight: bold;</xsl:attribute></xsl:if>
                    <xsl:value-of disable-output-escaping = "yes" select="$i+1" />
    		    </a>
            </div>
    	</xsl:if>
    	<xsl:if test="$last_visible &lt; $max and $i = $last_visible"><div class="pagination">...</div></xsl:if>
    		<xsl:if test = "$i &lt; $max">
    			<xsl:call-template name="PageElement">
    				<xsl:with-param name="i" select="$i+1"/>
    				<xsl:with-param name="max" select="$max"/>
    				<xsl:with-param name="current" select="$current"/>
    				<!--<xsl:with-param name="rlx_status" select="$rlx_status"/>
    				<xsl:with-param name="rlx_type" select="$rlx_type"/>
    				<xsl:with-param name="search" select="$search"/>-->
    			</xsl:call-template>
    		</xsl:if>
    </xsl:template>
          
</xsl:stylesheet>