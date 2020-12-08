<head>
    <title>Landlyst Casino Hotel</title>
    <?php include 'libaries.php'; ?>
</head>

<body>
   <?php include 'header.php'; ?>
   </div>
   <div class="Body">
      <div class="PageContainer">

        <?php
        session_start();

        function MonthDateToText($Month){
            $Months = array("Januar", "Februar", "Marts", "April","Maj", "June", "July", "August","September", "Oktober", "November", "December");
            return($Months[$Month-1]);
        }

        function PrintGuestRoomContainer($RoomNumber, $RoomName, $CheckinDay, $CheckoutDay, $CheckinMonth, $CheckoutMonth, $CheckinDayName, $CheckoutDayName, $MaxGuests){
            print'
                <div class="BookingListContainer">
                <img class="BookingListImage" src="/Assets/Images/Rooms/'.$RoomNumber.'.jpg"></img>
                <div class="BookingListContainerContent">
                    <div class="BookingListDescriptionContainer">
                        <p class="BookingListDescriptionTitle">'.$RoomName.'</p>
                        <div style="height:100%;width:100%">
                            <p class="RoomDescriptionText">'.$MaxGuests.' gæster</p>
                        </div>
                        <button onclick="CancelBooking('.$RoomNumber.', this)" type="button" class="btn btn-secondary shadow-none" style="width:100px">Annuler</button>
                    </div>
                    <div class="BookingListDateContainer">
                        <p class="BookingListDateText BookingListTitleText">Check-in</p>
                        <p class="BookingListDateText BookingListDayText">'.$CheckinDay.'</p>
                        <p class="BookingListDateText BookingListMonthText">'.MonthDateToText($CheckinMonth).'</p>
                        <p class="BookingListDateText BookingListWeekDayText">'.$CheckinDayName.'</p>
                    </div>
                    <div class="BookingListDateContainer">
                        <p class="BookingListDateText BookingListTitleText">Check-ud</p>
                        <p class="BookingListDateText BookingListDayText">'.$CheckoutDay.'</p>
                        <p class="BookingListDateText BookingListMonthText">'.MonthDateToText($CheckoutMonth).'</p>
                        <p class="BookingListDateText BookingListWeekDayText">'.$CheckoutDayName.'</p>
                    </div>
                </div>            
                </div>';
            }

        include_once('DatabaseConnect.php'); 
        $sql = "
        SELECT *
        FROM reservationroomlines
        INNER JOIN reservation
        ON reservationroomlines.ReservationNumber = reservation.ReservationNumber
        INNER JOIN room
        ON reservationroomlines.RoomNumber = room.RoomNumber
        WHERE reservation.GuestNumber = ".$_SESSION['GuestNumber'].";";
        
        $result = $conn->query($sql);

        $rows = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $CheckinDay = explode("-", $row["ArrivalDate"])[2];
                $CheckoutDay = explode("-", $row["DepatureDate"])[2];
                $CheckinMonth = explode("-", $row["ArrivalDate"])[1];
                $CheckoutMonth = explode("-", $row["DepatureDate"])[1];
                $CheckinDayName = date('l', strtotime($row["ArrivalDate"]));
                $CheckoutDayName = date('l', strtotime($row["DepatureDate"]));
                $MaxGuests = $row["MaxGuests"];

                PrintGuestRoomContainer($row["RoomNumber"],$row["RoomName"], $CheckinDay, $CheckoutDay, $CheckinMonth, $CheckoutMonth, $CheckinDayName, $CheckoutDayName, $MaxGuests);
            }
        }
        ?>
      </div>
   </div>
</body>

<script>
    function CancelBooking(RoomNumber, self){
        var form = new FormData();

        form.append("RoomNumber", RoomNumber);

        var settings = {
            "url": "/Endpoints/removereservation.php",
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

        $(self.parentNode.parentNode.parentNode).animate({
            padding: "0px",
            'margin-top':'-200px',
            'opacity': 0,
            'height':0,
        }, 500, function() {
            $(this).remove();      
        });

    }
</script>
<script>
      AOS.init({
        once: true,
      });
</script>