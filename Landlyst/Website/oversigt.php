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
    </script>

</head>

<body>

    <?php include 'header.php'; ?>

    </div>
    
    <div class="Body">
        <div id="RoomsContainer">

            <div id="FilterBar">
            
            <div style="height:100%;width:100%;">
                <p id="FilterBarTitle">Søg efter værelser på Landlyst</p>
                <p id="FilterBarDescription">Indtast dine datoer for at se de seneste priser og tilbud for værelser på plandlyst</p>
            </div>
            <div style="height:100%;width:100%;display: flex;align-items: flex-end;justify-content: space-between;">
        
                   <div>
                        <label class="DatePickerLabel" for="exampleInputEmail1">Check-in dato</label>
                        <input class="form-control DatePicker" type="text" id="fromDate" class="datepicker" name="updatedDate" />
                    </div>

                    <div>
                        <label class="DatePickerLabel" for="exampleInputEmail1">Check-in dato</label>
                        <input class="form-control DatePicker" type="text" id="toDate" class="datepicker" name="updatedDate" />
                    </div>

                    <div>
                        <label class="DatePickerLabel" for="exampleInputEmail1">Voksne</label>
                        <select class="form-control PersonPicker" id="exampleFormControlSelect1">
                            <option>0</option>
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
                        <button onclick="CreateUser()" type="button" class="btn btn-success shadow-none">Check tilgængelighed</button>
                    </div>
        </div>
            </div>

            <?php
            require 'DatabaseConnect.php';

            function GetRoomAttributesPrice($Room, $SQLConnection){
                $sql = "select
                m.RoomAttributeRate
            from
                roomattribute m
                inner join roomattributes am on m.RoomAttritubeNumber = am.RoomAttritubeNumber
                inner join room a on am.RoomNumber = a.RoomNumber
            where
                a.RoomNumber = ".$Room;
                $result = $SQLConnection->query($sql);
                $rows = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row['RoomAttributeRate'];
                    }
                }
                return array_sum($rows);
            }

            function GetRoomAttributes($Room, $SQLConnection)
            {
                $sql =
                    "
        select
            m.RoomAttributeName
        from
            roomattribute m
            inner join roomattributes am on m.RoomAttritubeNumber = am.RoomAttritubeNumber
            inner join room a on am.RoomNumber = a.RoomNumber
        where
            a.RoomNumber = " . $Room;
                $result = $SQLConnection->query($sql);
                $rows = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = '-' . $row['RoomAttributeName'];
                    }
                }
                return implode('<br>', $rows);
            }

            $sql = 'SELECT * FROM room';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    print '
    <div class="RoomContainer">
    <img class="RoomImageContainer" src="Assets/Images/Rooms/' .
                        $row['RoomNumber'] .
                        '.jpg">
    <div class="RoomDescriptionContainer">
    
        <div style="display: flex;flex-direction: column;width:90%">
       


            <p class="RoomDescriptionTitle">' .
                        $row['RoomNumber'] .
                        '</p>
            <p class="RoomDescriptionText" style="font-size:15px"> <i class="fas fa-user" style="color:#C82506"></i> ' .
                        $row['MaxGuests'] .
                        ' gæster</p>
            <p class="RoomDescriptionText" style="font-size:13px">' .
                        GetRoomAttributes($row['RoomNumber'], $conn) .
                        '</p>

        </div>

        <div style="display: flex;flex-direction: column;width:90%">
            <p class="RoomDescriptionTitle" style="font-size:15px"><i class="fas fa-file-signature"></i>
            Pris pr. dag: '.($row['Rate']+GetRoomAttributesPrice($row['RoomNumber'], $conn)).' kr</p>
        </div>
        <button onclick="this.disabled=true;AttachRoomToReservation(' .
                        $row['RoomNumber'] .
                        ')" style="width: 125px;" type="button" class="btn btn-success shadow-none">Book værelse</button>
    </div>
</div>
                ';
                }
            }
            $conn->close();
            ?>
        </div>
    </div>

    </div>
</body>




<script>
    $('#fromDate').datepicker({
        autoclose: true
    });
    $('#toDate').datepicker({
        autoclose: true
    });
</script>