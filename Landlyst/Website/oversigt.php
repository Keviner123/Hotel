<head>
<title>Landlyst Casino Hotel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/TypewriterJS/2.13.1/core.min.js" integrity="sha512-yfhC0kG8fvDDLG3xpuZ4fZ2zCoZKHzkoO/mCFdDiUzwKktWnYkXZwNjW1qyoMwnf1uRi8LelY5wDNIA30Xz7Dw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/Scrollbar.css">
    <link rel="stylesheet" href="Assets/Library/datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="Assets/Library/toastify/toastify.css">
    <script type="text/javascript" src="Assets/Library/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="Assets/Library/toastify/toastify.js"></script>

    <script>
    var ReservationNumber;

    async function CreateReservation(RoomNumber) {
        return new Promise(function(resolve, reject) {
            var settings = {
                "url": "/Endpoints/createreservation.php",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
            };

            $.ajax(settings).done(function(response) {
                resolve(response)
            });
        })
    }

    async function AttachRoomToReservation(RoomNumber) {
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

    function GetRooms(Guests){
        var form = new FormData();
        form.append("MaxGuests", Guests);

        var settings = {
        "url": "http://localhost/hotel/Endpoints/getrooms.php",
        "method": "POST",
        "timeout": 0,
        dataType: "json",
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form,
        };

        $.ajax(settings).done(function (response) {
            console.log(response);
            for (let index = 0; index < response.length; index++) {
                Attributes = (response[index].Attributes.join(", "));
                CreateRoomContainer(response[index].RoomName, response[index].RoomNumber, response[index].MaxGuests, Attributes, parseInt(response[index].Rate)+response[index].AttributesPrices);
            }
        });
    }

    function ClearRooms(){
        $( "#RoomsContainer" )[0].innerHTML = '';
    }

    function CreateRoomContainer(RoomName, RoomNumber, MaxGuests, Attributes, Rate) {
          var RoomContainer = document.createElement('div');
          RoomContainer.className = "RoomContainer";

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
          BookingButton.onclick = function() {this.disabled=true;AttachRoomToReservation(1);};
          RoomDescriptionContainer.appendChild(BookingButton);

          $( "#RoomsContainer" )[0].appendChild(RoomContainer);
    }


    </script>

</head>

<body>
   <?php include 'header.php'; ?>
   </div>
   <div class="Body">
       

   <div class="PageContainer">
    <div id="FilterBar">
                <div style="height:100%;width:100%;">
                <p id="FilterBarTitle">Søg efter værelser på Landlyst</p>
                <p id="FilterBarDescription">Indtast dine datoer for at se de seneste priser og tilbud for værelser på plandlyst</p>
                </div>
                <div style="height:100%;width:100%;display: flex;align-items: flex-end;justify-content: space-between;">
                <div>
                    <label class="DatePickerLabel" for="exampleIn½utEmail1">Check-in dato</label>
                    <input value="<?php print date('d/m/Y'); ?>" class="form-control DatePicker" type="text" id="fromDate" class="datepicker" name="updatedDate" />
                </div>
                <div>
                    <label class="DatePickerLabel" for="exampleInputEmail1">Check-in dato</label>
                    <input class="form-control DatePicker" type="text" id="toDate" class="datepicker" name="updatedDate" />
                </div>
                <div>
                    <label class="DatePickerLabel" for="exampleInputEmail1">Voksne</label>
                    <select class="form-control PersonPicker" id="Adults">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div>
                    <label class="DatePickerLabel"  for="exampleInputEmail1">Børn</label>
                    <select class="form-control PersonPicker" data-width="50px" id="exampleFormControlSelect1">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div>
                    <button onclick="GetAvailableRooms()" type="button" class="btn btn-success shadow-none">Check tilgængelighed</button>
                </div>
                </div>
            </div>

      <div id="RoomsContainer">
      </div>
   </div>
   </div>
</body>


<script>
    function GetAvailableRooms(){
        ClearRooms();
        GetRooms($( "#Adults" ).val());
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
        autoclose: true
    }).datepicker("update", "<?php print($_GET["Checkindate"]); ?>"); 
    $("#toDate").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    }).datepicker("update", "<?php print($_GET["Checkoutdate"]); ?>"); 
</script>

<script>
GetRooms(1);
</script>
