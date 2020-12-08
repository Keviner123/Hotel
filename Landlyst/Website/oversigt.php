<head>
    <title>Landlyst Casino Hotel</title>
    <?php include 'libaries.php'; ?>

    
    
    <script>
    var ReservationNumber;

    function ConverteDate(BootstrapTime){
            var Time = BootstrapTime.split('/');
            Time.reverse();
            return(Time.join("-"));
    }

    async function CreateReservation(RoomNumber) {
        
        return new Promise(function(resolve, reject) {
            var form = new FormData();

            var ArrivalDate = ConverteDate($("#fromDate")[0].value);
            var Depaturedate = ConverteDate($("#toDate")[0].value);

            form.append("ArrivalDate", ArrivalDate);
            form.append("Depaturedate", Depaturedate);

            var settings = {
                "url": "/Endpoints/createreservation.php",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "data": form,
                "contentType": false,
            };

            $.ajax(settings).done(function(response) {
                resolve(response)
            });
        })
    }

    async function AttachRoomToReservation(RoomNumber, self) {
        if(IsLoggedIn){

            self.disabled=true;

            //Check if its the users first reservation and create a booking request if it is.
            if(ReservationNumber == null){
                ReservationNumber = await CreateReservation(RoomNumber);
                }

                var form = new FormData();
                form.append("ReservationNumber", ReservationNumber);
                form.append("RoomNumber", RoomNumber);

                var settings = {
                "url": "/Endpoints/attatchroomtoreservation.php",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
                };

                $.ajax(settings).done(function (response) {
                    if(response == 1){
                        new Toastify({
                            text: "Rum tildelt din booking",
                            duration: 5000,
                            backgroundColor: "#28a745",
                        }).showToast();
                    } 
                });
            }
        else{
            new Toastify({
                        text: "Du skal være logget ind for at booke et værelse.",
                        duration: 5000,
                        backgroundColor: "#c82506",
                    }).showToast();
        }
    }

    function GetRooms(Guests){
    var form = new FormData();
    form.append("MaxGuests", Guests);

    form.append("ArrivalDate", ConverteDate($("#fromDate")[0].value));
    form.append("Depaturedate",  ConverteDate($("#toDate")[0].value));

    var settings = {
    "url": "/Endpoints/getrooms.php",
    "method": "POST",
    "timeout": 0,
    dataType: "json",
    "processData": false,
    "mimeType": "multipart/form-data",
    "contentType": false,
    "data": form,
    };

    $.ajax(settings).done(function (response) {
        var DelayTime = 0;
        for (let index = 0; index < response.length; index++) {
            Attributes = (response[index].Attributes.join(", "));
            
            //Add a delay that resets every fifth row.
            //This ensures that the boxes will load in smootly
            if(DelayTime == 150*5){
                DelayTime = 0;
            }
            DelayTime += 150;
            CreateRoomContainer(response[index].RoomName, response[index].RoomNumber, response[index].MaxGuests, Attributes, parseInt(response[index].Rate)+response[index].AttributesPrices,DelayTime);
        }


        //Round up to the nearest 5 and get if enough containers has been made.
        //If not we add enough so that the flexbox will show them correctly.
        for (let i = 0; i < (Math.ceil(response.length / 5) * 5) - response.length; i++) {
            CreateEmptyRoomContainer();
        }
    });


    }

    function ClearRooms(){
        $( "#RoomsContainer" )[0].innerHTML = '';
    }

    function CreateRoomContainer(RoomName, RoomNumber, MaxGuests, Attributes, Rate, DelayTime) {
          var RoomContainer = document.createElement('div');
          RoomContainer.className = "RoomContainer";
          RoomContainer.setAttribute('data-aos', "slide-up");
          RoomContainer.setAttribute('data-aos-duration', DelayTime);

          var RoomImageContainer = document.createElement('img');
          RoomImageContainer.className = "RoomImageContainer";
          RoomImageContainer.src = "Assets/Images/Rooms/"+RoomNumber+".jpg"
          RoomContainer.appendChild(RoomImageContainer);

          var RoomDescriptionContainer = document.createElement('div');
          RoomDescriptionContainer.className = "RoomDescriptionContainer";
          RoomContainer.appendChild(RoomDescriptionContainer);

          var RoomDescriptionContainerInside = document.createElement('div');
          RoomDescriptionContainerInside.style = "display: flex;flex-direction: column;width:90%";
          RoomDescriptionContainer.appendChild(RoomDescriptionContainerInside);

          var RoomDescriptionTitle = document.createElement('p');
          RoomDescriptionTitle.className = "RoomDescriptionTitle";
          RoomDescriptionTitle.textContent = RoomName;
          RoomDescriptionContainerInside.appendChild(RoomDescriptionTitle);

          var RoomDescriptionMaxGuests = document.createElement('p');
          RoomDescriptionMaxGuests.className = "RoomDescriptionText";
          RoomDescriptionMaxGuests.textContent = MaxGuests+" gæster";
          RoomDescriptionContainerInside.appendChild(RoomDescriptionMaxGuests);

          var RoomDescriptionAttributes = document.createElement('p');
          RoomDescriptionAttributes.className = "RoomDescriptionText";
          RoomDescriptionAttributes.textContent = Attributes;
          RoomDescriptionContainerInside.appendChild(RoomDescriptionAttributes);

          var PricerContainer = document.createElement('div');
          PricerContainer.style="display: flex;flex-direction: column;width:90%";
          RoomDescriptionContainer.appendChild(PricerContainer);

          var PricerContainerText = document.createElement('p');
          PricerContainerText.className = "RoomDescriptionTitle";
          PricerContainerText.style="font-size:15px";
          PricerContainerText.textContent = "Pris pr. dag: "+Rate+" kr.";
          PricerContainer.appendChild(PricerContainerText);

          var BookingButton = document.createElement('button');
          BookingButton.style= "width: 125px;";
          BookingButton.type = "button";
          BookingButton.className = "btn btn-success shadow-none";
          BookingButton.textContent= "Book værelse";
          BookingButton.onclick = function() {AttachRoomToReservation(RoomNumber, this);};
          RoomDescriptionContainer.appendChild(BookingButton);

          $( "#RoomsContainer" )[0].appendChild(RoomContainer);
    }

    function CreateEmptyRoomContainer() {
          var RoomContainer = document.createElement('div');
          RoomContainer.className = "RoomContainer";
          RoomContainer.style = "visibility: collapse;";
          $( "#RoomsContainer" )[0].appendChild(RoomContainer);
    }


    </script>

