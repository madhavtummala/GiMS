<!DOCTYPE html>
<?php 
require_once 'includes/header.php'; 
$sql = "SELECT * FROM calevents";
$result = $connect->query($sql);
$output = array();
while($row = $result->fetch_array())
{
	$temp = array($row[0],$row[1],$row[2]);
	array_push($output, $temp);
}
?>
<script>
var events = [
<?php for ($i=0; $i <count($output); $i++) { ?> 
{
     title: '<?php echo $output[$i][0]; ?>',
     start: '<?php echo $output[$i][1]; ?>',
     end: '<?php echo $output[$i][2]; ?>'
},
<?php } ?>
]
</script>
<html lang='en'>
  <head>
    <meta charset='utf-8' />

    <link href='custom/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='custom/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />

    <script src='custom/fullcalendar/packages/core/main.js'></script>
    <script src='custom/fullcalendar/packages/daygrid/main.js'></script>
<style>
html, body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

#calendar {
  max-width: 900px;
  margin: 40px auto;
}
</style>

<!---Modal starts-->

 <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==-2) { ?>
    <div class="modal fade" id="returnBrandModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="returnBrandForm" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Event</h4>
                    </div>
                    <div class="modal-body">

                        <div id="return-brand-messages"></div>

                        <div id="return-brand-result">

                            <div class="form-group">
                                <label for="returnNo" class="col-sm-3 control-label">Enter Event Name </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="returnNo" placeholder="Event Name" name="returnNo" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="returnFine" class="col-sm-3 control-label">Start date </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="returnFine" placeholder="Enter a date in YYYY-MM-DD format" name="returnFine" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="returnFine2" class="col-sm-3 control-label">End date </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="returnFine2" placeholder="Enter a date in YYYY-MM-DD format" name="returnFine2" autocomplete="off">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer returnBrandFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="returnBrandBtn" data-loading-text="Loading..." autocomplete="off">Add event</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php } ?>


<!--Modal ends-->


    <script>

      document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
    defaultView: 'dayGridMonth',
    defaultDate: '2019-11-07',
    header: {
      left: 'prev,next today',
      center: 'addEventButton',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
	<?php if ($_SESSION['userId'] == -2) {
	echo "
	customButtons: {
      addEventButton: {
        text: 'Add event',
        click: function() {
          //var dateStr = prompt('Enter a date in YYYY-MM-DD format');
		  $('#returnBrandModel').modal('show');
		  $('#returnBrandBtn').click(function () {
			  var textFieldVal = $('input[name=\"returnNo\"]').val();
			  var textFieldVal2 = $('input[name=\"returnFine\"]').val();
			  var textFieldVal3 = $('input[name=\"returnFine2\"]').val();
			  $.ajax({
				url: 'php_action/addCalendar.php',
				type: 'post',
				data: {a:textFieldVal,b:textFieldVal2,c:textFieldVal3},
				dataType: 'json',
				success:function(response) {
					console.log(response.output);
					var a = response.output;
					for(var i = 0; i < a.length; i++)
					{
						var ename = a[i][0];
						var sdate = new Date(a[i][1] + 'T00:00:00');
						var edate = new Date(a[i][2] + 'T00:00:00');
						calendar.addEvent({
						title: ename,
						start: sdate,
						end: edate
						});
					}
				}
        });
	});
          
        }
      }
    },
	events: events,
  });";
  }
  else
  {
	  echo "
	customButtons: {
      addEventButton: {
        text: 'Hi, student'
	  }
	},
	events: events,
  });";
  }
  ?>
  calendar.render();
});
    </script>
  </head>
  <body>

    <div id='calendar'></div>

  </body>
</html>
<?php require_once 'includes/footer.php'; ?>
<!--,
    events: [
      {
        title: 'All Day Event',
        start: '2019-11-01'
      },
	  {
        title: 'Small Day Event',
        start: '2019-11-02',
		end: '2019-11-02T14:30:00'
      },
      {
        title: 'Long Event',
        start: '2019-11-07',
        end: '2019-11-10'
      },
      {
        groupId: '999',
        title: 'Repeating Event',
        start: '2019-11-09T16:00:00'
      },
      {
        groupId: '999',
        title: 'Repeating Event',
        start: '2019-11-16T16:00:00'
      },
      {
        title: 'Conference',
        start: '2019-11-11',
        end: '2019-11-13'
      },
      {
        title: 'Meeting',
        start: '2019-11-12T10:30:00',
        end: '2019-11-12T12:30:00'
      },
      {
        title: 'Lunch',
        start: '2019-11-12T12:00:00'
      },
      {
        title: 'Meeting',
        start: '2019-11-12T14:30:00'
      },
      {
        title: 'Birthday Party',
        start: '2019-11-13T07:00:00'
      },
      {
        title: 'Click for Google',
        url: 'http://google.com/',
        start: '2019-11-28'
      }
    ]-->