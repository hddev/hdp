<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="yes" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml"/>
    
    <xsl:template match="/">
	    <div id="container" class="tab-login">
	    	<form name="login_form" action="." method="POST" style="">
				<table cellspacing="3" cellpadding="0" border="0" align="center" valign="middle" style="color:white;font-weight: bold;a:hover:white; width:100%;">
					<tr height="60px"><td colspan="2" align="center"><img src='/images/logo/logo-sd-1.png' class="logo-sd-auth" /></td></tr>
					<tr><td width="30%" align="right">Логин:</td><td><input type="text" name="login_username" style="width:200px"/></td></tr>
					<tr><td width="30%" align="right">Пароль:</td><td><input type="password" name="login_password" style="width:200px"/></td></tr>
					<tr>
						<td>&#160;</td>
						<td>
							<label>
								<input type="checkbox" name="bRememberMe" id="bRememberMe" value="True" checked="checked"/>Запомнить меня
							</label>
						</td>
					</tr>
					<tr ><td colspan="2" align="center">&#160;</td></tr>
					<tr ><td colspan="2" align="center"><input type="submit" name="login" value="Войти" style="width:150px"/></td></tr>
					<xsl:if test="(//Authorization/Attempt)"><tr><td colspan="2" align="center">Неверный логин или пароль</td></tr></xsl:if>
				</table>
			</form>
		</div>
		<div class="footer_auth">
			<table align="center" style="width:80%; border-top: 1px solid grey">
				<tr><td><center><font color="grey">Разработано ООО "Инфотэк-ИТ" © </font></center></td></tr>
			</table>
		</div>
    </xsl:template>
</xsl:stylesheet>