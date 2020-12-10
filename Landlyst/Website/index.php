<head>
    <title>Landlyst Casino Hotel</title>
    <?php include 'libaries.php'; ?>  
</head>

<body>
   <?php include 'header.php';?>
   </div>
   <div class="Body">
      <div id="SearchContainer">
         <img id="SearchContainerBackground"></img>
         <video id="SerachContainerVideo" poster="Assets/Video/Card.png" playbackRate=2 autoplay muted loop>
            <source src="Assets/Video/Card.mp4" type="video/mp4" />
            <script>
               const video = document.querySelector("video");
               this.playbackRate = 0.9;
            </script>
         </video>
         <div id="SearchContainerContent">
            <div style="overflow: hidden;">
               <p class="SearchContainerText">Danmarks </p>
               <p class="SearchContainerText" id="MovingText"></p>
               <p style="padding-left:5px;" class="SearchContainerText">Casino Hotel <br>I hjertet af nordfyn</p>
            </div>
            <div style="display:flex">
               <div>
                  <label class="DatePickerLabel">Check-in dato</label>
                  <input class="form-control DatePicker" type="text" id="fromDate" class="datepicker" name="updatedDate" />
               </div>
               <div style="margin-left: 20px;">
                  <label class="DatePickerLabel">Check-ud dato</label>
                  <input class="form-control DatePicker" type="text" id="toDate" class="datepicker" name="updatedDate" />
               </div>
            </div>
            <button onclick="ValidateForm()" style="width: 200px;" type="button" class="btn btn-success shadow-none">Tjek
            tilgængelighed</button>
         </div>
      </div>

      <div class="PageContainer" style="padding-top: 575px;">

      <div style="padding-top:70px;width:100%">
        <div class="InfoContainers">
            <div class="InfoContainer">
                <div class="InfoTitleContainer">
                    <img class="InfoTitleIcon" src="Assets/Images/Icons/Roulette.png" />
                    <p class="InfoTitle">Roulette</p>
                </div>
                <img class="infoImage" src="Assets/Images/Homepage/Roulette.png" />
                <div class="InfoDescription">
                    <p class="InfoDescription">
                        Det mest ikoniske af casinospil! Utrolig spænding og generøse belønninger gør dette spil endnu mere populært end nogensinde.                    
                    </p>
                </div>
            </div>

            <div class="InfoContainer">
                <div class="InfoTitleContainer">
                    <img class="InfoTitleIcon" src="Assets/Images/Icons/Cards.png" />
                    <p class="InfoTitle">Blackjack</p>
                </div>
                <img class="infoImage" src="Assets/Images/Homepage/Cards.png" />
                <div class="InfoDescription">
                    <p class="InfoDescription">
                        Oplev spændingingen ved dette klassiske Vegas-spil. Store belønninger er lige ved hånden med vores brede vifte af blackjack-spil.                    
                    </p>
                </div>
            </div>

            <div class="InfoContainer">
                <div class="InfoTitleContainer">
                    <img class="InfoTitleIcon" src="Assets/Images/Icons/Suits.png" />
                    <p class="InfoTitle">Poker</p>
                </div>
                <img class="infoImage" src="Assets/Images/Homepage/Poker.png" />
                <div class="InfoDescription">
                    <p class="InfoDescription">
                        Uanset om du er en nybegynder, eller en dygtig spiller. 
                        Så tjek vores fantastiske udvalg af pokere borde. Vælg dit spil, og lad det sjove begynde.</p>
                </div>
            </div>
        </div>
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
        autoclose: true,
        format: 'dd/mm/yyyy',

    }).datepicker("setDate",'now');

    $('#toDate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    }).datepicker("setDate",'now');
</script>

