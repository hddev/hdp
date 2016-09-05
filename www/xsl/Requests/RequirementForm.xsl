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
	            div#users-contain { width: 350px; margin: 20px 0; }
	            div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
	            div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
	        </style>
	        
	        <script>
	        
	        	var v1 = "", v2 = "";
	        	
	            $(function() {
	                $( "#dialog:ui-dialog" ).dialog( "destroy" );
	
	                var student_id = $( "#student_id" ),
	                    number_count = $( "#number_count" ),
	                    startdate = $( "#startdate" ),
	                    enddate = $( "#enddate" ),
	                    note = $( "#note" ),
	                    allFields = $( [] ).add( student_id ).add( number_count ).add( startdate ).add( enddate ).add( note );
	
	                $( "#dialog-form" ).dialog({
	                    autoOpen: false,
	                    height: 510,
	                    width: 500,
	                    modal: true,
	                    buttons: {
	                        "Ok": function() {
	                            var href = "/admin/admin-ajax/?action=unit-transfer-edit&amp;studentmode=" + bUseStudentMode + "&amp;" +
	                                "timetable_id=" + <xsl:value-of disable-output-escaping = "yes" select = "MEPBase/MEPTimetable/@id" /> + "&amp;" +
	                                "timetable_item_id=" + timetable_item_id + "&amp;" +
	                                "schedule_item_id=" + schedule_item_id + "&amp;" +
	                                "students_group_id=" + <xsl:value-of disable-output-escaping = "yes" select = "MEPBase/RCMStudentsGroup/@id" /> + "&amp;" +
	                                "number_count=" + number_count.val() + "&amp;" +
	                                "startdate=" + encodeURIComponent(startdate.val()) + "&amp;" +
	                                "enddate=" + encodeURIComponent(enddate.val()) + "&amp;" +
	                                "note=" + encodeURIComponent(note.val()) + "&amp;" +
	                                "student_id=" + student_id.val();

	                            $("#ajaxloader").show();
	                            $("#jquery_load").load(href,
	                                function(){
	                                    $("#ajaxloader").hide();
	                                });
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
    	
    	<div id ="jquery_load">
	    		<xsl:apply-templates select="Hierarchy"/>        
	            <script language="JavaScript">
	                $(".datetimepickerEx").datetimepicker({
	                    dateFormat: 'yy-mm-dd',
	                    timeFormat: 'hh:mm:ss'
	                });
	            </script>
	        </div>
        
        <div id="dialog-form" title="Добавление элемента">
            <form>
              	<fieldset>
	            	<xsl:apply-templates select="/Requirement"/>
	            </fieldset>
            </form>
        </div>       
		
    </xsl:template>
  
    
    <xsl:template match="Requirement">  
    	<div id="container">
    	<form name="dynamicdataform" id="ajaxform" action="." method="POST">
    	<input type="hidden" name="id" value="{@id}" />
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th colspan="10">Потребность</th>
    		</thead>
    		
    		<tr>
    			<td class="first"></td>
    			<td width="150">Статус</td>
    			<td><input type="text" name="status" value="{@status}"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr class="even">
    			<td class="first"></td>
    			<td>Запрос</td>
    			<td><input type="text" name="request_id" value="{@request_id}"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Наименование</td>
    			<td><input type="text" name="quantity" value="{@quantity}"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Количество</td>
    			<td><input type="" name="date_start" value="{@date_start}"/></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="first"></td>
    			<td>Дата</td>
    			<td><input type="datetime" name="date" value="{@date}"/></td>
    			<td class="last"></td>
    		</tr>
    		    		    		
    		<tr>
    			<td class="first"></td>
    			<td colspan="2"><input type="submit" name="saveandexit" value="Отправить" /><input type="submit" name="cancel" value="Отменить" /></td>
    			<td class="last"></td>
    		</tr>
    		
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="2" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<input type="hidden" name="action" value="requirement-edit" />
    	</form>
    	</div>
    </xsl:template>
    
</xsl:stylesheet>