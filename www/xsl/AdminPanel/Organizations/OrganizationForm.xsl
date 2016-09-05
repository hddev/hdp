<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
    	
    	<script language="javascript">
    	var countOfFields = 1;
		var curFieldNameId = 0;
		var maxFieldLimit = 5;
		
		function deleteField(a) {
			//a = 'address' + curFieldNameId;
			alert(curFieldNameId);
			var contDiv = a.parentNode;
			contDiv.parentNode.removeChild(contDiv);
			var Form = document.getElementById('address1');
			Form.InnerHTML = '';
			countOfFields--;
			curFieldNameId++;
			return false;
		}

		function CreateFormElement(){
		
		if (countOfFields >= maxFieldLimit) {
		alert("Число полей достигло своего максимума = " + maxFieldLimit);
		return false;
		}
    
  		countOfFields++;
  		curFieldNameId++;
  		
  		//alert(curFieldNameId);

 		var Form = document.getElementById('dynamic');
 		var Inner = document.createElement('input');
  		Inner.type = 'text';
  		Inner.value = '';
  		Inner.name = 'address' + curFieldNameId;
  		Form.appendChild(Inner);
  		
  		var remove = document.createElement('input');
  		remove.type = 'button';
  		remove.value = 'Удалить поле';
  		remove.onclick = 'deletefield(address1)';
  		Form.appendChild(remove);
  		
 		var Br = document.createElement('br');
  		Form.appendChild(Br);
  		
  		return false;
		}
		</script>
    	
    	<xsl:apply-templates select="/Organization"/>
    </xsl:template>
  
    
    <xsl:template match="Organization">
    <xsl:variable name="id" select="@id" />
    	<div id="adminpanel-content">
    	<form name="OrganizationForm" id="ajaxform" action="." method="POST">
    	<input  name="id" type="hidden" value="{@id}" />
    	
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="4">Редактирование карточки организации</th>
    		</thead>
    		
    		<tr>
    			<td class="first"></td>
    			<td width="150">Наименование организации</td>
    			<td><input type="text" name="name" value="{@name}"/></td>
    			<td class="last"></td>
    		</tr>
    		
            <tr>
    			<td class="first"></td>
    			<td width="150">Краткое наименование организации</td>
    			<td><input type="text" name="short_name" value="{@short_name}"/></td>
    			<td class="last"></td>
    		</tr>
    		    		
    		<tr class="even">
    			<td class="first"></td>
    			<td>Описание</td>
    			<td><input type="text" name="description" value="{@description}"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		
    		<tr>
    			<!--  
    			<td class="first"></td>
    			<td>Адреса</td>
    			<td> 
    			<div id = "dynamic">
				</div>   			
				<input type="button" value="добавить адрес" onClick="CreateFormElement()"/>	<input type="button" value="удалить адрес" onClick="deleteField('address1')"/>			
				</td>
				<td class="last"></td>
				-->
			</tr>

    		    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="exit" value="Отмена" /><input type="submit" name="saveandedit" value="Применить" /><input type="submit" name="saveandexit" value="Сохранить" /></td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="organization-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>