</head>

<body>
   <?php include 'header.php'; ?>
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
                    <label class="DatePickerLabel" for="exampleIn½utEmail1">Check-in dato</label>
                    <input oninput="GetAvailableRooms()" value="<?php print date('d/m/Y'); ?>" class="form-control DatePicker" type="text" id="fromDate" class="datepicker" name="updatedDate" />
                </div>
                <div>
                    <label class="DatePickerLabel" for="exampleInputEmail1">Check-in dato</label>
                    <input oninput="GetAvailableRooms()" class="form-control DatePicker" type="text" id="toDate" class="datepicker" name="updatedDate" />
                </div>
                <div>
                    <label class="DatePickerLabel" for="exampleInputEmail1">Voksne</label>
                    <select oninput="GetAvailableRooms()" class="form-control PersonPicker" id="Adults">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div>
                    <label class="DatePickerLabel"  for="exampleInputEmail1">Børn</label>
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
// Check if the users has logged in and set a variable.
if($_SESSION['GuestNumber'] != NULL){
    echo("var IsLoggedIn = true;");
} else{
    print("var IsLoggedIn = false;");
}
?>

</script>

<script>
    function GetAvailableRooms(){
        if(ReservationNumber == null){
            ClearRooms();
            GetRooms( parseInt($( "#Adults" ).val())+parseInt($( "#Children" ).val()));
        } else{
        new Toastify({
                text: "Du kan ikke filtrere igen, før du laver en ny reservation",
                duration: 5000,
                backgroundColor: "#c82506",
            }).showToast();
        }
    }
</script>

<script>
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}
</script>

<script>
    $("#fromDate").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
    }).datepicker("update", "<?php print($_GET["Checkindate"]); ?>"); 
    $("#toDate").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    }).datepicker("update", "<?php print($_GET["Checkoutdate"]); ?>"); 
</script>

<script>
GetAvailableRooms();
</script>
<script>
      AOS.init({
        once: true,
      });
</script>