<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
        <style>
            label, input { display:block; }
            input.text { margin-bottom:12px; width:95%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:25px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            
            /* раскрывающийся список jquery*/
			.box {
				width: auto;
				margin: 10px auto;
				background: #fff;
				border: 1px solid #d1d1d1;
				padding: 4px;
				font-family: Georgia, Helvetica, sans-serif;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				-moz-box-shadow: 0px 0px 10px #ddd;
				-webkit-box-shadow: 0px 0px 10px #ddd;
			}
			
			input.category {
				width: 99%;
				//-moz-border-radius: 5px;
				//-webkit-border-radius: 5px;
				background: -moz-linear-gradient(center top, #efefef 0%,#e0e0e0 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #efefef),color-stop(1, #e0e0e0));
				padding: 5px;				
				border: 1px solid #d1d1d1;				
				font-size: 13px;
				font-weight: normal;
				text-shadow: 1px 1px 0px #fff;
				margin:0;
			}
			
			input.button {
				width: 100%;
				//-moz-border-radius: 5px;
				//-webkit-border-radius: 5px;
				background: -moz-linear-gradient(center top, #efefef 0%,#e0e0e0 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #efefef),color-stop(1, #e0e0e0));
				padding: 5px;				
				border: 1px solid #d1d1d1;				
				font-size: 13px;
				font-weight: normal;
				text-shadow: 1px 1px 0px #fff;
				margin:0;
			}					
				
			ul {
			//	width:expression(document.body.getelementbyid("offset-width").offsetWidth);
				padding: 5px;
				overflow: hidden;
				margin:0;	
				padding: 0; 
				position: fixed;					
			}
	
			ul li {
				width:100%;
				font-size: 13px;				
				//list-style-position: inside;
				color: #a1a1a1;
				padding: 1px;
				list-style-type: none;		
				display: block;			
			}
			
			li:hover {
				background-color:#F7F8E0;
			}
			
			 li a {
    			display: block; /* Ссылка как блочный элемент */
    		//	padding: 5px; /* Поля вокруг надписи */
    			text-decoration: none; /* Подчеркивание у ссылок убираем */
    			color: #666; /* Цвет текста */
    		//	border: 1px solid #ccc;/* Рамка вокруг пунктов меню */
    			background-color: #F8FBEF; /* Цвет фона */
   			}
   
   			li a:hover {
    			color: #ffe; /* Цвет текста активного пункта */
    			background-color: #5488af; /* Цвет фона активного пункта */
   			}   
	
			/* раскрывающийся список jquery*/

            #tooltip {
                z-index: 3000;
                border: 1px solid #111;
                background-color: #eee;
                padding: 5px;
                opacity: 0.85;
            }
            #tooltip h3, #tooltip div { margin: 0; }

  			.custom-combobox {
				position: relative;
				display: inline-block;
				width: 100%;
			}
			.custom-combobox-toggle {
				position: absolute;
				top: 0;
				bottom: 0;
				margin-left: -1px;
				padding: 0;
			}
			.custom-combobox-input {
				margin: 0;					
				width: 95%;			
			}
		</style>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$("ul").hide();
				$("ul li:odd").css("background-color", "#efefef");
				$("ul li:even").css("background-color", "#e0e0e0");
				$("#select_button").click(function(){
					$("#route_list").slideToggle();
				});
			});
		</script>
				
        <script>

            var v1 = "", v2 = "", tmp = "";

            $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#requirement-form" ).dialog({
                    autoOpen: false,
                    height: 300,
                    width: 400,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

             $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#requirement-dialog" ).dialog({
                    autoOpen: false,
                    height: 300,
                    width: 400,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

            function LoadContentByURL(href) {
                var arr_mci_tmp = arr_mci;
                var arr_msi_tmp = arr_msi;
                $('#ajaxloader').show();
                $('#jquery_load').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        ExtraToggleForMCI(arr_mci_tmp);
                        ExtraToggleForMSI(arr_msi_tmp);
                    });
                return false;
            }

            function QueryByURL(href) {
                $('#ajaxloader').show();
                $('#jquery_status').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        $( "#jquery_status" ).fadeIn();
                        setTimeout(function() {
                            $( "#jquery_status" ).fadeOut();
                        }, 1000 );
                    });
                return false;
            }

            function validateForm(){
                $.validity.start();
                // Required.
                $("#position").require();
                $("#quantity").require();
                var result = $.validity.end();
                return result.valid;
            }
        </script>

        <script>
            var v1 = "", v2 = "", tmp = "";

            $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#satisfaction-form" ).dialog({
                    autoOpen: false,
                    height: 500,
                    width: 500,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

             $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#satisfaction-dialog" ).dialog({
                    autoOpen: false,
                    height: 500,
                    width: 500,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

            function LoadContentByURL(href) {
                var arr_mci_tmp = arr_mci;
                var arr_msi_tmp = arr_msi;
                $('#ajaxloader').show();
                $('#jquery_load').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        ExtraToggleForMCI(arr_mci_tmp);
                        ExtraToggleForMSI(arr_msi_tmp);
                    });
                return false;
            }

            function QueryByURL(href) {
                $('#ajaxloader').show();
                $('#jquery_status').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        $( "#jquery_status" ).fadeIn();
                        setTimeout(function() {
                            $( "#jquery_status" ).fadeOut();
                        }, 1000 );
                    });
                return false;
            }

            function validateForm(){
                $.validity.start();
                // Required.
                $("#position").require();
                $("#quantity").require();
                var result = $.validity.end();
                return result.valid;
            }
        </script>

        <script>

            $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#defect-form" ).dialog({
                    autoOpen: false,
                    height: 500,
                    width: 800,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

             $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#defect-dialog" ).dialog({
                    autoOpen: false,
                    height: 500,
                    width: 500,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

            function LoadContentByURL(href) {
                var arr_mci_tmp = arr_mci;
                var arr_msi_tmp = arr_msi;
                $('#ajaxloader').show();
                $('#jquery_load').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        ExtraToggleForMCI(arr_mci_tmp);
                        ExtraToggleForMSI(arr_msi_tmp);
                    });
                return false;
            }

            function QueryByURL(href) {
                $('#ajaxloader').show();
                $('#jquery_status').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        $( "#jquery_status" ).fadeIn();
                        setTimeout(function() {
                            $( "#jquery_status" ).fadeOut();
                        }, 1000 );
                    });
                return false;
            }

            function validateForm(){
                $.validity.start();
                // Required.
                $("#position").require();
                $("#quantity").require();
                var result = $.validity.end();
                return result.valid;
            }
        </script>

        <script>

            $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#chat-form" ).dialog({
                    autoOpen: false,
                    width: 800,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

             $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#defect-dialog" ).dialog({
                    autoOpen: false,
                    height: 500,
                    width: 500,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

            function LoadContentByURL(href) {
                var arr_mci_tmp = arr_mci;
                var arr_msi_tmp = arr_msi;
                $('#ajaxloader').show();
                $('#jquery_load').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        ExtraToggleForMCI(arr_mci_tmp);
                        ExtraToggleForMSI(arr_msi_tmp);
                    });
                return false;
            }

            function QueryByURL(href) {
                $('#ajaxloader').show();
                $('#jquery_status').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        $( "#jquery_status" ).fadeIn();
                        setTimeout(function() {
                            $( "#jquery_status" ).fadeOut();
                        }, 1000 );
                    });
                return false;
            }

            function validateForm(){
                $.validity.start();
                // Required.
                $("#position").require();
                $("#quantity").require();
                var result = $.validity.end();
                return result.valid;
            }
        </script>

        <script>

            $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#receipt-form" ).dialog({
                    autoOpen: false,
                    height: 300,
                    width: 500,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }

                });
            });

             $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#receipt-dialog" ).dialog({
                    autoOpen: false,
                    height: 500,
                    width: 500,
                    modal: true,

                    buttons: {

                        "Отмена": function() {
                            $( this ).dialog( "close" );
                        }
                    },

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

            function LoadContentByURL(href) {
                var arr_mci_tmp = arr_mci;
                var arr_msi_tmp = arr_msi;
                $('#ajaxloader').show();
                $('#jquery_load').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        ExtraToggleForMCI(arr_mci_tmp);
                        ExtraToggleForMSI(arr_msi_tmp);
                    });
                return false;
            }

            function QueryByURL(href) {
                $('#ajaxloader').show();
                $('#jquery_status').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        $( "#jquery_status" ).fadeIn();
                        setTimeout(function() {
                            $( "#jquery_status" ).fadeOut();
                        }, 1000 );
                    });
                return false;
            }

            function validateForm(){
                $.validity.start();
                // Required.
                $("#position").require();
                $("#quantity").require();
                var result = $.validity.end();
                return result.valid;
            }
        </script>

        <script>

            var v1 = "", v2 = "";

            $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                 var receipt = $( "#receipt" );

                $( "#dialog-form" ).dialog({
                    autoOpen: false,
                    height: 510,
                    width: 500,
                    modal: true,
                    buttons: {
                        "Ok": function() {
                            var href = "/requests-ajax/?action=receipt-edit&amp;receipt=" + encodeURIComponent(receipt.val()) +"&amp;" +
                                "request_id=" + <xsl:value-of disable-output-escaping = "yes" select = "Request/@id" />;

                            window.open(href, '_blank');
                            $( this ).dialog( "close" );
                            return false;
                        },
                        "Отмена": function() {
                            $( this ).dialog( "close" );
                        }
                    },
                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

            function LoadContentByURL(href) {
                var arr_mci_tmp = arr_mci;
                var arr_msi_tmp = arr_msi;
                $('#ajaxloader').show();
                $('#jquery_load').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        ExtraToggleForMCI(arr_mci_tmp);
                        ExtraToggleForMSI(arr_msi_tmp);
                    });
                return false;
            }

            function QueryByURL(href) {
                $('#ajaxloader').show();
                $('#jquery_status').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        $( "#jquery_status" ).fadeIn();
                        setTimeout(function() {
                            $( "#jquery_status" ).fadeOut();
                        }, 1000 );
                    });
                return false;
            }
        </script>

        <script>

            $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#decline-comment-form" ).dialog({
                    autoOpen: false,
                    height: 200,
                    width: 800,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

             $(function() {
                $( "#dialog:ui-dialog" ).dialog( "destroy" );

                    $( "#decline-comment-form" ).dialog({
                    autoOpen: false,
                    height: 300,
                    width: 500,
                    modal: true,

                    close: function() {
                        allFields.val( "" );
                    }
                });
            });

            function LoadContentByURL(href) {
                var arr_mci_tmp = arr_mci;
                var arr_msi_tmp = arr_msi;
                $('#ajaxloader').show();
                $('#jquery_load').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        ExtraToggleForMCI(arr_mci_tmp);
                        ExtraToggleForMSI(arr_msi_tmp);
                    });
                return false;
            }

            function QueryByURL(href) {
                $('#ajaxloader').show();
                $('#jquery_status').load(href,
                    function(){
                        $("#ajaxloader").hide();
                        $( "#jquery_status" ).fadeIn();
                        setTimeout(function() {
                            $( "#jquery_status" ).fadeOut();
                        }, 1000 );
                    });
                return false;
            }

            function validateForm(){
                $.validity.start();
                // Required.
                $("#position").require();
                $("#quantity").require();
                var result = $.validity.end();
                return result.valid;
            }
        </script>

        <script LANGUAGE="JavaScript" TYPE="text/javascript">
        function doMenu(AObjIndex) {
            var subObj = document.all['o:' + AObjIndex];
            //var imgObj = document.all['chapter_img' + AObjIndex];
             if ( subObj.style.display == 'none' ) {
                subObj.style.display = 'block';
                //imgObj.src = 'treeOpened.png';
            }
            else {
                subObj.style.display = 'none';
                //imgObj.src = 'treeClosed.png';
            }  // if..else
        }  // doMenu

        function doRequirementMenu(AObjIndex) {
            var subObj = document.all['r:' + AObjIndex];
            //var imgObj = document.all['chapter_img' + AObjIndex];
             if ( subObj.style.display == 'none' ) {
                subObj.style.display = 'block';
                //imgObj.src = 'treeOpened.png';
            }
            else {
                subObj.style.display = 'none';

                //imgObj.src = 'treeClosed.png';
            }  // if..else
        }  // doMenu

        function showEmail() {
            var subObj = document.all['email'];
             if ( subObj.style.display == 'none' ) {
                subObj.style.display = 'block';
            }
            else {
                subObj.style.display = 'none';
                subObj.value="";
            }
        }

        </script>
        
        
			
        <!--<div id="requirement-form" title="Создание потребности">
            <form action="/requests/" method="POST">
              	<fieldset title = "Создание потребности">
              		<table cellspacing="0" cellpadding="0" border="0" >
    					<thead>
    						<th colspan="5">Создание потребности<br/>
    						</th>
    					</thead>
    				<tr>
    					<td>Наименование позиции</td>
    					<td>
    					<input type="text" name="position" required = "required"/>
    					</td>
    				</tr>	
    				
    				<tr>
    					<td>Требуемое количество</td>
    					<td><input type="text" name="quantity" value="0" required="required"/></td>
    				</tr>	
    				
    				<tr>
    					<td>Код товара</td>
    					<td><input type="text" name="partnumber"/></td>
    				</tr>	
    			
    				<tr>
    					<td>&#160;</td>
    					<td> <input type="submit" name="saveandexit" value="Отправить" align="center" /></td>
    				</tr>	
    				
    				<input type="hidden" name="requestid" value="{Request/@id}" required="required"/>   				
    				    					
    				</table>
	            </fieldset>
	            <input type="hidden" name="action" value="requirement-edit" />
            </form>
        	</div> -->
        	
        <div id="satisfaction-form" title="Анкета удовлетворенности">
        		<form action="/requests/" method="POST">        			          
              		<fieldset title = "Оценка качества выполнения запроса">              	
              			<table  cellspacing="0" cellpadding="0" border="0" align="center">
    						<thead align="center">
    							<tr>
  									<td colspan = "11"> Оцените качество выполнения запроса </td>
  								</tr>
    						</thead>
    					
    						<tr height="50">
    							<td>Качество обслуживания</td>    							
    							<td>  						
    								<input type="radio" name="value1" value="1"/>													 					
    							</td>
    							<td>1</td>
    							<td>  						
    								<input type="radio" name="value1" value="2"/>  														 					
    							</td>
    							<td>2</td>
    							<td>  						
    								<input type="radio" name="value1" value="3"/>														 					
    							</td>
    							<td>3</td>
    							<td>  						
    								<input type="radio" name="value1" value="4"/>   														 					
    							</td>
    							<td>4</td>
    							<td>  						
    								<input type="radio" name="value1" value="5" checked="checked"/>													 					
    							</td>
    							<td>5</td>
    						</tr>	
    				
    						<tr height="50">
    							<td>Скорость обслуживания</td>
    							<td>  						
    								<input type="radio" name="value2" value="1"/>      														 					
    							</td>
    							<td>1</td>
    							<td>
    								<input type="radio" name="value2" value="2"/>  
    							</td>
    							<td>2</td>
    							<td>
    								<input type="radio" name="value2" value="3"/>  
    							</td>
    							<td>3</td>
    							<td>
    								<input type="radio" name="value2" value="4"/>  
    							</td>
    							<td>4</td>
    							<td>
    								<input type="radio" name="value2" value="5"  checked="checked"/>  
    							</td>
    							<td>5</td>
    						</tr>	
    				    				
    						<tr height="50">
    							<td>Эффективность</td>
    							<td>  						
    								<input type="radio" name="value3" value="1"/>     														 					
    							</td>
    							<td>1&#160;&#160;</td>
    							<td>
    								<input type="radio" name="value3" value="2"/> 
    							</td>
    							<td>
    								2&#160;&#160;
    							</td>
    							<td>
    								<input type="radio" name="value3" value="3"/> 
    							</td>
    							<td>
    								3&#160;&#160;
    							</td>
    							<td>
    								<input type="radio" name="value3" value="4"/> 
    							</td>
    							<td>
    								4&#160;&#160;
    							</td>
    							<td>
    								<input type="radio" name="value3" value="5"  checked="checked"/> 
    							</td>
    							<td>
    								5&#160;&#160;
    							</td>
    						</tr>
    				
    						<tr height="50">
    							<td></td>
    							<td colspan = "10">
    								
    								<textarea hidden = "hidden" align="center" name="comment" style="width:95%; height:150px;" rows="10">
    								</textarea>	
    							</td>    							
    						</tr>
    						
    						<tr height="20">
    						</tr>
    			
    						<tr> 											
    							<td colspan = "10" align="center"> 
    								<input type="submit" name="saveandexit" value="Отправить"  style = "width:150px;height:35px;padding:5px 15px; background:#e8641b;font-weight: bold;color:#fff;border:0 none;
    cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px;"/>
    							</td>
    						</tr>	
    						    						    				
    						<input type="hidden" name="requestid" value="{Request/@id}"/>   
    						<input type="hidden" name="authorid" value="{ExternalData/External/User/@id}"/>     				    					
    					</table>
	            	</fieldset>
	           		<input type="hidden" name="action" value="satisfaction-edit" />
        		</form>           		
        	</div> 
        	
        <!--<div id="defect-form"  title="Акт о дефектации">
        		<form action="/requests/" method="POST">        			          
              		           	
              			<table  cellspacing="0" cellpadding="0" border="0" width="100%">
    						<thead>
    							<th >
    															
    							</th>
    						</thead>
    						    						    					
    						<tr>
    							<td width="30%">Заказчик</td>
    							<td>  		
    								<textarea align="center" name="customer" style="width:95%; height:50px;" rows="4">
    								</textarea>	    								  														 					
    							</td>
    						</tr>	
    				
    						<tr>
    							<td>Наименование изделия</td>
    							<td>  						
    								<textarea align="center" name="object" style="width:95%; height:30px;" rows="4">
    								</textarea>			   														 					
    							</td>
    						</tr>	
    				    				
    						<tr>
    							<td>Инвентарный номер</td>
    							<td>
    								<textarea align="center" name="inventorynumber" style="width:95%; height:20px;" rows="4">
    								</textarea>	    								    														 					
    							</td>
    						</tr>
    						
    						<tr>
    							<td>Техническое состояние изделия</td>
    							<td> 
    								<textarea align="center" name="status" style="width:95%; height:20px;" rows="4">
    								</textarea>	    								   														 					
    							</td>
    						</tr>
    						
    						<tr>
    							<td>Возможность дальнейшего использования</td>
    							<td>  
    								<textarea align="center" name="furtheruse" style="width:95%; height:30px;" rows="4">
    								</textarea>								   														 					
    							</td>
    						</tr>
    						
    						<tr>
    							<td>Заключение</td>
    							<td>  						
    								<textarea align="center" name="conclusion" style="width:95%; height:50px;" rows="4">
    								</textarea>     														 					
    							</td>
    						</tr>
    				
    						<tr>
    							<td>Примечание</td>
    							<td>
    								<textarea align="center" name="comment" style="width:95%; height:50px;" rows="4">
    								</textarea>
								</td>
    						</tr>
    			
    						<tr>    	
    							<td></td>			
    							<td><input type="submit" name="saveandexit" value="Сформировать акт" class="send remote-url" /></td>
    						</tr>	
    				
    						<input type="hidden" name="request_id" value="{Request/@id}"/>   
    						<input type="hidden" name="author_id" value="{ExternalData/External/User/@id}"/>     				    					
    					</table>
	            	
	           		<input type="hidden" name="action" value="defect-edit" />
        		</form>           		
        	</div>-->
        	
        <!--<div id="receipt-form" title="Сохранная расписка">
        		<form action="/requests/" method="POST">
        			<table  cellspacing="0" cellpadding="0" border="0" width="100%">
    					<thead>
    						<th >
    														
    						</th>
    					</thead>
    						    						    					
    					<tr>
    						<td width="30%">Список средств для проведения диагностики</td>
    						<td>  		
    							<textarea align="center" name="receipt" style="width:95%; height:100px;" rows="4">
    							</textarea>	    								  														 					
    						</td>
    					</tr>	
    					
    					<tr>    	
    						<td></td>			
    						<td><input type="submit" name="saveandexit" value="Сформировать" class="send remote-url"/></td>
    					</tr>	
    					
    				</table>
    				
    				<input type="hidden" name="request_id" value="{Request/@id}"/>  
        			<input type="hidden" name="action" value="receipt-edit" />
        		
        		</form>        		
        	</div>-->
        	
        <!--<div id="dialog-form" title="Сохранная расписка">
            <form action="/requests/" method="POST">
              	<fieldset>
	            	<table  cellspacing="0" cellpadding="0" border="0" width="100%">
    					<thead>
    						<th >
    														
    						</th>
    					</thead>
    						    						    					
    					<tr>
    						<td width="30%">Список средств для проведения диагностики</td>
    						<td>  		
    							<textarea align="center" id="receipt" name="receipt" style="width:95%; height:100px;" rows="4">
    							</textarea>	    								  														 					
    						</td>
    					</tr>	
    					
    					<input type="submit" name="saveandexit" value="Сформировать" />
    				
    				</table>
    				<input type="hidden" name="request_id" value="{Request/@id}"/> 
    				<input type="hidden" name="action" value="receipt-edit" />	
	            </fieldset>
            </form>
        </div>-->
        
        <div id="decline-comment-form" title="Комментарий к отклонению запроса">
            <form action="/requests/?type=inwork&amp;category=inwork" method="POST">
              	<fieldset>
	            	<table  cellspacing="0" cellpadding="0" border="0" width="100%">
    					<thead><th>Укажите комментарий</th></thead>
    					
    					<tr></tr>
    						    						    					
    					<tr>
    						<td width="90%">    						  		
    							<textarea align="center" id="comment" name="comment" style="width:95%; height:100px;" rows="4">
    							</textarea>	    								  														 					
    						</td>
    					</tr>	
    					
    					<tr></tr>
    					
    					<tr>     											
    						<td align = "Center"> <input type="submit" name="saveandexit" value="Отклонить" align="center" class = "disagree"/></td>
    					</tr>	
    						    						    				
    					<input type="hidden" name="id" value="{Request/@id}"/>   
    				
    				</table>
    			<input type="hidden" name="action" value="approve-disagree-withcomment" />	
	            </fieldset>
            </form>
        </div>
        
        <div id="chat-form" title="Сообщение">
            <form action="/requests/?type=inwork&amp;category=inwork" method="POST">
              	<fieldset>
	            	<table  cellspacing="0" cellpadding="0" border="0" width="100%">
    					<thead>
    						<th>Введите текст сообщения</th>
    					</thead>
    					
    					<tr><td>&#160;</td></tr>
    						    						    					
    					<tr>
    						<td width="90%" align="center">
    							<textarea align="middle" id="comment" name="comment" style="width:95%; height:200px;" rows="4">
    							</textarea>	    								  														 					
    						</td>
    					</tr>	
    					
    					<tr><td>&#160;</td></tr>
    					
    					<tr>     											
    						<td align = "Center"> <input type="submit" name="saveandexit" value="Отправить" align="center" class = "disagree"/></td>
    					</tr>	
    						    						    				
    					<input type="hidden" name="request_id" value="{Request/@id}"/>   
    				
    				</table>
    			<input type="hidden" name="action" value="add-message" />	
	            </fieldset>
            </form>
        </div>
        	       
        <xsl:apply-templates select="/Request"/>
    </xsl:template>
        
    <xsl:template match="Request">     
    	<script language="JavaScript" src="/js/combobox-test.js"></script>  
       
		<div class="request-card request-card-font">
			
			<xsl:variable name="id" select="@id" />
	    	<xsl:variable name="author_id" select="@author_id" />
	    	<xsl:variable name="status" select="@status"/>
	    	<xsl:variable name="address" select="@address"/>
	    	<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id" />
	    	<xsl:variable name="satisfaction_id" select="//Request/ExternalData/External/Satisfaction/@id" />
	    	
	    	<xsl:variable name="uki-prefix" select="substring-before(uki,'-')"/>
	    	
	    	<div id="container">
		    	<form name="RequestForm" id="ajaxform" action="/requests/?type=inwork&amp;category=inwork" method="POST" enctype="multipart/form-data">
		    		<div class="rc-general-backend">
		    			<input type="hidden" name="request_number" value="{@request_number}"/>    		
				    	<input type="hidden" name="creation_date" value="{@creation_date}"/>
			    		<input type="hidden" name="id" value="{@id}" />
				    	<input type="hidden" name="author_id" value="{@author_id}"/>
				    	
				    	<input type="hidden" name="uki" value="{@uki}"/>
				    	<input type="hidden" name="status" value="{@status}"/>
				    	
				    	<xsl:if test = "@status!=6">
				    		<input type="hidden" name="contract_id" value="{@contract_id}"/>
				    	</xsl:if>
				    	
				    	<input type="hidden" name="comment" value="{@comment}"/>
				    	<input type="hidden" name="action" value="request-edit" />
				    	<input type="hidden" name="type" value="" />
				    	
			    		<xsl:call-template name="RequestCard-Main-Info">			    					    			
			    		</xsl:call-template>
			    	</div>
			    	
					<!-- REM: Раздел ниже не должен отображаться. Прежнее условие отображения: (test="@status = 2 or @status = 3 or @status = 7 or @status = 10 or @status = 4") -->
			    	<xsl:if test="none">
						<div class="rc-ex-backend">
							<table cellspacing="2" cellpadding="1" border="0" class="r-table-ex">
					    		<tr>
					    			<td width="200px">Комментарий к исполнению:</td>
					    			<td>
					    				<xsl:if test="@comment = ''"><p class="rc-comment">-</p></xsl:if>
					    				<xsl:if test="@comment != '' and substring-before(@comment,';') != ''"><p class="rc-comment"><xsl:value-of disable-output-escaping = "yes" select = "substring-before(@comment,';')" /></p></xsl:if>
					    				<xsl:if test="@comment != '' and substring-before(@comment,';') = ''"><p class="rc-comment"><xsl:value-of disable-output-escaping = "yes" select = "@comment" /></p></xsl:if>
					    			</td>
					    		</tr>			    		
					    		
					    		<!-- Подгружаем дополнительные поля: для различныых организаций -->
					  			<xsl:for-each select="//ExternalData/External/AdditionalField">
					  				<tr>
					  					<td width="150"><xsl:value-of disable-output-escaping = "yes" select = "@field_name" /></td>
					    				<td><xsl:if test="@field_value = ''">-</xsl:if>
					    				<xsl:if test="@field_name = 'Приоритет' and @field_value != ''">
					    					<xsl:if test="@field_value = '0'">Критический</xsl:if>
					    					<xsl:if test="@field_value = '1'">Высокий</xsl:if>
					    					<xsl:if test="@field_value = '2'">Средний</xsl:if>
					    					<xsl:if test="@field_value = '3'">Низкий</xsl:if>
					    				</xsl:if>
					    				<xsl:if test="@field_value != '' and @field_name != 'Приоритет'"><xsl:value-of disable-output-escaping = "yes" select = "@field_value" /></xsl:if></td>
					    			</tr>
					  			</xsl:for-each>  			
					  			<!-- / Подгружаем дополнительные поля -->				    		
					    	</table>   
				    	</div>
			    	</xsl:if>			    	
			    	
			    	
			    	<xsl:if test="@status = 0">
				    	<table>
				    		<tr height="30px">
				    			<!-- <xsl:if test="@status = 0">
				    			<td>
				    				<xsl:if test="@email != ''">
				    					<input name = "notify" type="checkbox" checked="checked" onchange="JavaScript:showEmail()" />
				    				</xsl:if>
				    				<xsl:if test="@email = ''">
				    					<input name = "notify" type="checkbox" onchange="JavaScript:showEmail()" />
				    				</xsl:if>
				    			</td>				    			
				    			</xsl:if>
				    			
				    			 <td>Уведомлять по электронной почте</td>
				    			
				    			<td>
				    				<xsl:if test="@status = 0">
				    					<xsl:if test="@email = ''">
				    						<input type= "text" placeholder="Введите адрес электронной почты ..." name = "email" id="email" style="display:none; width:250px" value="{@email}"/>
				    					</xsl:if>
				    					<xsl:if test="@email != ''">
				    						<input type= "text" name = "email" id="email" style="display:block" value="{@email}"/>
				    					</xsl:if>
				    				</xsl:if>
				    			</td>  -->
				    		</tr>
				    	</table>
			    	</xsl:if>
  					
  					<xsl:if test="@status != 0">
    					<xsl:if test="@email != ''">			    						
    						<input type= "hidden" name = "email" value="{@email}"/>
    					</xsl:if>
    				</xsl:if>
			    	
					<!-- <xsl:if test="@status != 0"> -->
						<xsl:apply-templates select="ExternalData">
							<xsl:with-param name="id" select="$id"/>
			    			<xsl:with-param name="author_id" select="$author_id"/>
			    			<xsl:with-param name="status" select="$status"/>
			    			<xsl:with-param name="current_user_id" select="$current_user_id"/>
			    			
			    			<xsl:with-param name="uki-prefix" select="$uki-prefix"/>
						</xsl:apply-templates>
					<!-- </xsl:if> -->
					
					<xsl:if test="(//Request/ExternalData/External/Satisfaction)">
						<div class="rc-ex-backend" style="padding: 10px 10px 10px 10px">
				    		<xsl:call-template name="Satisfactions">
				    			<xsl:with-param name="id" select="$id"/>
					    		<xsl:with-param name="author_id" select="$author_id"/>
					    		<xsl:with-param name="satisfaction_id" select="$satisfaction_id"/>
					    		<xsl:with-param name="status" select="$status"/>
					    		<xsl:with-param name="current_user_id" select="$current_user_id"/>
					    		<xsl:with-param name="uki-prefix" select="$uki-prefix"/>
				    		</xsl:call-template>
				    	</div>
				    </xsl:if>
					
					<div class="rc-general-backend">
		    			<xsl:call-template name="RequestCard-Action">
		    				<xsl:with-param name="id" select="$id"/>
			    			<xsl:with-param name="author_id" select="$author_id"/>
			    			<xsl:with-param name="satisfaction_id" select="$satisfaction_id"/>
			    			<xsl:with-param name="status" select="$status"/>
			    			<xsl:with-param name="current_user_id" select="$current_user_id"/>
			    			<xsl:with-param name="uki-prefix" select="$uki-prefix"/>
		    			</xsl:call-template>
			    	</div>
				</form>
	    	</div>
	    </div>
	</xsl:template>
	
	<xsl:template name="RequestCard-Main-Info">
	
		<script>
			$(function() {
				$( "#term" ).autocomplete({
     				source: "/autocompleteuser/";
   				});	
			});
		</script>
	
		<xsl:variable name="id" select="//Request/@id"/>
		<xsl:variable name="author_id" select="//Request/@author_id"/>
		<xsl:variable name="status" select="//Request/@status"/>
		<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
		
		<xsl:variable name = "requesttext" select = "//Request/@requesttext"/>
		
		<xsl:variable name="uki-prefix" select="substring-before(@uki,'-')"/>			    			
		<xsl:variable name="address" select="//Request/@address"/>
		<xsl:variable name="default_name" select="//ExternalData/External/RequestRoute/@name"/>
	
		<div class="rc-title">
			Запрос на оказание услуг <xsl:if test="'' != @request_number">№&#160;<xsl:value-of disable-output-escaping = "yes" select = "@request_number" /></xsl:if>
			&#160;от&#160;<xsl:value-of disable-output-escaping = "yes" select = "substring(@creation_date,9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@creation_date,6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@creation_date,1,4)" />
			<!-- <a href="/requests-ajax/?action=print-request&amp;id={$id}" target="_blank" download="download">
				<img src="/images/iicons/printer.png" alt="" title="" width="16" heigh="16"/>			
			</a> -->
		</div>
						    				
		<div class="rc-status">
			Статус:&#160;	
			<xsl:if test="0 = @status"> Новый (создание) </xsl:if>  
			<xsl:if test="1 = @status"> Согласование </xsl:if> 
			<xsl:if test="6 = @status"> Принятие в работу </xsl:if> 
			<xsl:if test="2 = @status"> Распределение </xsl:if> 
			<xsl:if test="3 = @status"> Исполнение </xsl:if> 
			<xsl:if test="7 = @status"> Подтверждение со стороны исполнителя </xsl:if> 
			<xsl:if test="10 = @status"> Подтверждение со стороны заказчика </xsl:if> 
			<xsl:if test="4 = @status"> Выполнено </xsl:if>
			<xsl:if test="5 = @status"> Отклонен </xsl:if>
		</div>
  	
  		<table cellspacing="2" cellpadding="1" border="0" class="table-general">
	   		<tr>
	   			<td align="right" width="150px" title="ФИО сотрудника для которого формируется запрос">Пользователь:</td>
	   			<td style="font-weight:normal" title="ФИО сотрудника для которого формируется запрос">
	   				<xsl:if test="@status = 0">
	   				<input type="text" id="term" name="fio" value="{//Request/ExternalData/External/Author/@secondname} {substring(//Request/ExternalData/External/Author/@firstname, 1, 1)}. {substring(//Request/ExternalData/External/Author/@patronymic, 1, 1)}." required = "required"/></xsl:if>
	   				<xsl:if test="@status != 0">
	   					<xsl:value-of disable-output-escaping = "yes" select = "@fio" />
	   					<input type="hidden" name="fio" value="{@fio}"/>
	   				</xsl:if>
	   			</td>
	   			<td align="right" width="150px" title="Номер кабинета сотрудника">Кабинет:</td>
	   			<td style="font-weight:normal"  title="Номер кабинета сотрудника">
	   				<xsl:if test="@status = 0"><input type="text" name="cabinet" value="{@cabinet}" required = "required"/></xsl:if>
	   				<xsl:if test="@status != 0">
	   					<xsl:value-of disable-output-escaping = "yes" select = "@cabinet" required = "required"/>
	   					<input type="hidden" name="cabinet" value="{@cabinet}"/>
	   				</xsl:if>
	   			</td>
	   			<td align="right" width="150px" title="Контаткный телефон">Телефон:</td>
	   			<td style="font-weight:normal" title="Контаткный телефон">
	   				<xsl:if test="@status = 0"><input type="text" name="phone" value="{@phone}" required = "required"/></xsl:if>
		   			<xsl:if test="@status != 0">
		   				<xsl:value-of disable-output-escaping = "yes" select = "@phone" />
		   				<input type="hidden" name="phone" value="{@phone}" />
		   			</xsl:if>
	   			</td>
	   		</tr>
	   		<tr>
	   			<td align="right" title="Организация Заказчика">Организация:</td>
	   			<td align="left" style="font-weight: normal" title="Организация Заказчика">
	   				<xsl:variable name="current_organization_id" select="//ExternalData/External/Organization/@id" />
	   				<input type="hidden" name="contractor_id" value="{$current_organization_id}" />
					<xsl:for-each select="//ExternalData/External/Organization">
	   					<xsl:value-of disable-output-escaping = "yes" select = "@name" />
	   				</xsl:for-each>
				</td>
	   			<td align="right" title="Адрес местонахождения сотрудника">Адрес:</td>
	   			<td align="left" colspan="3" style="font-weight: normal" title="Адрес местонахождения сотрудника">
	   				<xsl:if test="@status = 0">
		   				<select name="address" style="width:100%">
		   					<xsl:if test = "'' != @address"> 	
		   						<option value="{$address}" selected="selected"><xsl:value-of disable-output-escaping = "yes" select = "$address" /></option>
		   					</xsl:if>	
		   					
		   					<xsl:value-of disable-output-escaping = "yes" select = "$address" />
		   												
		                    <xsl:for-each select="//ExternalData/External/Address">      
		                    	<xsl:if test = "$address != @address">
		                    		<option value="{@address}"><xsl:value-of disable-output-escaping = "yes" select = "@address" /></option>
		                    	</xsl:if>	   						
		                    </xsl:for-each>
		   				</select>
	   				</xsl:if>
	   				
	   				<xsl:if test="@status != 0">
	   					<xsl:value-of disable-output-escaping = "yes" select = "@address" />
	   					<input type="hidden" name="address" value="{@address}" />
	   				</xsl:if>
	   			</td>
	   		</tr>
	   		
	   		<tr>
	   			<td align="right" width="150px" title="Направление деятельности">Категория:</td>
	   			<td style="font-weight:normal" title="Направление деятельности" colspan="5">
	   				<xsl:if test="@status = 0">   					
	   					<table width="100%" border = "1" cellspacing="0" cellpadding="0">
    						<tr id = "offset-width">
    							<td width="95%"><input class="category">Выберите направление деятельности</input></td>
    							<td width="5%">
    							<input type = "button" class="button" value="..." id = "select_button">
    							<!-- <span class="expand">...</span>  -->
    							</input>
    							</td>
    						</tr> 
    						
    						<tr>
    							<td colspan="2">
    								<ul id="route_list">
    								<xsl:for-each select="//ExternalData/External/Route">
    									<li style="width:100%">   <a onclick="OnRouteSelect({@id});"> 							
    									<table>
    										<tr valign="middle">
    											<td width = "5%"> <img src = "{@logo}"/>
    											</td>
    											<td>
    											
    											<xsl:value-of disable-output-escaping = "yes" select = "@route_name" />
    											
    											</td>
    										</tr>
    									</table>  
    									
    									</a> 								
    									</li>
    								</xsl:for-each>        						
    								</ul>
    							</td>
    							
    						</tr>
    						   					
    					</table>
    					   					
	   					<!-- 
	   					<div class="ui-widget" style="width:100%">
	   						<select id="combobox" required = "required" placeholder = "Комментарий ..."  name="route">
	   							

                            	<option value=""></option>

                        		<xsl:for-each select="//ExternalData/External/Route">
	   								
	   								<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@route_name" /></option>	
	   								</xsl:if>    												                    		   						
		                		</xsl:for-each>
	   						</select>
	   					</div>				   				
	   					 -->
	   				</xsl:if>
	   				
	   				<xsl:if test="@status != 0">  
	   					<xsl:value-of disable-output-escaping = "yes" select = "//ExternalData/External/RequestRoute/@name" />				
	   				</xsl:if>
	   			</td>	   			
	   		</tr>
	   		   		   		
	   		<tr>
	   		<!--	<td align="right" title="Уникальный код изделия (номер указан на инвентарном ярлычке)">УКИ:</td>
	   			<td colspan="5" title="Уникальный код изделия (номер указан на инвентарном ярлычке)">
	   				<table cellspacing="0" cellpadding="0" border="0">
	   					<tr>
	   						<xsl:if test="@status = 0">
		   						<td title="Уникальный код изделия (номер указан на инвентарном ярлычке)"><input type="text" name="uki-prefix" size="3" value="{substring-before(@uki,'-')}"/></td>
		   						<td title="Уникальный код изделия (номер указан на инвентарном ярлычке)">&#160;-&#160;</td>
		   						<td title="Уникальный код изделия (номер указан на инвентарном ярлычке)"><input type="text" name="uki-index"  size="9" value="{substring-after(@uki,'-')}"/></td>
	   						</xsl:if>
	   						<xsl:if test="@status != 0">
	   							<td style="font-weight: normal"><xsl:value-of disable-output-escaping = "yes" select = "substring-before(@uki,'-')" /></td>
		   						<td>&#160;-&#160;</td>
		   						<td style="font-weight: normal"><xsl:value-of disable-output-escaping = "yes" select = "substring-after(@uki,'-')" /></td>
	   						</xsl:if>
	   					</tr>
	   				</table>
	   			</td> -->
	   			<input type="hidden" name="uki-prefix" size="9" value="1" />
	   			<input type="hidden" name="uki-index"  size="9" value="1" />
	   		</tr>	
	   	</table>
	   		   	
		<table cellspacing="0" cellpadding="2" border="0" style="width:100%">
			<tr><td align="center" class="request-text-header">Описание запроса</td></tr>
			<tr><td align="center">
				<textarea align="center" name="requesttext" style="width:95%; height:100px;" rows="4" required = "required">
					<xsl:if test="@status != 0">
    					<xsl:attribute name="readonly">readonly</xsl:attribute>
       				</xsl:if>
    				
					<xsl:value-of disable-output-escaping = "yes" select = "$requesttext" />		
				</textarea>
			</td></tr>
		</table>	
	
		<table cellspacing="2" cellpadding="1" border="0" style="width:100%">
			<tr>
                <td width="110px" align="right">
                    <xsl:if test="(0 = @status)">
                        <a onClick='$( "#attach-info-screenshot" ).toggle( "highlight", "", 500 );' style="border-bottom:1px dashed #000;">Приложение:</a>
                    </xsl:if>
                    <xsl:if test="(0 != @status)">
                        Приложение:
                    </xsl:if>
			    </td>
			<td>
				<xsl:if test="(0 = @status)"> 
	   				<input type="file" class="multi" name="filename"/>    				
	   			</xsl:if>
	   			 
	   			<xsl:if test="(not (//ExternalData/External/Upload)) and @status != 0">-</xsl:if>
	   			 
  				<xsl:for-each select="//ExternalData/External/Upload">
  					<!-- FixUP: Дописать -->
  					<xsl:if test="($current_user_id = $author_id and 0 = $status)"> 
  						<a href="/requests-ajax/?action=delete-attach&amp;id={$id}&amp;fileid={@id}" class="remote-url">
  							<img src="/images/iicons/cross.png" alt="Удалить вложение" title="Удалить вложение"/>  
  						</a>	  						 				
  					</xsl:if>
  					<a href="/uploads/{@pathname}/{@uniqname}" download = "{@name}" target="_blank">
  						<xsl:value-of disable-output-escaping = "yes" select = "@name"/>
  					</a>
  					<br/>	
  				</xsl:for-each>   				
			</td></tr>
		</table>
		
		<div id="div-attach-info-list">
			<table id="attach-info-screenshot" cellspacing="0" cellpadding="0" border="0" class="rc-ex-backend table-white-bg" style="display:none;width:100%;">
				<tr>
					<td>
						<i style="text-decoration:none;font-weight: normal;">
						<center>Для того, чтобы прикрепить к запросу скриншот (картинку с ошибкой и пр.), необходимо:<br/><br/></center>
						<table align="center" cellspacing="2" cellpadding="1" border="0" style="width:90%">
							<tr>
								<td width="20px">1.</td><td>В тот момент, когда вы видите на экране ошибку или сообщение, нажмите на клавиатуре кнопку «Print Screen» (как правило, она располагается справа от кнопки F12). После нажатия на эту кнопку ничего не произойдет, данные попадают в буфер обмена.</td>
							</tr>
							<tr>
								<td>2.</td><td>Затем откройте новый документ MS Word.</td>
							</tr>
							<tr>
								<td>3.</td><td>На любом месте открывшегося чистого листа Word нажимаете правой кнопкой мыши и выбираете пункт «Вставить».</td>
							</tr>
							<tr>
								<td>4.</td><td>Картинка с ошибкой скопировалась в документ MS Word. Теперь его необходимо сохранить на рабочий стол. И далее через кнопку «Выберите файл» вставить сохраненный документ в запрос.</td>
							</tr>
						</table>
						</i>
					</td>
				</tr>
			</table>
		</div>
		
		<p class="rc-author" align="right">			
			<b>Автор запроса:&#160;</b> 
			<xsl:for-each select="//ExternalData/External/Author">
				<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;<xsl:value-of disable-output-escaping = "yes" select = "@firstname"/>&#160;<xsl:value-of disable-output-escaping = "yes" select = "@patronymic"/>
			</xsl:for-each>
			<br/>			
		</p>
		<xsl:if test="@status != 0">
			<p class="rc-author" align="right">
				<a href="/requests-ajax/?action=print-request&amp;id={$id}" target="_blank" download="download" style="font-size: 10px; font-weight: normal; text-decoration:none;color:#000;border-bottom:1px dashed">
					Печатная форма запроса<!-- - <img src="/images/iicons/printer.png" alt="Печатная форма запроса" title="Печатная форма запроса" width="16" heigh="16"/> -->			
				</a>
			</p>
		</xsl:if>	
		
		<xsl:if test = "@status=6">
			
		<table cellspacing="0" cellpadding="2" border="0" style="width:100%">
			<tr><td align="center">Выберите договор</td></tr>
			<tr><td align="center">
				
				<select name="contract_id">    	
    				<option value="0" selected="selected">- Укажите наименование договора -</option>				
	                <xsl:for-each select="//ExternalData/External/Contract">                    	
    					<option value="{@id}"><xsl:value-of disable-output-escaping = "yes" select = "@name" /></option>
                	</xsl:for-each>
    			</select>			
			
				<!-- <input type="text" name="contract_id" value="119"/> -->
			</td></tr>
		</table>	
			
		</xsl:if>
			
	</xsl:template>
	    
	<xsl:template name="RequestCard-Action">
	
		<xsl:variable name="id" select="//Request/@id"/>
		<xsl:variable name="author_id" select="//Request/@author_id"/>
		<xsl:variable name="satisfaction_id" select="//Request/ExternalData/External/Satisfaction/@id"/>
		<xsl:variable name="status" select="//Request/@status"/>
		<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
		<xsl:variable name="uki-prefix" select="substring-before(//Request/@uki,'-')"/>
		<xsl:variable name="current_user_group_id" select="//Request/ExternalData/External/User/@group_id"/>
	
		<div style="border-top:1px solid #a1a1a1">
		<table cellspacing="3" cellpadding="3" border="0" align="center">
			<tr align="center">
				<td align="center"><input type="button" onclick="
				window.history.go(-1);
				" name="exit" class="back" value="&lt;&#160;Назад" formnovalidate="formnovalidate" /></td>
				<!-- <td><input type="submit" name="saveandedit" value="Применить" /></td> -->
				<xsl:if test="0 = @status and $current_user_id = $author_id"><td><input type="submit" name="saveandexit" class="save" value="Сохранить" /></td></xsl:if>
				
					<xsl:if test="0 = @status and $current_user_id = $author_id"><td><input type="submit" name="send" class="send" value="Отправить&#160;&gt;" /></td></xsl:if>
					<xsl:if test="(1 = @status)">    				    									
		  				<xsl:for-each select="//ExternalData/External/Approver">
		  					<xsl:if test="$current_user_id = @approver_id">
		  					    <td>
			  					    <a onclick="$('#decline-comment-form').dialog( 'open' );return false;">
			  					    	<input type="button" class="disagree-with-comment" value="Отклонить" style = "width:150px;height:35px;padding:5px 15px; background:#e8641b;font-weight: bold;color:#fff;border:0 none;
	    cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px;"/>
			  					    </a>
		  					    </td>
		  					    <td><input type="submit" name="approve-agree" class="agree" value="Согласовать&#160;&gt;" /></td>
		  					</xsl:if>
		  				</xsl:for-each>
  					</xsl:if> 
  			
  			<xsl:if test="3 = @status">
  				<xsl:for-each select="//ExternalData/External/RequestExecutor">
  					<xsl:if test="$current_user_id = @executor_id and 1 != @take_in_work">
  						<td><input type="submit" name="take-in-work" class="inwork" value="Взять в работу&#160;&gt;"/></td>
  					</xsl:if>      				
  				
  					<xsl:if test="$current_user_id = @executor_id and 1 = @executor_type and 1 = @take_in_work">
  						<td><input type="submit" name="works-done" class="done" value="Исполнено&#160;&gt;" /></td>
  					</xsl:if>
  				</xsl:for-each>       				
  			</xsl:if> 
  			
  			<xsl:if test="6 = @status">
  				<!-- принятие запроса в работу -->
  				<xsl:if test="$current_user_group_id = 3">  
  				
  					<td>
			  					    <a onclick="$('#decline-comment-form').dialog( 'open' );return false;">
			  					    	<input type="button" class="disagree-with-comment" value="Вернуть" style = "width:150px;height:35px;padding:5px 15px; background:#e8641b;font-weight: bold;color:#fff;border:0 none;
	    cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px;"/>
			  					    </a>
		  					    </td>
  									
  					<td><input type="submit" name="request-take-in-work" class="done" value="Принять в работу&#160;" /></td>
  				</xsl:if>  				
  			</xsl:if>
  			
  			<xsl:if test="2 = @status">
  			
  				<!-- распределение -->
  				<xsl:if test="$current_user_group_id = 3">
  					<td>
  						<a onclick="$('#decline-comment-form').dialog( 'open' );return false;">
			  			<input type="button" class="disagree-with-comment" value="Отклонить" style = "width:150px;height:35px;padding:5px 15px; background:#e8641b;font-weight: bold;color:#fff;border:0 none;
	    				cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px;"/>
			  			</a> 			  					
  					</td>
  					<td>
  						<input type="submit" name="request-chooseexecutors" class="chooseexecutors" value="На исполнение&#160;&gt;" />
  					</td>
  					<!--<td><input type="submit" name="request-consider" class="done" value="Отправить&#160;&gt;" /></td>-->
  				</xsl:if>   				 
                	
  				<xsl:if test="$current_user_group_id != 3">
  					<xsl:for-each select="//ExternalData/External/RouteApprover">
  						<xsl:if test="$current_user_id = @approver_id">
  							<td>
  								<a onclick="$('#decline-comment-form').dialog( 'open' );return false;">
			  					<input type="button" class="disagree-with-comment" value="Отклонить" style = "width:150px;height:35px;padding:5px 15px; background:#e8641b;font-weight: bold;color:#fff;border:0 none;
	    						cursor:pointer;-webkit-border-radius: 5px;border-radius: 5px;"/>
			  					</a> 			  					
  							</td>
  							<td>
  								<input type="submit" name="request-chooseexecutors" class="chooseexecutors" value="На исполнение&#160;&gt;" />
  							</td>
  							<!--<td><input type="submit" name="request-consider" class="done" value="Отправить&#160;&gt;" /></td>-->
  						</xsl:if> 		
               		</xsl:for-each>
  				</xsl:if>  
  								
  			</xsl:if>
  			
  			<xsl:if test="(10 = @status)">    				    									
  				
  					<xsl:if test="$current_user_id = $author_id">
  					    <td><input type="submit" name="approve-disagree" value="Вернуть" class="sign"/></td>
  					    <td><input type="submit" name="approve-agree" value="Подтвердить&#160;&gt;" class="unsign"/></td>
  					</xsl:if>	
  					
  			</xsl:if> 
			
				</tr>
			</table>

			<xsl:if test="10 = @status and $current_user_id = $author_id and not (//Request/ExternalData/External/Satisfaction)">
			<!-- and $current_user_id = $author_id) -->
				<p align="center">  					
  					<a onclick="$tmp = '{@date}';$('#satisfaction-form').dialog( 'open' );" style="font-weight:normal;border-bottom:1px dashed #000;font-size: 14px;"><img src="/images/iicons/add.png" alt="" title=""/>Заполнить анкету удовлетворенности</a>
  				</p>
			</xsl:if>
			
			<!-- <xsl:if test="@status != 0">
				<p class="rc-author" align="center">
					<a href="/requests-ajax/?action=print-request&amp;id={$id}" target="_blank" download="download" style="font-size: 10px; font-weight: normal; text-decoration:none;color:#000;border-bottom:1px dashed">
						Печатная форма запроса - <img src="/images/iicons/printer.png" alt="Печатная форма запроса" title="Печатная форма запроса" width="16" heigh="16"/>			
					</a>
				</p>
			</xsl:if> -->	
		</div>	    	
	</xsl:template> 
	    
	<xsl:template match="ExternalData">
		<xsl:apply-templates select="External">
			
		</xsl:apply-templates>
	</xsl:template>
	
	<xsl:template match="External">
	
		<xsl:variable name="id" select="//Request/@id"/>
		<xsl:variable name="author_id" select="//Request/@author_id"/>
		<xsl:variable name="status" select="//Request/@status"/>
		<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
		<xsl:variable name="uki-prefix" select="substring-before(//Request/@uki,'-')"/>
		
		<xsl:if test="$status != 0">
			<!-- <div class="rc-ex-backend" style="padding: 10px 10px 10px 10px">
				<xsl:call-template name="RequirementsList">
					
				</xsl:call-template>
			</div>  -->
			
			<div class="rc-ex-backend" style="padding: 10px 10px 10px 10px">
				<xsl:call-template name="CompletedWorksList">
					
				</xsl:call-template>
			</div>

   			<xsl:for-each select="//ExternalData/External/RequestExecutor">
   				<xsl:if test="$current_user_id = @executor_id">
					<div class="rc-ex-backend" style="padding: 10px 10px 10px 10px">  
						<xsl:call-template name="Chat">
						</xsl:call-template>
					</div>
				</xsl:if>
			</xsl:for-each>  
		</xsl:if>
						
		<xsl:if test="LogAction">
			<div class="rc-ex-backend" style="padding: 10px 10px 10px 10px">
				<xsl:call-template name="History" />
			</div>
		</xsl:if>
	</xsl:template>
    
    <xsl:template name="RequirementsList">
    
    	<xsl:variable name="id" select="//Request/@id"/>
		<xsl:variable name="author_id" select="//Request/@author_id"/>
		<xsl:variable name="status" select="//Request/@status"/>
		<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
		<xsl:variable name="uki-prefix" select="substring-before(@uki,'-')"/>
    
    <!--  	<a onClick='$( "#table-requirements" ).toggle( "highlight", "", 500 );' style="border-bottom:1px dashed #000;">Потребности ></a>
	    <table id="table-requirements" cellspacing="0" cellpadding="0" border="0" style="display:none;width:100%;" class="rc-ex-backend table-white-bg">
			<tr class="history-head table-white-bg">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">Отправлено</td>
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="5%">К-во</td>
    			<td style="border-bottom:1px solid #a1a1a1;" width="60%">Наименование услуги</td>
    		</tr>  			 
   			<xsl:apply-templates select="Requirement"/>
   			<xsl:if test="3 = $status">
   				<tr>
   					<td colspan="3" align="right">
			   			<xsl:for-each select="//ExternalData/External/RequestExecutor">
							<xsl:if test="$current_user_id = @executor_id and 1 = @take_in_work">
								<a onclick="$tmp = '{@date}';$('#requirement-form').dialog( 'open' );" style="font-weight:normal;border-bottom:1px dashed #000;font-size: 14px;"><img src="/images/iicons/add.png" alt="" title=""/>Добавить потребность</a>
							</xsl:if>
						</xsl:for-each>
		   			</td>
   				</tr>
   			</xsl:if>
   		</table> -->
    </xsl:template>
    
    <xsl:template match="Requirement">
   		<tr style="font-weight:normal">
   			<td align="center">
   				<xsl:value-of disable-output-escaping = "yes" select = "substring(@date,9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@date,6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@date,1,4)" />
   			</td>
   			<td align="center"><xsl:value-of disable-output-escaping = "yes" select = "@quantity" /></td>
   			<td>
   				<xsl:value-of disable-output-escaping = "yes" select = "@position" />
   				&#160;(<xsl:if test="@status = 0">Активная</xsl:if><xsl:if test="@status = 1">Обработка завершена</xsl:if>
   				<xsl:if test="@comment != ''">
   				&#160;-&#160;<xsl:value-of disable-output-escaping = "yes" select = "@comment" /></xsl:if>)
   			</td>
   		</tr>  	
    </xsl:template>	
    
    <xsl:template name="CompletedWorksList">
    
    	<xsl:variable name="id" select="//Request/@id"/>
		<xsl:variable name="author_id" select="//Request/@author_id"/>
		<xsl:variable name="status" select="//Request/@status"/>
		<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
		<xsl:variable name="uki-prefix" select="substring-before(@uki,'-')"/>

        <table id="table-works-header" cellspacing="0" cellpadding="0" border="0" style="width:100%;">
            <tr>
                <td><a onClick='$( "#table-works" ).toggle( "highlight", "", 500 );' style="border-bottom:1px dashed #000;">Оказанные услуги ></a></td>
                <td align="right">
                    <xsl:if test="3 = $status">
                        <xsl:for-each select="//ExternalData/External/RequestExecutor">
                            <xsl:if test="$current_user_id = @executor_id and 1 = @take_in_work">
                                <a href="/requests-ajax/?action=multi-registration-completedwork&amp;request_id={$id}&amp;id=0" class="remote-url"  style="
                                font-weight:normal;
                                text-decoration:none;
                                width:100px;
                                height:20px;
                                padding:2px 15px;
                                background:#1B3169;
                                color:#fff;
                                border:0 none;
                                cursor:pointer;
                                -webkit-border-radius: 5px;
                                border-radius: 5px;

                                ">Добавить</a>&#160;
                                <!-- <br/>
                                <a href="/requests-ajax/?action=multi-registration-completedwork&amp;request_id={$id}&amp;id=0" class="remote-url"  style="font-weight:normal;border-bottom:1px dashed #000;font-size: 14px;text-decoration:none"><img src="/images/iicons/add.png" alt="" title=""/>Добавить выполненную работу(массово-тест!)</a>&#160;
                                 -->
                                <!-- <a onclick="$('#defect-form').dialog( 'open' );return false;" style="font-weight:normal;border-bottom:1px dashed #000;font-size: 14px;text-decoration:none" target="_blank" download="download"><img src="/images/iicons/add.png" alt="" title=""/>Добавить акт о дефектации</a>&#160;
                                <a onclick="$('#receipt-form').dialog( 'open' );return false;" style="font-weight:normal;border-bottom:1px dashed #000;font-size: 14px;text-decoration:none" target="_blank" download="download"><img src="/images/iicons/add.png" alt="" title=""/>Сформировать сохранную расписку</a>&#160;
                             -->
                            </xsl:if>
                        </xsl:for-each>
                    </xsl:if>
                </td>
            </tr>
        </table>
        
       <!--  <table>
			<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="120px">Исполнители</td>
    			<td style="border-bottom:1px solid #a1a1a1;">
    				 <xsl:for-each select="//ExternalData/External/RequestExecutor/Executant">    
    					<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
   						<xsl:value-of select='substring(@firstname, 1, 1)'/>.
   						<xsl:value-of select='substring(@patronymic, 1, 1)'/>.	    					 						
   						&#160;&#160;
    				</xsl:for-each>
    			</td>    			
    		</tr>
    		<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="120px">В работе</td>
    			<td style="border-bottom:1px solid #a1a1a1;">
    				<xsl:for-each select="//ExternalData/External/RequestExecutor"> 
    					<xsl:if test="1 = @take_in_work">
    						 <xsl:value-of disable-output-escaping = "yes" select = "Executant/@secondname" />&#160;
   							<xsl:value-of select='substring(Executant/@firstname, 1, 1)'/>.
   							<xsl:value-of select='substring(Executant/@patronymic, 1, 1)'/>.
   							&#160;&#160;
    					</xsl:if>       					   						
    				</xsl:for-each>    		
    			</td>    			
    		</tr>
		</table>	 -->

	    <table id="table-works" cellspacing="0" cellpadding="0" border="0" class="rc-ex-backend table-white-bg" style="display:none;width:100%;">
	    	
	    	<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1; border-left:1px solid #a1a1a1; border-top:1px solid #a1a1a1;" width="120px">Исполнители</td>
    			<td colspan = "2" style="border-bottom:1px solid #a1a1a1; border-top:1px solid #a1a1a1; border-right:1px solid #a1a1a1;">
    				 <xsl:for-each select="//ExternalData/External/RequestExecutor/Executant">    
    					<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
   						<xsl:value-of select='substring(@firstname, 1, 1)'/>.
   						<xsl:value-of select='substring(@patronymic, 1, 1)'/>.	    					 						
   						&#160;&#160;
    				</xsl:for-each>
    			</td>    			
    		</tr>
    		
    		<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1; border-left:1px solid #a1a1a1; " width="120px">В работе</td>
    			<td colspan = "2" style="border-bottom:1px solid #a1a1a1; border-right:1px solid #a1a1a1;">
    				<xsl:for-each select="//ExternalData/External/RequestExecutor"> 
    					<xsl:if test="1 = @take_in_work">
    						 <xsl:value-of disable-output-escaping = "yes" select = "Executant/@secondname" />&#160;
   							<xsl:value-of select='substring(Executant/@firstname, 1, 1)'/>.
   							<xsl:value-of select='substring(Executant/@patronymic, 1, 1)'/>.
   							&#160;&#160;
    					</xsl:if>       					   						
    				</xsl:for-each>    		
    			</td>    			
    		</tr>
    		
    		<tr>
    			<td colspan = "3">&#160;&#160;</td>
    		</tr>
	    
			<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="120px">Дата</td>
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="120px">ФИО</td>
    			<td style="border-bottom:1px solid #a1a1a1;">Наименование</td>
    		</tr>  
    					 
   			<xsl:apply-templates select="CompletedWork"/>
  			<xsl:apply-templates select="Defect"/>  	
  			<xsl:apply-templates select="TrustReceipt"/>  

   		</table>
    </xsl:template>
    
    <xsl:template match="CompletedWork">
    	<xsl:variable name="executor_id" select="@executor_id"/>    	    	
    	<tr style="font-weight:normal">
    		<td align="center" ><a href = "/requests/?action=registration-completedwork&amp;request_id={@request_id}&amp;id={@id}">
    		<xsl:value-of disable-output-escaping = "yes" select = "substring(@date_start,9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@date_start,6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(@date_start,1,4)" />
    		</a></td>
   			<td><a href = "/requests/?action=registration-completedwork&amp;request_id={@request_id}&amp;id={@id}" class="remote-url">
   			<xsl:value-of disable-output-escaping = "yes" select = "//Request/ExternalData/External/RequestExecutor[@executor_id = $executor_id]/Executant/@secondname" />&#160;
   			<xsl:value-of select='substring(//Request/ExternalData/External/RequestExecutor[@executor_id = $executor_id]/Executant/@firstname, 1, 1)'/>.<xsl:value-of select='substring(//Request/ExternalData/External/RequestExecutor[@executor_id = $executor_id]/Executant/@patronymic, 1, 1)'/>.
   			</a>
   			</td>
   			<td><a href = "/requests-ajax/?action=registration-completedwork&amp;request_id={@request_id}&amp;id={@id}" class="remote-url"><xsl:value-of disable-output-escaping = "yes" select = "@comment" /></a></td>
		</tr>
		
	</xsl:template>
	
	<xsl:template match="Defect">
	
    	<xsl:variable name="status" select="//Request/@status"/>
    	<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
    	
    	<tr style="font-weight:normal">
    		<td align="center" ><a href = "/requests-ajax/?action=print-defect&amp;defect_id={@id}&amp;id={@request_id}" target="_blank" download="download">
    		<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '), 9, 2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '), 6, 2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '), 1, 4)" />
    		</a></td>
   			<td><a href = "/requests-ajax/?action=print-defect&amp;defect_id={@id}&amp;id={@request_id}" target="_blank" download="download">
   			<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
   			<xsl:value-of select='substring(@firstname, 1, 1)'/>.<xsl:value-of select='substring(@patronymic, 1, 1)'/>.
   			</a>
   			</td>
   			<td>
   				<a href = "/requests-ajax/?action=print-defect&amp;defect_id={@id}&amp;id={@request_id}" target="_blank" download="download">Акт о дефектации № <xsl:value-of disable-output-escaping = "yes" select = "@number" /></a>
   				&#160;&#160;
   				
   				<xsl:if test="3 = $status and @author_id = $current_user_id">
   					<a href = "requests-ajax/?action=defect-remove&amp;defect_id={@id}&amp;id={@request_id}"> Отменить </a>
   				</xsl:if>
   				
   			</td>
		</tr>
	</xsl:template>
	
	<xsl:template match="TrustReceipt">
	
    	<xsl:variable name="status" select="//Request/@status"/>
    	<xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
    	
    	<tr style="font-weight:normal">
    		<td align="center" >
    		<a href = "/requests-ajax/?action=print-receipt&amp;receipt_id={@id}&amp;id={@request_id}" target="_blank" download="download">
    		<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),1,4)" />
    		</a></td>
   			<td><a href = "/requests-ajax/?action=print-receipt&amp;receipt_id={@id}&amp;id={@request_id}" target="_blank" download="download">
   				<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
   				<xsl:value-of select='substring(@firstname, 1, 1)'/>.<xsl:value-of select='substring(@patronymic, 1, 1)'/>.
   			</a>
   			</td>
   			<td>
   				<a href = "/requests-ajax/?action=print-receipt&amp;receipt_id={@id}&amp;id={@request_id}" target="_blank" download="download">
   				Сохранная расписка
   				<xsl:if test = "@status = 2">(отменена)
   				</xsl:if>
   				</a>
   				&#160;&#160;
   				 
   				<xsl:if test="3 = $status and @author_id = $current_user_id">   				 				
   					<a href = "requests-ajax/?action=receipt-cancel&amp;receipt_id={@id}&amp;id={@request_id}"> Отменить </a>
   					&#160;&#160;
   					<a href = "requests-ajax/?action=receipt-remove&amp;receipt_id={@id}&amp;id={@request_id}"> Удалить </a>   				
   				</xsl:if> 
   			</td>
		</tr>
	</xsl:template>
	
	<xsl:template name="History">
		<a onClick='$( "#table-history" ).toggle( "highlight", "", 500 );' style="border-bottom:1px dashed #000;">История работы с запросом ></a>
	    <table id="table-history" cellspacing="0" cellpadding="0" border="0" style="display:none;width:100%;" class="rc-ex-backend table-white-bg">
			<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">Дата</td>
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">ФИО</td>
    			<td style="border-bottom:1px solid #a1a1a1;" width="60%">Действие</td>
    		</tr>  			 
   			<xsl:apply-templates select="LogAction"/>
   		</table>
	</xsl:template>
	
	<xsl:template match="LogAction">
		<tr style="font-weight: normal;text-align:center">
			<td style="border-right:1px solid  #a1a1a1;" >
			<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@date,' '),9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@date,' '),6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@date,' '),1,4)" />
			&#160;<xsl:value-of disable-output-escaping = "yes" select = "substring-after(@date,' ')" />
			</td>
	    	<td style="border-right:1px solid  #a1a1a1;" ><xsl:value-of disable-output-escaping = "yes" select = "@fio" /></td>
	    	<td style="text-align:left;">&#160;
	    		<xsl:if test="@action = ''">-</xsl:if>
	    		<xsl:if test="@action != ''"><xsl:value-of disable-output-escaping = "yes" select = "@action" /></xsl:if>
	    	</td>
	    </tr>
	</xsl:template>	
	
	<xsl:template name="Chat">
        <table id="table-chat-header" cellspacing="0" cellpadding="0" border="0" style="width:100%;">
            <tr>
                <td><a onClick='$( "#table-chat" ).toggle( "highlight", "", 500 );' style="border-bottom:1px dashed #000;">Обмен сообщениями ></a></td>
                <td align="right">
                    <xsl:variable name="status" select="//Request/@status"/>
                    <xsl:if test="3 = $status">

                        <xsl:variable name="current_user_id" select="//Request/ExternalData/External/User/@id"/>
                        <xsl:for-each select="//ExternalData/External/RequestExecutor">
                            <xsl:if test="$current_user_id = @executor_id">
                                 <a onclick="$('#chat-form').dialog( 'open' );return false;" style="
                                    font-weight:normal;
                                    text-decoration:none;
                                    width:100px;
                                    height:10px;
                                    padding:2px 15px;
                                    background:#1B3169;
                                    color:#fff;
                                    border:0 none;
                                    cursor:pointer;
                                    -webkit-border-radius: 5px;
                                    border-radius: 5px;
                                ">Написать</a>&#160;
                            </xsl:if>
                        </xsl:for-each>
                    </xsl:if>
                </td>
            </tr>
        </table>

	    <table id="table-chat" cellspacing="0" cellpadding="0" border="0" style="display:none;width:100%;" class="rc-ex-backend table-white-bg">
			<tr class="history-head">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">Дата</td>
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="20%">ФИО</td>
    			<td style="border-bottom:1px solid #a1a1a1;" width="60%">Сообщение</td>
    		</tr>  		   			
   			
   			<xsl:apply-templates select="//Request/ExternalData/External/Message"/>
   		</table>
	</xsl:template>
	
	<xsl:template match="Message">
	
		<tr style="font-weight: normal;text-align:center">
			<td style="border-right:1px solid  #a1a1a1;" >
			<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),9,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),6,2)" />.<xsl:value-of disable-output-escaping = "yes" select = "substring(substring-before(@creation_date,' '),1,4)" />
			&#160;<xsl:value-of disable-output-escaping = "yes" select = "substring-after(@creation_date,' ')" />
			</td>
	    	<td style="border-right:1px solid  #a1a1a1;" >
	    		<xsl:if test="0 != @user_id">
	    			<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;
	    			<xsl:value-of disable-output-escaping = "yes" select = "substring(@firstname, 1, 1)" />.
	    			<xsl:value-of disable-output-escaping = "yes" select = "substring(@patronymic, 1, 1)" />.
	    		</xsl:if>
	    		<xsl:if test="0 = @user_id">
	    			Диспетчер
	    		</xsl:if>
	    	</td>
	    	<td style="text-align:left;">&#160;
	    		<xsl:value-of disable-output-escaping = "yes" select = "@comment" />
	    	</td>
	    </tr>
	</xsl:template>	
		
	<xsl:template name="Satisfactions">
		<a onClick='$( "#table-satisfactions" ).toggle( "highlight", "", 500 );' style="border-bottom:1px dashed #000;">Анкета удовлетворенности ></a>
	    <table id="table-satisfactions" cellspacing="0" cellpadding="0" border="0" style="display:none;width:100%;" class="rc-ex-backend table-white-bg">
			<tr class="history-head table-white-bg">
    			<td style="border-bottom:1px solid #a1a1a1;border-right:1px solid #a1a1a1;" width="60%">Наименование критерия</td>
    			<td style="border-bottom:1px solid #a1a1a1;" width="40%">Оценка</td>
    		</tr>  			 
   			<xsl:for-each select="//Request/ExternalData/External/Satisfaction/ExternalData/External/SatisfactionParam">
				<xsl:call-template name="SatisfactionParam" />
			</xsl:for-each>
   		</table>
	</xsl:template>	
	
	<xsl:template name="SatisfactionParam">
		<tr style="font-weight: normal;text-align:center">
			<td style="border-right:1px solid  #a1a1a1;" ><xsl:value-of disable-output-escaping = "yes" select = "@param" /></td>
	    	<td style="border-right:0px solid  #a1a1a1;" ><xsl:value-of disable-output-escaping = "yes" select = "@value" /></td>
	    </tr>
	</xsl:template>
</xsl:stylesheet>