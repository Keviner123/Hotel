<head>
    <title>Landlyst Casino Hotel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/TypewriterJS/2.13.1/core.min.js" integrity="sha512-yfhC0kG8fvDDLG3xpuZ4fZ2zCoZKHzkoO/mCFdDiUzwKktWnYkXZwNjW1qyoMwnf1uRi8LelY5wDNIA30Xz7Dw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/Scrollbar.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="Assets/Library/datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="Assets/Library/toastify/toastify.css">
    <script type="text/javascript" src="Assets/Library/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="Assets/Library/toastify/toastify.js"></script>
</head>

<body>
    <?php include 'header.php';?>

    </div>
    <div class="Body">
        <div id="SearchContainer">
            <img id="SearchContainerBackground" src="Assets/Images/cards.jpg"></img>

            <div id="SearchContainerContent">
                <div style="overflow: hidden;">
                    <p class="SearchContainerText">Danmarks </p>
                    <p class="SearchContainerText" id="MovingText"></p>
                    <p style="padding-left:5px;" class="SearchContainerText">Casino Hotel <br>I hjertet af nordfyn</p>
                </div>
                <div style="display:flex">
                    <div>
                        <label class="DatePickerLabel" for="exampleInputEmail1">Check-in dato</label>
                        <input class="form-control DatePicker" type="text" id="fromDate" class="datepicker" name="updatedDate" />
                    </div>
                    <div style="margin-left: 20px;">
                        <label class="DatePickerLabel" for="exampleInputEmail1">Check-ud dato</label>
                        <input class="form-control DatePicker" type="text" id="toDate" class="datepicker" name="updatedDate" />
                    </div>
                </div>
                <button onclick="ValidateForm()" style="width: 200px;" type="button" class="btn btn-success shadow-none">Tjek
                    tilgængelighed</button>

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
            window.location.replace('oversigt.php?Checkindate='+$("#fromDate")[0].value+'&Checkoutdate='+$("#toDate")[0].value);
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