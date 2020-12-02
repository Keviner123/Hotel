<?php
session_start();
?>

<script>
function CreateUser(){
	var form = new FormData();
	form.append("Email", $("#Email").val());
	form.append("Password", $("#Password").val());

	var settings = {
	  "url": "Endpoints/signup.php",
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
                text: "Konto oprettet",
                duration: 5000,
                backgroundColor: "#28a745",
            }).showToast();
		} else{
			new Toastify({
                text: "Konto findes allerede",
                duration: 5000,
                backgroundColor: "#dc3545",
            }).showToast();
		}
	});
}
</script>



 

<script>
function Login(){
	var form = new FormData();
	form.append("Email", $("#Email").val());
	form.append("Password", $("#Password").val());


	var settings = {
	  "url": "Endpoints/login.php",
	  "method": "POST",
	  "timeout": 0,
	  "processData": false,
	  "mimeType": "multipart/form-data",
	  "contentType": false,
	  "data": form
	};

	$.ajax(settings).done(function (response) {
        if(response == 1){
			location.reload();
		} else{
			new Toastify({
                text: "Fejl i login ",
                duration: 5000,
                backgroundColor: "#dc3545",
            }).showToast();
		}
	});
}
</script>


<?php
print('
            <div class="Header">
                <div class="HeaderContent">
                    <div>
                        <a href="./">
                            <img id="HeaderLady" src="Assets/Images/Casinodame.png" />
                            <img id="HeaderLogo" src="Assets/Images/Logo.png" />
                        </a>
                    </div>
					<div class="loginbar">');
					if(isset($_SESSION["Email"])){
						print('<p style="font-size:25px;color:white;margin-bottom:0px">Velkommen '.$_SESSION["Email"].'</p><a href="Endpoints/logout.php" class="btn btn-danger">Log ud</a>');
					} else{
						print('<input style="width:230px" type="email" class="form-control" id="Email" placeholder="Email">
						<input type="password" style="width:230px" type="email" class="form-control" id="Password" placeholder="Password">
						<button onclick="Login()" type="button" class="btn btn-secondary shadow-none">Login</button>
						<button onclick="CreateUser()" type="button" class="btn btn-success shadow-none">Opret konto</button>');
					}
					print('
                    </div>
                </div>
            </div>'
        );
?>