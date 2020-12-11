function CancelBooking(RoomNumber, self) {
    var form = new FormData();

    form.append("RoomNumber", RoomNumber);

    var settings = {
        "url": "Endpoints/removereservation.php",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "data": form,
        "contentType": false,
    };

    $.ajax(settings).done(function(response) {
        new Toastify({
            text: "Rum fjernet fra din booking",
            duration: 5000,
            backgroundColor: "#28a745",
        }).showToast();
    });

    $(self.parentNode.parentNode.parentNode.parentNode).animate({
        padding: "0px",
        'margin-top': '-200px',
        'opacity': 0,
        'height': 0,
    }, 500, function() {
        $(this).remove();
    });

}

function CheckoutBooking(RoomNumber, self) {
    var form = new FormData();

    form.append("RoomNumber", RoomNumber);

    var settings = {
        "url": "Endpoints/checkoutbooking.php",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "data": form,
        "contentType": false,
    };

    $.ajax(settings).done(function(response) {
        new Toastify({
            text: "Checked ud",
            duration: 5000,
            backgroundColor: "#28a745",
        }).showToast();
    });

    $(self.parentNode.parentNode.parentNode.parentNode).animate({
        padding: "0px",
        'margin-top': '-200px',
        'opacity': 0,
        'height': 0,
    }, 500, function() {
        $(this).remove();
    });

}

function ConverteDate(BootstrapTime) {
    var Time = BootstrapTime.split('/');
    Time.reverse();
    return (Time.join("-"));
}

async function CreateReservation() {

    return new Promise(function(resolve, reject) {
        var form = new FormData();

        var ArrivalDate = ConverteDate($("#fromDate")[0].value);
        var Depaturedate = ConverteDate($("#toDate")[0].value);

        form.append("ArrivalDate", ArrivalDate);
        form.append("Depaturedate", Depaturedate);

        var settings = {
            "url": "Endpoints/createreservation.php",
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
    if (IsLoggedIn) {

        self.disabled = true;

        //Check if its the users first reservation and create a booking request if it is.
        if (ReservationNumber == null) {
            ReservationNumber = await CreateReservation(RoomNumber);
        }

        var form = new FormData();
        form.append("ReservationNumber", ReservationNumber);
        form.append("RoomNumber", RoomNumber);

        var settings = {
            "url": "Endpoints/attatchroomtoreservation.php",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };

        $.ajax(settings).done(function(response) {
            if (response == 1) {
                new Toastify({
                    text: "Rum tildelt din booking",
                    duration: 5000,
                    backgroundColor: "#28a745",
                }).showToast();
            }
        });
    } else {
        new Toastify({
            text: "Du skal være logget ind for at booke et værelse.",
            duration: 5000,
            backgroundColor: "#c82506",
        }).showToast();
    }
}

function GetRooms(Guests) {
    var form = new FormData();
    form.append("MaxGuests", Guests);

    form.append("ArrivalDate", ConverteDate($("#fromDate")[0].value));
    form.append("Depaturedate", ConverteDate($("#toDate")[0].value));

    var settings = {
        "url": "Endpoints/getrooms.php",
        "method": "POST",
        "timeout": 0,
        dataType: "json",
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form,
    };

    $.ajax(settings).done(function(response) {
        var DelayTime = 0;
        for (let index = 0; index < response.length; index++) {
            Attributes = (response[index].Attributes.join(", "));

            //Add a delay that resets every fifth row.
            //This ensures that the boxes will load in smootly
            if (DelayTime == 150 * 5) {
                DelayTime = 0;
            }
            DelayTime += 150;
            CreateRoomContainer(response[index].RoomName, response[index].RoomNumber, response[index].MaxGuests, Attributes, parseInt(response[index].Rate) + response[index].AttributesPrices, DelayTime);
        }

        //Round up to the nearest 5 and get if enough containers has been made.
        //If not we add enough so that the flexbox will show them correctly.
        for (let i = 0; i < (Math.ceil(response.length / 5) * 5) - response.length; i++) {
            CreateEmptyRoomContainer();
        }
    });


}

function ClearRooms() {
    $("#RoomsContainer")[0].innerHTML = '';
}

function CreateRoomContainer(RoomName, RoomNumber, MaxGuests, Attributes, Rate, DelayTime) {
    var RoomContainer = document.createElement('div');
    RoomContainer.className = "RoomContainer";
    RoomContainer.setAttribute('data-aos', "slide-up");
    RoomContainer.setAttribute('data-aos-duration', DelayTime);

    var RoomImageContainer = document.createElement('img');
    RoomImageContainer.className = "RoomImageContainer";
    RoomImageContainer.src = "Assets/Images/Rooms/" + RoomNumber + ".jpg"
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
    RoomDescriptionMaxGuests.textContent = MaxGuests + " gæster";
    RoomDescriptionContainerInside.appendChild(RoomDescriptionMaxGuests);

    var RoomDescriptionAttributes = document.createElement('p');
    RoomDescriptionAttributes.className = "RoomDescriptionText";
    RoomDescriptionAttributes.textContent = Attributes;
    RoomDescriptionContainerInside.appendChild(RoomDescriptionAttributes);

    var PricerContainer = document.createElement('div');
    PricerContainer.style = "display: flex;flex-direction: column;width:90%";
    RoomDescriptionContainer.appendChild(PricerContainer);

    var PricerContainerText = document.createElement('p');
    PricerContainerText.className = "RoomDescriptionTitle";
    PricerContainerText.style = "font-size:15px";
    PricerContainerText.textContent = "Pris pr. dag: " + Rate + " kr.";
    PricerContainer.appendChild(PricerContainerText);

    var BookingButton = document.createElement('button');
    BookingButton.style = "width: 125px;";
    BookingButton.type = "button";
    BookingButton.className = "btn btn-success shadow-none";
    BookingButton.textContent = "Book værelse";
    BookingButton.onclick = function() { AttachRoomToReservation(RoomNumber, this); };
    RoomDescriptionContainer.appendChild(BookingButton);

    $("#RoomsContainer")[0].appendChild(RoomContainer);
}

function CreateEmptyRoomContainer() {
    var RoomContainer = document.createElement('div');
    RoomContainer.className = "RoomContainer";
    RoomContainer.style = "visibility: collapse;";
    $("#RoomsContainer")[0].appendChild(RoomContainer);
}

function GetAvailableRooms() {
    if (ReservationNumber == null) {
        ClearRooms();
        GetRooms(parseInt($("#Adults").val()) + parseInt($("#Children").val()));
    } else {
        new Toastify({
            text: "Du kan ikke filtrere igen, før du laver en ny reservation",
            duration: 5000,
            backgroundColor: "#c82506",
        }).showToast();
    }
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function(item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

function ValidateForm() {
    if ($("#fromDate").datepicker('getDate') == null && $("#toDate").datepicker('getDate') == null) {
        var myToast = Toastify({
            text: "Udfyld venligtst check-in og check-ud dato.",
            duration: 5000,
            backgroundColor: "#ffc107",
        }).showToast();
    } else {
        window.location.replace('oversigt.php?Checkindate=' + $("#fromDate")[0].value + '&Checkoutdate=' + $("#toDate")[0].value);
    }
}