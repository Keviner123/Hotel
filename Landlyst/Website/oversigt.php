<head>
    <title>Landlyst Casino Hotel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TypewriterJS/2.13.1/core.min.js"
        integrity="sha512-yfhC0kG8fvDDLG3xpuZ4fZ2zCoZKHzkoO/mCFdDiUzwKktWnYkXZwNjW1qyoMwnf1uRi8LelY5wDNIA30Xz7Dw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 5px;
            height: 10px;
        }

        ::-webkit-scrollbar-button {
            width: 0px;
            height: 0px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ae1002;
            border: 0px none #ffffff;
            border-radius: 100px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ae1002;
        }

        ::-webkit-scrollbar-thumb:active {
            background: #000000;
        }

        ::-webkit-scrollbar-track {
            background: #292929;
            border: 0px none #ffffff;
            border-radius: 0px;
        }

        ::-webkit-scrollbar-track:hover {
            background: #3a3a3a;
        }

        ::-webkit-scrollbar-track:active {
            background: #333333;
        }

        ::-webkit-scrollbar-corner {
            background: transparent;
        }
    </style>

    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="Assets/Library/datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="Assets/Library/toastify/toastify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script type="text/javascript" src="Assets/Library/toastify/toastify.js"></script>

    <script>
    function CreateReservation(RoomNumber){
        alert(RoomNumber);
        document.getElementsByClassName("RoomContainer")[RoomNumber].remove();
    }
    </script>

</head>

<body>

    <?php include 'header.php'; ?>

    </div>
    
    <div class="Body">
        <div id="RoomsContainer">

            <?php
			require 'DatabaseConnect.php';
            // Check connection
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
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
                    // output data of each row
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
                        $row['RoomName'] .
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
            Pris pr. uge: 500kr</p>
        </div>
        <button onclick="CreateReservation('.$row['RoomNumber'].')" style="width: 125px;" type="button" class="btn btn-success shadow-none">Book værelse</button>
    </div>
</div>
   ';
                }
            } else {
                echo '0 results';
            }
            $conn->close();
            ?>
        </div>
    </div>

    </div>
</body>

<script>
    var app = document.getElementById('MovingText');

    var typewriter = new Typewriter(app, {
        loop: true,
        delay: 100,
        cursor: ''
    });

    typewriter.typeString('største')
        .pauseFor(2500)
        .deleteAll()
    typewriter.typeString('første')
        .pauseFor(2500)
        .deleteAll()
    typewriter.typeString('sjoveste')
        .pauseFor(2500)
        .deleteAll()
    typewriter.typeString('bedste')
        .pauseFor(2500)
        .start();

</script>

<script>
    function ValidateForm() {
        if ($("#fromDate").datepicker('getDate') == null && $("#toDate").datepicker('getDate') == null) {
            var myToast = Toastify({
                text: "Udfyld venligtst check-in og check-ud dato.",
                duration: 5000,
                backgroundColor: "#ffc107",

            }).showToast();
        } else {
            var myToast = Toastify({
                text: "Finder dato",
                duration: 5000,
                backgroundColor: "#28a745",

            }).showToast();
        }


    }
</script>


<script>
    $('#fromDate').datepicker({
        autoclose: true
    });
    $('#toDate').datepicker({
        autoclose: true
    });
</script>


