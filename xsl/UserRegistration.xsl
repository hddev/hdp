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
            <xsl:apply-templates select="/UserData"/>
    </xsl:template>
  
    
    <xsl:template match="UserData">
    	<xsl:apply-templates select="Messages" />
    	<xsl:apply-templates select="Errors" />
    	<xsl:if test="@show_form = 1">
    	<form name="userregistrationform" id="userregistrationform" action="." method="POST">
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="2">Регистрация нового пользователя</th>
    		</thead>
    		<tr>
    			<td width="150">Логин*</td>
    			<td><input type="text" name="login" value="{@login}" maxlength="20"/></td>
    		</tr>
    		<tr>
    			<td>Пароль*</td>
    			<td><input type="password" name="password" value="" maxlength="15"/></td>
    		</tr>
    		<tr>
    			<td>Пароль (еще раз)*</td>
    			<td><input type="password" name="password_copy" value="" maxlength="15"/></td>
    		</tr>
    		<tr><td><BR /></td></tr>
    		<tr>
    			<td>e-mail*</td>
    			<td><input type="text" name="email" value="" maxlength="30"/></td>
    		</tr>
    		<tr><td><BR /></td></tr>
    		<tr>
    			<td>Фамилия*</td>
    			<td><input type="text" name="second_name" value="" maxlength="15"/></td>
    		</tr>
    		<tr>
    			<td>Имя*</td>
    			<td><input type="text" name="first_name" value="" maxlength="10"/></td>
    		</tr>
    		<tr>
    			<td>Отчество</td>
    			<td><input type="text" name="patronymic" value="" maxlength="15"/></td>
    		</tr>
    		<tr><td><BR /></td></tr>
    		<tr>
    			<td>Доступ к Системе дистанционного обучения RCM3?</td>
    			<td><input type="checkbox" name="allow_rcm" checked="checked"/></td>
    		</tr>
    		<tr>
    			<td>Учебная группа</td>
    			<td><input type="text" name="group_name" value="" maxlength="20"/></td>
    		</tr>
    		<tr><td><BR /></td></tr>
    		<tr>
    			<td>
    				Введите код с картинки<br />
    				<img src="/kcaptcha.php?{@sess_name}={@sess_id}&amp;code={@code}" />
    			</td>
    			<td><input type="text" name="keystring" value="" maxlength="10"/></td>
    		</tr>
    		<tr>
    			<td colspan="2"><input type="submit" name="post" value="Зарегистрироваться" /></td>
    		</tr>
    	</table>
    	</form>
    	</xsl:if>
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
    		<xsl:when test="@code = 'user-creation-errors-message'">
    			При заполнении формы вы допустили некоторые ошибки. Исправьте их и попробуйте отправить данные еще раз.
    		</xsl:when>
    		<xsl:when test="@code = 'user-creation-successfull-message'">
    			Вы успешно зарегистрированы! Вы можете продолжить работу в Личном кабинете.
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
    		<xsl:when test="@code = 'login-not-correct'">
    			<li>Логин может состоять из латинских символов, арабских цифр и символа нижнего подчеркивания.</li>
    		</xsl:when>
    		<xsl:when test="@code = 'login-already-exist'">
    			<li>Пользователь с таким логином уже существует, придумайте другой.</li>
    		</xsl:when>
    		<xsl:when test="@code = 'login-not-exist-error'">
    			<li>Не заполнено поле "Логин".</li>
    		</xsl:when>
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