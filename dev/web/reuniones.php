<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title>Foro Argentino de Facultades y Escuelas de Medicina Públicas | Home</title>

        <!-- Included CSS Files (Uncompressed) -->
        <!--
        <link rel="stylesheet" href="stylesheets/foundation.css">
        -->

        <!-- Included CSS Files (Compressed) -->
        <link rel="stylesheet" href="stylesheets/foundation.css">
        <link rel="stylesheet" href="stylesheets/app.css">
        <link rel="stylesheet" href="stylesheets/prettyPhoto.css">
        
		
        <!-- Include CSS for JQuery Frontier Calendar plugin (Required for calendar plugin) -->
        <link rel="stylesheet" type="text/css" href="stylesheets/frontierCalendar/jquery-frontier-cal-1.3.2.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/colorpicker/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/jquery-ui/smoothness/jquery-ui-1.8.1.custom.css" />

        <!--Include JQuery Core (Required for calendar plugin)-->
        <script type="text/javascript" src="javascripts/jquery-core/jquery-1.4.2-ie-fix.min.js"></script>
        <script type="text/javascript" src="javascripts/jquery-ui/smoothness/jquery-ui-1.8.1.custom.min.js"></script>
        <script type="text/javascript" src="javascripts/colorpicker/colorpicker.js"></script>
        <script type="text/javascript" src="javascripts/jquery-qtip-1.0.0-rc3140944/jquery.qtip-1.0.js"></script>
        <script type="text/javascript" src="javascripts/lib/jshashtable-2.1.js"></script>
        <script type="text/javascript" src="javascripts/frontierCalendar/jquery-frontier-cal-1.3.2.min.js"></script>
        <script type="text/javascript" >
            /**
                * Initialize with current year and date. Returns reference to plugin object.
                */
               $(document).ready(
                function() {
                    var calendarId = "reunionesCal";
                    var jfcalplugin = $("#"+calendarId).jFrontierCal({
                        date: new Date(),
                        dragAndDropEnabled: false,
                        agendaClickCallback: myAgendaClickHandler
                    }).data("plugin");
                    
                    showDateMessage();
                    
                    try{
                        
                        $.getJSON('reuniones_list.php',
                        {
                        }, function(response){
                            if(response.status=='OK'){
                                agregaEventos(response.content);
                            }
                        });
                        
                    } catch (e) {
                            alert("Added not agenda",e.message);
                    } 
                    
                function agregaEventos(dataList){
                    try{
                    //http://library.osu.edu/inc/frontierCalendar/calendar.html#AddAgendaItem
                    $.each(dataList,function(idx,item){
                        var jsonItem = JSON.parse(item);
                        var fInicio = new Date(jsonItem.fechaInicio*1000);
                        var fFin = new Date(jsonItem.fechaFin*1000);
                        jfcalplugin.addAgendaItem(
                            "#"+calendarId,
                            jsonItem.titulo,
                            fInicio,
                            fFin,
                            true,
                            {idReunion:jsonItem.idReunion},//data
                            {backgroundColor:"#30a5b0",foregroundColor:null}//displayProp
                        );
                    });
                        
                    }catch(e){
                        console.log("no se pudo agregar a la agenda:"+e.message);
                    }
                }
                /**
                 * Called when user clicks and agenda item
                 * use reference to plugin object to edit agenda item
                 */
               function myAgendaClickHandler(eventObj){
                       // Get ID of the agenda item from the event object
                       var agendaId = eventObj.data.agendaId;		
                       // pull agenda item from calendar
                       var agendaItem = jfcalplugin.getAgendaItemById("#"+calendarId,agendaId);
                       window.open('reunion.php?id='+agendaItem.data['idReunion'],'_self');
               };
               
               /**
                * Initialize previous month button
                */
               $("#BtnPreviousMonth").click(function() {
                       jfcalplugin.showPreviousMonth("#"+calendarId);
                       showDateMessage();
                       return false;
               });
               
               /**
                * Initialize next month button
                */
               $("#BtnNextMonth").click(function() {
                       jfcalplugin.showNextMonth("#"+calendarId);
                       showDateMessage();
                       return false;
               });
               function showDateMessage(){
                   var calDate = jfcalplugin.getCurrentDate("#"+calendarId);// returns Date object
                    var cyear = calDate.getFullYear();
                    // Date month 0-based (0=January)
                    var cmonth = calDate.getMonth();
                    var config = {
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb']
                    };
                    var message = config.monthNames[cmonth] + '-' + cyear; 
                    $("#subToolBar").html(message);
               }
               });

        </script>
		

        <!-- Author -->
        <link type="text/plain" rel="author" href="humans.txt" />

        
    </head>
    <body>
		<!-- Header and Nav -->
        <?php include_once 'header.php'; ?>

        <!-- End Header and Nav -->
        <?php $seccion = "reuniones";
        include_once 'menu_header.php'; ?>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
        <?php
        $navigateTitle = "Reuniones";
        include_once 'navigate.php'
        ?>
        

        <!-- Three-up Content Blocks -->
        <div class="content">
            <div class="row">
                <div class="twelve columns ui-widget">
                    
                    <div id="toolbar" align="center" style="padding:3px; vertical-align: middle; horizontal-align:middle; white-space:nowrap; overflow: hidden;">
	                        <!-- this looks awesome! -->
	                        <div id="subToolBar" align="center"  style="padding:3px; vertical-align: middle; white-space:nowrap; overflow: hidden;"></div>
	                        <br>
	                        <button id="BtnPreviousMonth" class="small button">Mes Anterior</button>
	                        <button id="BtnNextMonth" class="small button">Mes Siguiente</button>
	                    	<br>
	                    
	                    <br>
	                    <!--
	                    You can use pixel widths or percentages. Calendar will auto resize all sub elements.
	                    Height will be calculated by aspect ratio. Basically all day cells will be as tall
	                    as they are wide.
	                    -->
	                    <div id="reunionesCal"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include_once 'footer.php'; ?> 

        <!-- Initialize JS Plugins -->
        <script src="javascripts/jquery.prettyPhoto.js"></script>
        <script src="javascripts/jquery_validate.js"></script>
        <script src="javascripts/app.js"></script>
        <script src="javascripts/init.js"></script>

    </body>
</html>
