<?php
        
        /**
         * MonthDateToText
         * Convertes a month index to its name 
         * @param  mixed $Month Month index
         */
        function MonthDateToText($Month)
        {
            $Months = array("Januar", "Februar", "Marts", "April","Maj", "June", "July", "August","September", "Oktober", "November", "December");
            return($Months[$Month-1]);
        }

                
        /**
         * PrintGuestRoomContainer
         * Prints out the container that holds a reserved room 
         * @param  mixed $RoomNumber Room id
         * @param  mixed $RoomName Room name
         * @param  mixed $ArrivalDate From date
         * @param  mixed $DepatureDate to date
         * @param  mixed $MaxGuests Max amount of guests
         */
        function PrintGuestRoomContainer($RoomNumber,$RoomName, $ArrivalDate, $DepatureDate, $MaxGuests)
        {
            
            //Extract the date information out of the input
            $CheckinDay = explode("-", $ArrivalDate)[2];
            $CheckoutDay = explode("-", $DepatureDate)[2];
            $CheckinMonth = explode("-", $ArrivalDate)[1];
            $CheckoutMonth = explode("-", $DepatureDate)[1];
            $CheckinDayName = date('l', strtotime($ArrivalDate));
            $CheckoutDayName = date('l', strtotime($DepatureDate));


            //Print the intial box
            print'
            <div class="BookingListContainer">
            <img class="BookingListImage" src="Assets/Images/Rooms/'.$RoomNumber.'.jpg"></img>
            <div class="BookingListContainerContent">
            <div class="BookingListDescriptionContainer">
            <p class="BookingListDescriptionTitle">'.$RoomName.'</p>
            <div style="height:100%;width:100%">
               <p class="RoomDescriptionText">'.$MaxGuests.' gæster</p>
            </div>
            <div>
            ';

            //Attach an appropriate message base on if the room is reserverd in the present past or future

            //If the reservation is in the past
            if (strtotime($DepatureDate) < time()) 
            {
                //Do nothing
            } 
            //If the reservation is now
            else if(strtotime($ArrivalDate) < time() AND strtotime($DepatureDate) > time())
            {
                //Add a check out button
                print('
                <button onclick="CheckoutBooking('.$RoomNumber.', this)" type="button" class="btn btn-success shadow-none" style="width:100px">Check ud</button>
                ');
            }
            //If the reservation is in the future
            else
            {
                //Add a check cancel reservation button
                print('
                 <button onclick="CancelBooking('.$RoomNumber.', this)" type="button" class="btn btn-secondary shadow-none" style="width:100px">Annuler</button>
                ');    
            }

            #Print the end of the box
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
            </div>'
            ;
        }

        include_once('DatabaseConnect.php'); 

        //Queries all the available rooms that the user has booked.
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
        } 
        else
        {
            //Print a message saying that no reservation has been found
            print('
            <lottie-player src="Assets/Animations/404.json"  background="transparent" speed="1"  style="width: 1390px; height: 450px;" loop autoplay></lottie-player>
            <div style="width:100%;heigth:200px;display:flex;align-items:center;flex-direction:column">
               <p style="font-weight:bold;color:#898989;margin-bottom: 0;">Det ser ikke ud til at du har lavet nogle reservationer!</p>
               <p style="color:#898989">Gå tilbage og opret en reservation.!</p>
            </div>
            ');
        }
?>