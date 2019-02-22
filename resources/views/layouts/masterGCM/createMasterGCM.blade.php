@extends('layouts.master')
@section('title','CreateOnlineEvent')
@section('content')
<div id="page-inner">
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">New Master GCM </h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/CreateMasterGCM')}}"  autocomplete="off" method="POST"  enctype="multipart/form-data">
                      {!! csrf_field() !!}
                        <label for="">Condition &emsp;&emsp;</label>
                          <div class="autocomplete" style="width:300px;">
                            <input id="myInput" type="text" oninput="validateAlpha();" name="Condition" placeholder="Type AutoComplete or new condition" required/>
                          </div>
                        <br>
            						<label for="">Char Value 1</label>
                                    <input type="text" class="form-control1" name="CharValue1" required/>
            						<label for="">Char Desc 1</label>
                                    <input type="text" class="form-control1" name="CharDesc1" required/>

            						<label for="">Char Value 2</label>
                                    <input type="text" class="form-control1" name="CharValue2" />
            						<label for="">Char Desc 2</label>
                                    <input type="text" class="form-control1" name="CharDesc2" />

            						<label for="">Char Value 3</label>
                                    <input type="text" class="form-control1" name="CharValue3" />
            						<label for="">Char Desc 3</label>
            						<input type="text" class="form-control1" name="CharDesc3" />

            						<label for="">Char Value 4</label>
                                    <input type="text" class="form-control1" name="CharValue4" />
            						<label for="">Char Desc 4</label>
                                    <input type="text" class="form-control1" name="CharDesc4" />

            						<label for="">Char Value 5</label>
                                    <input type="text" class="form-control1" name="CharValue5" />
            						<label for="">Char Desc 5</label>
                                    <input type="text" class="form-control1" name="CharDesc5" />
            						<br>
            						<div class="form-group">
            							<img id="output" width="30%" height="30%"/>
            							<input type="file" id="exampleInputFile" name="Pict" accept="image/*" onchange="loadFile(event)" />
            						</div>

            						<label>
            						  IsActive
                          <input type="hidden" name="IsActive" value="N">
                          <input type="checkbox" name="IsActive" value="Y" >
            						</label>
            						<br>
            						<br>
                        <label>Time Stamp1</label>
                        <br>
                        <input type="text" style="display:none"  name="AddedDate" value="<?php echo date('d-M-Y H:i:s');?>">

                        <input type="datetime-local" name="TimeStamp1">
                        <br>
                        <label>Time Stamp2</label>
                        <br>
                        <input type="datetime-local" class="date" name="TimeStamp2">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>

                    </form>
                    <a href="/MasterGCM" class="btn btn-primary">Cancel</a>

                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>
<script>

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

function validateAlpha(){
    var textInput = document.getElementById("myInput").value;
    textInput = textInput.replace(/[^A-Za-z_]/g, "");
    document.getElementById("myInput").value = textInput;
}

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = [<?php foreach ($response3 as $dt1): ?>
"{{$dt1['Condition']}}",
<?php endforeach; ?>];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>
@endsection
