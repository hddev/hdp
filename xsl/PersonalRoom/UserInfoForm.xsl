<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
    	<script>
    		<xsl:comment>
    			<![CDATA[
    			
    			]]>
    		</xsl:comment>
    	</script>
    	
		<script>
			$(function() {
				$( "#tabs" ).tabs();
			});
		</script>
    	
        <xsl:apply-templates select="/User"/>
    </xsl:template>
  
    
    <xsl:template match="User">
    	<xsl:apply-templates select="Messages" />
    	<xsl:apply-templates select="Errors" />
    	
    	<div class="rc-title"><center>Редактирование данных о пользователе</center></div>
	    	<br/>
    	
    	<div class="request-card request-card-font" style="width:600px">
    	
	    	
	    	
	    	<div id="tabs">
  				<ul>
					<li><a href="#tabs-1">Общие сведения</a></li>
					<li><a href="#tabs-2">Уведомления</a></li>
   					<li><a href="#tabs-3">Смена пароля</a></li>
				</ul>
  			
  				<form name="userregistrationform" id="userregistrationform" action="." method="POST">
  					<div id="tabs-1">
  						<table cellspacing="0" cellpadding="0" border="0" width="100%">
  							<tr>
	    						<td width="15">&#160;</td>
	    						<td width="200">Пользователь</td>
	    						<td width="200"><h4><xsl:value-of disable-output-escaping = "yes" select="@login"/></h4></td>
	    						<td >&#160;</td>
	    					</tr>
	    					
	    					<tr height = "4px"><td></td></tr>
	    					
	    					<tr>
	    						<td >&#160;</td>
	    						<td>Фамилия*</td>
	    						<td><input type="text" name="second_name" value="{@secondname}" maxlength="15" required="required"/></td>
	    						<td >&#160;</td>
	    					</tr>
	    					
	    					<tr height = "4px"><td></td></tr>
	    		
	    					<tr>
	    						<td >&#160;</td>
	    						<td>Имя*</td>
	    						<td><input type="text" name="first_name" value="{@firstname}" maxlength="10" required="required"/></td>
	    						<td>&#160;</td>
	    					</tr>
	    					
	    					<tr height = "4px"><td></td></tr>
	    					
	    					<tr>
	    						<td >&#160;</td>
	    						<td>Отчество</td>
	    						<td><input type="text" name="patronymic" value="{@patronymic}" maxlength="15"/></td>
	    						<td >&#160;</td>
	    					</tr>
	    				
	    					<tr height = "4px"><td><br/></td></tr>
	    				
	    					<tr>
	    						<td >&#160;</td>
	    						<td>Зарегистрирован</td>
	    						<td><xsl:value-of disable-output-escaping = "yes" select="@creation_date"/></td>
	    						<td >&#160;</td>
	    					</tr>
	    		
	    					<tr>
	    						<td >&#160;</td>
	    						<td>Изменен</td>
	    						<td><xsl:value-of disable-output-escaping = "yes" select="@change_date"/></td>
	    						<td >&#160;</td>
	    					</tr>
  						</table>
  					
  			    		<input type="hidden" name="action" value="user-editinfo" />
  			    		<br/>
  			    	
  			    		<center>
                    		<table cellspacing="0" cellpadding="0" border="0">
                       			<tr>                            
									<td style="padding:5px" align="center"><input type="submit" name="saveinfo" value="Сохранить" class="save"/></td>
                        		</tr>
                    		</table>
                    	</center>
  					
  					</div>  			
  				</form>
  				
  				<form name="userregistrationform" id="userregistrationform" action="." method="POST">
  					<div id="tabs-2">
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
							<tr>
	    						<td >&#160;</td>
	    						<td>e-mail*</td>
	    						<td><input type="text" name="email" value='{@email}' maxlength="30"/></td>
	    						<td >&#160;</td>
	    					</tr>
	    					
	    					<tr height = "2px"><td></td></tr>
	    		
	    					<tr>
	    						<td >&#160;</td>
	    						<td></td>
	    						<td><input type="checkbox" name="notify" checked = "checked"/>получать уведомления</td>
	    						<td >&#160;</td>
	    					</tr>
						</table>
							
						<input type="hidden" name="action" value="user-editinfo" />
						<br/>
							
						<center>
                    		<table cellspacing="0" cellpadding="0" border="0">
                        		<tr>                            
                           			<td style="padding:5px" align="center"><input type="submit" name="save-notification" value="Сохранить" class="save"/></td>
                       			</tr>
                   			</table>
                    	</center>
					</div>
				</form>
				
				<form name="userregistrationform" id="userregistrationform" action="." method="POST">
  				<div id="tabs-3">
					<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tr>
	    					<td>&#160;</td>
	    					<td>Новый пароль</td>
	    					<td><input type="password" name="new_password" value="" maxlength="15"/></td>
	    					<td >&#160;</td>
	    				</tr>
	    				
	    				<tr height = "4px"><td></td></tr>
	    				
	    				<tr>
	    					<td>&#160;</td>
	    					<td>Новый пароль (еще раз)</td>
	    					<td><input type="password" name="new_password_copy" value="" maxlength="15"/></td>
	    					<td>&#160;</td>
	    				</tr>
					</table>
  							
  					<input type="hidden" name="action" value="user-editinfo" />
  					<br/>
  							
					<center>
                    	<table cellspacing="0" cellpadding="0" border="0">
                        	<tr>                            
                           		<td style="padding:5px" align="center"><input type="submit" name="save-password" value="Сохранить" class="save"/></td>
                       		</tr>
                   		</table>
                    </center>
				</div>	 
				</form>   	
	    	</div>
	    	
	    </div>
    </xsl:template>
    
    <xsl:template match="Messages">
    	<i>
    		<xsl:apply-templates select="Message" />
    	</i>
    </xsl:template>
    
    <xsl:template match="Message">
    	<xsl:choose>
    		<xsl:when test="@code = 'new-user-message'">
    			Здравствуйте! Вы регистрируетесь как новый пользователь. Введите желаемый логин, пароль, подтверждение пароля и код с картинки.
    		</xsl:when>
    		<xsl:when test="@code = 'user-edit-errors-message'">
    			При заполнении формы вы допустили некоторые ошибки. Исправьте их и попробуйте отправить данные еще раз.
    		</xsl:when>
    		<xsl:when test="@code = 'user-edit-successfull-message'">
    			Данные сохранены! Вы можете продолжить работу в Личном кабинете.
    		</xsl:when>
    	</xsl:choose>
    </xsl:template>
    
    <xsl:template match="Errors">
    	<ul>
    		<xsl:apply-templates select="Error" />
    	</ul>
    </xsl:template>
    
    <xsl:template match="Error">
    	<xsl:choose>
    		<xsl:when test="@code = 'password-and-copy-not-same-error'">
    			<li>Пароль и его подтверждение не совпадают. Вводите пароль внимательнее.</li>
    		</xsl:when>
    		<xsl:when test="@code = 'password-too-short-error'">
    			<li>Пароль слишком короткий. Пароль должен быть длиннее 3 символов.</li>
    		</xsl:when>
    		<xsl:when test="@code = 'second_name-non-exist-error'">
    			<li>Не заполенно поле "Фамилия".</li>
    		</xsl:when>
    		<xsl:when test="@code = 'first_name-non-exist-error'">
    			<li>Не заполенно поле "Имя".</li>
    		</xsl:when>
    		<xsl:when test="@code = 'email-non-exist-error'">
    			<li>Не указан e-mail.</li>
    		</xsl:when>
    		<xsl:when test="@code = 'email-not-correct-error'">
    			<li>Указан неправильный e-mail.</li>
    		</xsl:when>
    		<xsl:when test="@code = 'password-not-exist-error'">
    			<li>Не заполнено поле "Пароль".</li>
    		</xsl:when>
    		<xsl:when test="@code = 'captcha-not-valid'">
    			<li>Не верно введен код с картинки.</li>
    		</xsl:when>
    	</xsl:choose>
    </xsl:template>
    
</xsl:stylesheet>