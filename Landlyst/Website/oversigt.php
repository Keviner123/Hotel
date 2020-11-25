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
    <script type="text/javascript" src="Assets/Library/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="Assets/Library/toastify/toastify.js"></script>
</head>

<body>

    <div class="Header">
        <div class="HeaderContent">
            <img id="HeaderLogo" src="Assets/Images/Logo.png" />
            <img id="HeaderLady" src="Assets/Images/Casinodame.png" /></div>
    </div>
    </div>
    <div class="Body">
        <div id="RoomsContainer">

            <?php for ($x = 0; $x <= 100; $x++) {
                print '
             <div class="RoomContainer">
             <img class="RoomImageContainer" src="Assets/Images/Rooms/1.jpg">
             <div class="RoomDescriptionContainer">
                 <div style="display: flex;flex-direction: column;width:90%">
                     <p class="RoomDescriptionTitle">Gambling Suite</p>
                     <p class="RoomDescriptionText">2 værelser</p>
                     <p class="RoomDescriptionText">1 køkken</p>
                     <p class="RoomDescriptionText">1 TV</p>
                 </div>
                 <button style="width: 125px;" type="button" class="btn btn-success">Book værelse</button>

             </div>
         </div>
            ';
            } ?>
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