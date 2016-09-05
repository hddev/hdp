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
        <br/>
        <xsl:apply-templates select="StatisticsData"/>
    </xsl:template>

    <xsl:template match="StatisticsData">       						
		<xsl:apply-templates select="CompletedWorks"/> 							
    </xsl:template>

    <xsl:template match="CompletedWorks">
        
        <table cellspacing="0" cellpadding="0" border="1" style="background-color:white; border:1px solid #676767; border-width:thin" width="80%" align="center">
			<tr style="border:1px solid #E3E3E3; border-width:thin; text-align:center; font-weight: bold;">
                <td width="10px" style="border:1px solid #E3E3E3; border-width:thin">#</td>
                <td width="40px" style="border:1px solid #E3E3E3; border-width:thin">Номер запроса</td>
                <td width="40px" style="border:1px solid #E3E3E3; border-width:thin">Дата запроса</td>
                <td width="60px" style="border:1px solid #E3E3E3; border-width:thin">Автор</td>
                <td width="30px" style="border:1px solid #E3E3E3; border-width:thin">Время исполнения</td>
                <td width="40px" style="border:1px solid #E3E3E3; border-width:thin">Дата исполнения</td>
               	<td width="60px" style="border:1px solid #E3E3E3; border-width:thin">Исполнитель</td>
               	<td width="60px" style="border:1px solid #E3E3E3; border-width:thin">Комментарий</td>
            </tr>	                           	            
            <xsl:apply-templates select="CompletedWork"/>
        </table>
    </xsl:template>

    <xsl:template match="CompletedWork">
        <tr style="border:1px solid #E3E3E3; border-width:thin; text-align:center;">
            <td style="border:1px solid #E3E3E3; border-width:thin">
                <xsl:value-of disable-output-escaping="yes" select="position()"/>
            </td>
            <td style="border:1px solid #E3E3E3; border-width:thin">
            	<a href="/requests?action=request-form&amp;id={@request_id}" target="_blank">
                <xsl:value-of disable-output-escaping="yes" select="@request_number"/></a>
            </td>
            <td style="border:1px solid #E3E3E3; border-width:thin">
                <xsl:value-of disable-output-escaping="yes" select="@request_date"/>
            </td>

            <td style="border:1px solid #E3E3E3; border-width:thin">
                <xsl:value-of disable-output-escaping="yes" select="@author_secondname"/>&#160;
                <xsl:value-of disable-output-escaping="yes" select="substring(@author_firstname,1,1)"/>.
                <xsl:value-of disable-output-escaping="yes" select="substring(@author_patronymic,1,1)"/>.
            </td>

            <td style="border:1px solid #E3E3E3; border-width:thin">
                <xsl:value-of disable-output-escaping="yes" select="@works_period"/>
            </td>
            <td style="border:1px solid #E3E3E3; border-width:thin">
                <xsl:value-of disable-output-escaping="yes" select="@works_date_end"/>
            </td>
            <td style="border:1px solid #E3E3E3; border-width:thin">
                <xsl:value-of disable-output-escaping="yes" select="@executor_secondname"/>&#160;
                 <xsl:value-of disable-output-escaping="yes" select="substring(@executor_firstname,1,1)"/>.
                <xsl:value-of disable-output-escaping="yes" select="substring(@executor_patronymic,1,1)"/>.
            </td>
            <td style="border:1px solid #E3E3E3; border-width:thin">
				<xsl:value-of disable-output-escaping="yes" select="@works_comment"/>                        
            </td>
                        
        </tr>
    </xsl:template>

</xsl:stylesheet>