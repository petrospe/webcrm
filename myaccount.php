<?php
session_start(); 
if (!isset($_SESSION['user']))
 {
 header("Location: login.php");
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
<?php
require "config.php";
$title=mysql_query("SELECT programtitle,officetitle,officetime,officewhether,version FROM settings WHERE id=1");
$programtitle = mysql_fetch_array($title);
echo $programtitle['programtitle'];
?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="css/jquery-ui.custom.css" />
<link rel='stylesheet' type='text/css' href='css/fullcalendar.css' />
<link href="css/jquery.zweatherfeed.css" rel="stylesheet" type="text/css" />
<link href="css/programstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
<script type="text/javascript">
$(function(){

        // Accordion
        $("#accordion").accordion({ header: "h3" });
  
        // Tabs
$('#tabs').tabs({
      ajaxOptions: {
        error: function( xhr, status, index, anchor ) {
          $( anchor.hash ).html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        }
      }
    });
  
        // Dialog      
        $('#dialog').dialog({
          autoOpen: false,
          width: 600,
          buttons: {
            "Ok": function() { 
              $(this).dialog("close"); 
            }, 
            "Cancel": function() { 
              $(this).dialog("close"); 
            } 
          }
        });
        
        // Dialog Link
        $('#dialog_link').click(function(){
          $('#dialog').dialog('open');
          return false;
        });

        // Datepicker
        $('#datepicker').datepicker({
          inline: true
        });
        
        // Slider
        $('#slider').slider({
          range: true,
          values: [17, 67]
        });
        
        // Progressbar
        $("#progressbar").progressbar({
          value: 20 
        });
        
        //hover states on the static widgets
        $('#dialog_link, ul#icons li').hover(
          function() { $(this).addClass('ui-state-hover'); }, 
          function() { $(this).removeClass('ui-state-hover'); }
        );
        
      });
</script>
<script type='text/javascript' src='js/fullcalendar.min.js'></script>
<script type='text/javascript'>
 
  $(document).ready(function() {
    
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    var calendar = $('#calendar').fullCalendar({
       eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
       if (!confirm("Are you sure about this change?")) {
            revertFunc();
        }
         else {
             $.post("ajaxrequests.php", { task: 'updateTime', timeChange: minuteDelta, eventSent:event} );
            calendar.fullCalendar( 'refetchEvents' );
         }
       },
       eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
        
       if (!confirm("Are you sure about this change?")) {
            revertFunc();
        }
         else {
           $.post("ajaxrequests.php", { task: 'update', dayChange: dayDelta, timeChange: minuteDelta, eventSent:event} );
           calendar.fullCalendar( 'refetchEvents' );
         }

    },
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      selectable: true,
      selectHelper: true,
      select: function(start, end, allDay) {
         var title = prompt('Event Title:');
        if (title) {
          var dt=$.fullCalendar.formatDate( start, 'yyyy-MM-dd H:mm:ss' ) ; 
         
          $.post("ajaxrequests.php", { task: 'create', title: title, dt: dt} );
          calendar.fullCalendar('renderEvent',
            { 
              title: title,
              start: start,
              end: end,
              allDay: allDay
            },
            true // make the event "stick"
          );
         
        }
        calendar.fullCalendar('unselect');
        calendar.fullCalendar( 'refetchEvents' );
      },
          
      editable: true,
      events: 'json-events.php',
      
     
      
      loading: function(bool) {
        if (bool) $('#loading').show();
        else $('#loading').hide();
      }
    });
    
  });

</script>
<script type="text/javascript">
$(function(){
        //logo
        $("#logo").load('logo.php');
  
        //header buttons
        $("#button").button();
$("#button").css({ height: '25px', 'padding-top': '0px', 'padding-bottom': '2px' });

        $("#button-2").button();
$("#button-2").css({ width: '120px', height: '25px', 'padding-top': '0px', 'padding-bottom': '2px' });
  
  //section buttons
$("#button-3").button();
$("#button-4").button();
$("#button-5").button();
$("#button-6").button();
   });
</script>
<script type="text/javascript">
function popup(url)
{
 var width  = 500;
 var height = 200;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
</script>
<script type="text/javascript" src="js/jquery.MyDigitClock.js"></script>
<script src="js/jquery.zweatherfeed.min.js" type="text/javascript"></script> 
</head>
<body>
<?php include "header.php"; ?>

<?php $module=mysql_query("SELECT descr FROM modules");?>

<div class="myaccount">

<div id="tabs">
    <ul>
        <li><a href="#tabs-1"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li> 
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-1">
<p align='center'><a href='#' onclick='window.location.reload( true );'><img src="images/page_refresh.png" title="Refresh Calendar" alt="Refresh Calendar" /></a></p>
<div id='calendar'></div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>