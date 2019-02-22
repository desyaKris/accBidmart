<!-- <!DOCTYPE html>

<html>

<head>

  <title>Laravel Bootstrap Timepicker</title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

</head>

<body>

<div class="container">

    <h1>Laravel Bootstrap Timepicker</h1>

    <div style="position: relative">

      <strong>Timepicker:</strong>

      <input class="timepicker form-control" type="text">

    </div>

</div>

<script type="text/javascript">

    $('.timepicker').datetimepicker({

        format: 'HH:mm:ss'

    });

</script>

</body>

</html> -->


<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">


      <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css"> -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
      <style>
    .container1 {
                width: 60%;
                float:left;
                 background-color:grey;
                 padding: 10px

    }
    .fullkolom1 {
                height: auto;
                width:100%;
                float:left;
                background-color:blue;
    }
    .kolom1 {

                width:14%;
                float:left;
    }
    .kolom2 {
                width:43%;
                float:left;
    }
    .kolom3 {
                width:43%;
                float:left;
                height: auto;
    }
</style>
    </head>
    <body>


      <div class="container1">

        <div class="fullkolom1">
          <div class="kolom1" align="left">
            <label>Area Lelang</label>
            <br>
            <label for="">Balai Lelang</label>
            <br>
            <label for="">Event Name</label>
            <br>

          </div>

          <div class="kolom2">
            <select class="form-control" name="AreaLelang" required>

            </select>
            <br>
            <select class="form-control" name="BalaiLelang" required>

            </select>
            <br>
              <input type="text" class="form-control1" name="EventName" required/>
            <br>
              <input type="datetime-local" name="StartDate" required> <input type="datetime-local" name="EndDate" required>
            <br>
          </div>
          <form action="{{url('/CreateOnlineEvent')}}"  method="get">

              <label>Open House Date</label>
              <br>
              <input type="datetime-local" class="date" name="OpenHouseStartDate" required> <input type="datetime-local" name="OpenHouseEndDate" required>
              <br>
              <br>
              <input type="text" style="display:none"  name="AddDate" value="<?php echo date('d-M-Y H:i:s');?>">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </form>
        </div>

      <div class="kolom1" align="left">
        <label>Event Date</label>
        <br>
        <br>
        <label>StartDate</label>
      </div>
      <div class="kolom2">
        <div class='input-group date' id='start_date_picker'>
          <input type='text' class="form-control"  name="StartDate"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
        <br>
        <div class='input-group date' id='start_date_picker'>
          <input type='text' class="form-control" name="OpenHouseStartDate"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>

      <div class="kolom3">
        <div class='input-group date' id='end_date_picker'>
          <input type='text' class="form-control" name="EndDate"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
        <br>

        <div class='input-group date' id='end_date_picker'>
          <input type='text' class="form-control" name="OpenHouseEndDate"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>

      </div>
            <script type="text/javascript">
								$(function () {
							  $('#start_date_picker').datetimepicker({
								 	    format: 'D-MMM-Y HH:MM:SS',
								 	  });
							  $('#end_date_picker').datetimepicker({
								 	    format: 'D-MMM-Y HH:MM:SS',
								 	  });
							});

							$('#start_date_picker').on('dp.change', function (e) {

							    let eventStartDate = moment(e.date, 'DD/MM/YYYY');
							    let minEventEndDate = eventStartDate.clone().add(1, 'days').startOf('day');
							    let maxEventEndDate = eventStartDate.clone().add(30, 'days').endOf('day');

							    $('#end_date_picker').data("DateTimePicker").clear();
							    $('#end_date_picker').data("DateTimePicker").maxDate(maxEventEndDate);
							    $('#end_date_picker').data("DateTimePicker").minDate(minEventEndDate);
							});
            </script>


    </body>
    </html>
