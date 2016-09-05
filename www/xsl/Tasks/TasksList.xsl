<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output xmlns="http://www.w3.org/TR/xhtml1/strict" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="utf-8" indent="no" method="html" omit-xml-declaration="no" version="1.0" media-type="text/xml" standalone="no" />
    
    <xsl:template match="/">
        <script language="Javascript" src="/js/tasks.js"></script>



        <div id="tasks-content">
            <h3>Список задач:</h3>
            <ul>
                <li id="task_1"><div id="task_1"><span>Попить чай</span></div></li>
                <li id="task_2"><div id="task_2"><span>Съесть банан</span></div></li>
                <li id="task_3"><div id="task_3"><span>Решить задачку</span></div></li>
                <div id="din1" />
            </ul>
        </div>
    </xsl:template>
          
</xsl:stylesheet>