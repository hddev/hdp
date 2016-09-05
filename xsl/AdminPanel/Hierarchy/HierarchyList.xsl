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
			</script>
			
			<script LANGUAGE="JavaScript" TYPE="text/javascript">
			function doMenuTest(sObjID, sSubObjID) { 
				var nIndex = sObjID.IndexOf(sSubObjID)
				if nIndex != -1 {
  				var subObj = document.all[sSubObjID];
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
	            	<xsl:apply-templates select="Hierarchy"/> 
	            </fieldset>
            </form>
        </div>        
        
    </xsl:template>
    
    <xsl:variable name="nesting" select="0"/>
    
   <xsl:template match="Hierarchy">
    	<div id="adminpanel-content">
    	<form name="staticdata" id="ajaxform" action="." method="POST">
    	<table cellspacing="0" cellpadding="0" border="0">
    		<thead>
    			<th class="first"></th>
    			<th>
    				&#160;
    			</th>
				<th>
    				Наименование&#160;
    				<!-- 
    				<a href="#"><img src="/images/design/arrow-down.png" alt="Сортировать по возрастанию" title="Сортировать по возрастанию" /></a>
    				<a href="#"><img src="/images/design/arrow-up.png" alt="Сортировать по возрастанию" title="Сортировать по убыванию" /></a>
    				 -->
    			</th>
    			<th>
    				Действия
    			</th>
    			<th class="last"></th>
    		</thead>
    		<xsl:apply-templates select="Organizations"/>
    		<tr>
    			<td class="first"></td>
    			<td colspan="3" align="right">
    			<a href="/admin/admin-ajax/?action=organization-form&amp;id=0" class="remote-url"><img src="/images/iicons/add.png" alt="Создать новую организацию" title="Создать новую организацию"/></a>&#160;
                <a href="/admin/admin-ajax/?action=organization-delete&amp;id={@id}" class="remote-url"><img src="/images/iicons/cross.png" alt="Удалить организацию" title="Удалить организацию"/></a>
    			</td>
    			<td class="last"></td>
    		</tr>
    		<tr>
    			<td class="first"></td>
    			<td colspan="3" class="table-seporater"></td>
    			<td class="last"></td>
    		</tr>
    		<xsl:apply-templates select="Pagination"/> 
    		<tr>
    			<td class="bfirst"></td>
    			<td colspan="3" class="bbottom"></td>
    			<td class="blast"></td>
    		</tr>
    	</table>
    	<!--<input type="hidden" name="action" value="organizations-list" />
    	<input type="hidden" name="page" value="{//Pagination/@page}" />-->
    	<input type="hidden" name="action" value="ShowHierarchy" />
    	</form>
    	</div>
   </xsl:template>

	<xsl:template match="Organizations">
		<xsl:apply-templates select="Organization"/>
	</xsl:template>
 
	<xsl:template match="Organization">
		<xsl:variable name="organization_id" select="@id" />
		
		<!-- <xsl:variable name="div_id">o:<xsl:value-of select="$organization_id"/></xsl:variable>  -->
		
    	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "position()"/></td>
			<td>
				<!-- <A HREF="javascript:doMenuTest('{$div_id}');"> -->
				<!-- <img src="/images/iicons/plus.jpg" id = "{$organization_id}"/> --> 
				<xsl:value-of disable-output-escaping = "yes" select = "@name" /> <!--</A>-->
			</td>
    		<td>
    			<a href="/admin/admin-ajax/?action=organization-form&amp;id={@id}" class="remote-url"><img src="/images/iicons/layout_edit.png" alt="Редактировать статический элемент." title="Редактировать статический элемент."/></a>&#160;
    			<a href="/admin/admin-ajax/?action=organization-delete&amp;id={@id}" class="remote-url"><img src="/images/iicons/layout_delete.png" alt="Удалить статический элемент." title="Удалить статический элемент."/></a>&#160;
    			<a href="/admin/admin-ajax/?action=subdepartment-add&amp;id={@id}&amp;parent_type={1}" class="remote-url"><img src="/images/iicons/building_add.png" alt="Добавить подразделение." title="Добавить подразделение."/></a>&#160;
    			<a href="/admin/admin-ajax/?action=subuser-add&amp;id={@id}&amp;parent_type={1}" class="remote-url"><img src="/images/iicons/user_add.png" alt="Добавить пользователя." title="Добавить пользователя."/></a>
    		</td>
    		<td class="last"></td>
    	</tr> 
    	
   		<xsl:apply-templates select="Users">  
   			<!-- <xsl:with-param name="div_id" select="$div_id" />   --> 						
   		</xsl:apply-templates>
   		
   		<xsl:apply-templates select="Departments">
   			<!--<xsl:with-param name="div_id" select="$div_id" />  --> 
   		</xsl:apply-templates>
   		
   		<xsl:apply-templates select="Subordination">
   			<!--<xsl:with-param name="div_id" select="$div_id" /> --> 
   		</xsl:apply-templates>    	

    </xsl:template>
    
    <xsl:template match="Subordination">
    	<!--<xsl:param name="div_id" /> -->
    	
		<xsl:apply-templates select="Users">
			<!--<xsl:with-param name="div_id" select="$div_id" />-->
		</xsl:apply-templates>
			
    	<xsl:apply-templates select="Departments">
    		<!--<xsl:with-param name="div_id" select="$div_id" />-->
    	</xsl:apply-templates>
	</xsl:template>
    
	<xsl:template match="Departments">
		<!-- <xsl:param name="div_id" /> -->
		<xsl:apply-templates select="Department">
			<!-- <xsl:with-param name="div_id" select="$div_id" /> -->
		</xsl:apply-templates>
	</xsl:template>
	
	<xsl:template match="Users">
		<xsl:param name="div_id" />
		<xsl:apply-templates select="User">
			<!-- <xsl:with-param name="div_id" select="$div_id" /> -->
		</xsl:apply-templates>
	</xsl:template>     
    
    <xsl:template match="Department">
    	<xsl:variable name="nesting" select="count(ancestor::Department)+1"/> 
   		<xsl:variable name="department_id" select="@id" />
   		
   		<!-- <xsl:param name="div_id" /> -->
   		 	
    	<!-- <tr id = "{$div_id}">  -->
    	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "position()"/></td>
			<td>
			<div style="text-align:left; padding-left:{$nesting * 20}px">
			&#160;&#160;
				<!-- <A HREF="javascript:doMenuTest({$div_id});"> -->
				<!-- <img src="/images/iicons/plus.jpg" id = "{$department_id}"/>  --> 
				<xsl:value-of disable-output-escaping = "yes" select = "@name" /><!-- </A> -->
			</div>
			</td>
    		<td>
    			<a href="/admin/admin-ajax/?action=department-form&amp;id={@id}" class="remote-url"><img src="/images/iicons/layout_edit.png" alt="Редактировать статический элемент." title="Редактировать статический элемент."/></a>&#160;
    			<a href="/admin/admin-ajax/?action=department-delete&amp;id={@id}" class="remote-url"><img src="/images/iicons/layout_delete.png" alt="Удалить статический элемент." title="Удалить статический элемент."/></a>&#160;
    			<!-- <a onclick="v1={@id}"; $('#dialog-form').dialog( 'open' );"><img src="/images/iicons/cut.png" alt="Переместить статический элемент." title="Переместить статический элемент."/></a>&#160; 
    			<a href="/admin/admin-ajax/?action=unit-transfer&amp;id={@id}&amp;source_type=2" class="remote-url"><img src="/images/iicons/cut.png" alt="Переместить статический элемент." title="Переместить статический элемент."/></a>-->&#160;
    			<a href="/admin/admin-ajax/?action=subdepartment-add&amp;id={@id}&amp;parent_type=2" class="remote-url"><img src="/images/iicons/building_add.png" alt="Добавить подразделение." title="Добавить подразделение."/></a>&#160;
    			<a href="/admin/admin-ajax/?action=subuser-add&amp;id={@id}&amp;parent_type=2" class="remote-url"><img src="/images/iicons/user_add.png" alt="Добавить пользователя." title="Добавить пользователя."/></a>
    		</td>
    		<td class="last"></td>
    	</tr>
    	<!-- <xsl:apply-templates select="Users"/>- -->
    	 
    	
    	<xsl:apply-templates select="Departments">
    		 <!-- <xsl:with-param name="div_id" select="$div_id" />  -->
    	</xsl:apply-templates>
    	
    	<xsl:apply-templates select="Subordination">
    		 <!-- <xsl:with-param name="div_id" select="$div_id" /> -->
    	</xsl:apply-templates>
    	
    	<!--Рекурсивно применяем для каждого вложенного региона этот шаблон-->
		<xsl:apply-templates select="Users">
					
		</xsl:apply-templates>
    		
    </xsl:template>
    
    <xsl:template match="User">
    	<xsl:variable name="nesting" select="count(ancestor::Department)+1"/> 
    	<!-- <xsl:param name="div_id" />   -->
     	<tr>
    		<xsl:if test="(position() mod 2) = 0">
    			<xsl:attribute name="class">even</xsl:attribute>
    		</xsl:if>
    		<td class="first"></td>
    		<td><xsl:value-of disable-output-escaping = "yes" select = "position()"/>-<xsl:value-of select="$nesting"/></td>
			<td>
			<div style="text-align:left; padding-left:{$nesting * 20}px">
			&#160;&#160;
			<xsl:value-of disable-output-escaping = "yes" select = "@secondname" />&#160;			 
			<xsl:value-of disable-output-escaping = "yes" select = "@firstname" />&#160;
			<xsl:value-of disable-output-escaping = "yes" select = "@patronymic" />
			</div>
			
			</td>
    		<td>
    			<a href="/admin/admin-ajax/?action=user-form&amp;id={@id}" class="remote-url"><img src="/images/iicons/layout_edit.png" alt="Редактировать статический элемент." title="Редактировать статический элемент."/></a>&#160;
    			<a href="/admin/admin-ajax/?action=user-delete&amp;id={@id}" class="remote-url"><img src="/images/iicons/layout_delete.png" alt="Удалить статический элемент." title="Удалить статический элемент."/></a>&#160;
    			<!-- 
    			<a href="/admin/admin-ajax/?action=unit-transfer&amp;id={@id}&amp;source_type=3" class="remote-url"><img src="/images/iicons/cut.png" alt="Удалить статический элемент." title="Переместить статический элемент."/></a>
    			 -->
    		</td>
    		<td class="last"></td>
    	</tr>    	
    </xsl:template>
    
    <xsl:template match="Pagination">
    	<xsl:variable name="per_page" select="@per_page" />
    	<xsl:variable name="page" select="@page" />
    	<xsl:variable name="prev_page" select="number(@page)-1" />
    	<xsl:variable name="next_page" select="number(@page)+1" />
    	<xsl:variable name="total_pages" select="@total_pages" />
    	<tr>
    		<td class="first"></td>
    		<td colspan="5" align="right">
    			<div class="pagination"><a href="/admin/admin-ajax/?action=organizations-list&amp;page=0" id="page_prev_start" class="remote-post" style="text-decoration: none;">&lt;&lt;</a></div>
    			<xsl:if test="@page &gt; 0">
    				<div class="pagination"><a href="/admin/admin-ajax/?action=organizations-list&amp;page={$prev_page}" id="page_prev" class="remote-post" style="text-decoration: none;">&lt;</a></div>
    			</xsl:if>
    			<xsl:call-template name="page">
    				<xsl:with-param name="i" select="0"/>
    				<xsl:with-param name="current" select="@page"/>
    				<xsl:with-param name="max" select="@total_pages"/>
    			</xsl:call-template>
    			<xsl:if test="@page &lt; @total_pages">
    				<div class="pagination"><a href="/admin/admin-ajax/?action=organizations-list&amp;page={$next_page}" id="page_next" class="remote-post" style="text-decoration: none;">&gt;</a></div>
    			</xsl:if>
    			<div class="pagination"><a href="/admin/admin-ajax/?action=organizations-list&amp;page={@total_pages}" id="page_next_end" class="remote-post" style="text-decoration: none;">&gt;&gt;</a></div>
    			<select name="per_page" id="per_page" onchange="LoadContentWFormPost();">
    				<option value="1"><xsl:if test="$per_page = 1"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>1</option>
    				<option value="5"><xsl:if test="$per_page = 5"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>5</option>
    				<option value="10"><xsl:if test="$per_page = 10"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>10</option>
    				<option value="20"><xsl:if test="$per_page = 20"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>20</option>
    				<option value="30"><xsl:if test="$per_page = 30"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>30</option>
    				<option value="40"><xsl:if test="$per_page = 40"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>40</option>
    				<option value="50"><xsl:if test="$per_page = 50"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>50</option>
    				<option value="100"><xsl:if test="$per_page = 100"><xsl:attribute name="selected">selected</xsl:attribute></xsl:if>100</option>
    			</select>
    		</td>
    		<td class="last"></td>
    	</tr>
    </xsl:template>
    
    <xsl:template name="page">
    	<xsl:param name="i" />
    	<xsl:param name="current" />
    	<xsl:param name="max" />
    	<xsl:variable name="last_visible" select="number($current)+3"/>
    	<xsl:variable name="first_visible" select="number($current)-3"/>
    	
    	<xsl:if test="$first_visible &gt; 0 and $i = $first_visible"><div class="pagination">...</div></xsl:if>
    	<xsl:if test="$i = 0 or $i = $max or ($i &gt; $first_visible and $i &lt; $last_visible)">
    		<div class="pagination"><xsl:if test="$i = $current"><xsl:attribute name="style">background-color: #ccd74f;</xsl:attribute></xsl:if><a href="/admin/admin-ajax/?action=rcm-students-list&amp;page={$i}" id="page{$i}" class="remote-post">
    			<xsl:if test="$i = $current"><xsl:attribute name="style">font-weight: bold;</xsl:attribute></xsl:if>
    			<xsl:value-of disable-output-escaping = "yes" select="$i+1" />
    		</a></div>
    	</xsl:if>
    	<xsl:if test="$last_visible &lt; $max and $i = $last_visible"><div class="pagination">...</div></xsl:if>
    		<xsl:if test = "$i &lt; $max">
    			<xsl:call-template name="page">
    				<xsl:with-param name="i" select="$i+1"/>
    				<xsl:with-param name="max" select="$max"/>
    				<xsl:with-param name="current" select="$current"/>
    			</xsl:call-template>
    		</xsl:if>
    	
    </xsl:template>    
</xsl:stylesheet>