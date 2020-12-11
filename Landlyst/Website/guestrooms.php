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
        function MonthDateToText($Month){
            $Months = array("Januar", "Februar", "Marts", "April","Maj", "June", "July", "August","September", "Oktober", "November", "December");
            return($Months[$Month-1]);
        }

        function PrintGuestRoomContainer($RoomNumber,$RoomName, $ArrivalDate, $DepatureDate, $MaxGuests){
                $CheckinDay = explode("-", $ArrivalDate)[2];
                $CheckoutDay = explode("-", $DepatureDate)[2];
                $CheckinMonth = explode("-", $ArrivalDate)[1];
                $CheckoutMonth = explode("-", $DepatureDate)[1];
                $CheckinDayName = date('l', strtotime($ArrivalDate));
                $CheckoutDayName = date('l', strtotime($DepatureDate));
            print'
                <div class="BookingListContainer">
                <img class="BookingListImage" src="/Assets/Images/Rooms/'.$RoomNumber.'.jpg"></img>
                <div class="BookingListContainerContent">
                    <div class="BookingListDescriptionContainer">
                        <p class="BookingListDescriptionTitle">'.$RoomName.'</p>
                        <div style="height:100%;width:100%">
                            <p class="RoomDescriptionText">'.$MaxGuests.' gæster</p>
                        </div>
                        <div>';
            


            if (strtotime($ArrivalDate) < time() AND strtotime($DepatureDate) < time()) {


            } else if(strtotime($ArrivalDate) < time() AND strtotime($DepatureDate) > time()){
                print('
                <button onclick="CheckoutBooking('.$RoomNumber.', this)" type="button" class="btn btn-success shadow-none" style="width:100px">Check ud</button>
                ');
        
            }
                
             else{

                print('
                 <button onclick="CancelBooking('.$RoomNumber.', this)" type="button" class="btn btn-secondary shadow-none" style="width:100px">Annuler</button>
                ');    
            }

            print'
                        </div>
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
        WHERE isCanceled = 0 AND DepatureDate >= CURDATE()  AND CheckoutDate IS NULL 
        AND reservation.GuestNumber = ".$_SESSION['GuestNumber'].";
        ;";
        
        $result = $conn->query($sql);

        $rows = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $MaxGuests = $row["MaxGuests"];

                PrintGuestRoomContainer($row["RoomNumber"],$row["RoomName"],$row["ArrivalDate"],$row["DepatureDate"], $MaxGuests);
            }
        } else{
            print('
            <lottie-player src="Assets/Animations/404.json"  background="transparent" speed="1"  style="width: 1390px; height: 450px;" loop autoplay></lottie-player>
            <div style="width:100%;heigth:200px;display:flex;align-items:center;flex-direction:column">
            <p style="font-weight:bold;color:#898989;margin-bottom: 0;">Det ser ikke ud til at du har lavet nogle reservationer!</p>
            <p style="color:#898989">Gå tilbage og opret en reservation.!</p>
            </div>
            ');
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

        $(self.parentNode.parentNode.parentNode.parentNode).animate({
            padding: "0px",
            'margin-top':'-200px',
            'opacity': 0,
            'height':0,
        }, 500, function() {
            $(this).remove();      
        });

    }

    function CheckoutBooking(RoomNumber, self){
        var form = new FormData();

        form.append("RoomNumber", RoomNumber);

        var settings = {
            "url": "/Endpoints/checkoutbooking.php",
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