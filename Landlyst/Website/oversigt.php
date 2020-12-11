<head>
    <title>Landlyst Casino Hotel</title>
    <?php include 'CRM/libaries.php'; ?>  
    <?php include 'CRM/favicon.php'; ?>
</head>

<body>
   <?php include 'CRM\headermenu.php'; ?>
   </div>
   <div class="Body">
      <div class="PageContainer">
         <div id="FilterBar" style="padding-right:40px">
            <div style="height:100%;width:100%;">
               <p id="FilterBarTitle">Søg efter værelser på Landlyst</p>
               <p id="FilterBarDescription">Indtast dine datoer for at se de seneste priser og tilbud for værelser på plandlyst</p>
            </div>
            <div style="height:100%;width:100%;display: flex;align-items: flex-end;justify-content: space-between;">
               <div>
                  <label class="DatePickerLabel">Check-in dato</label>
                  <input oninput="GetAvailableRooms()" value="<?php print date('d/m/Y'); ?>" class="form-control DatePicker" type="text" id="fromDate" class="datepicker" name="updatedDate" />
               </div>
               <div>
                  <label class="DatePickerLabel">Check-in dato</label>
                  <input oninput="GetAvailableRooms()" class="form-control DatePicker" type="text" id="toDate" class="datepicker" name="updatedDate" />
               </div>
               <div>
                  <label class="DatePickerLabel" >Voksne</label>
                  <select oninput="GetAvailableRooms()" class="form-control PersonPicker" id="Adults">
                     <option>1</option>
                     <option>2</option>
                     <option>3</option>
                     <option>4</option>
                     <option>5</option>
                  </select>
               </div>
               <div>
                  <label class="DatePickerLabel">Børn</label>
                  <select oninput="GetAvailableRooms()" class="form-control PersonPicker" data-width="50px" id="Children">
                     <option>0</option>
                     <option>1</option>
                     <option>2</option>
                  </select>
               </div>
            </div>
         </div>
         <div id="RoomsContainer">
         </div>
      </div>
   </div>
</body>


<script>
<?php
// Check if the users has logged in and set a variable in Javascript
if($_SESSION['GuestNumber'] != NULL){
    echo("var IsLoggedIn = true;");
} else{
    print("var IsLoggedIn = false;");
}
?>
</script>


<script>
    //The current reservation number.
    //Makes sure that if multiple reservations is made during the same session 
    //it gets added to the same reservation 
    var ReservationNumber;

    //Set the default setup for the datepickers
    $("#fromDate").datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '-0d',
        changeMonth: true
    }).datepicker("update", "<?php print($_GET["Checkindate"]); ?>"); 
    $("#toDate").datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '-0d',
        changeMonth: true
    }).datepicker("update", "<?php print($_GET["Checkoutdate"]); ?>");
    
    //Show the available rooms
    GetAvailableRooms();
    AOS.init({
        once: true,
    });
</script>