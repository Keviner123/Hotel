<script>
function CreateUser(){
	var form = new FormData();
	form.append("Firstname", "Kevin");
	form.append("Lastname", "Frost");
	form.append("PhoneNumber", "40420820");
	form.append("Salt", "123213");
	form.append("Email", $("#Email").val());
	form.append("Password", $("#Password").val());


	var settings = {
	  "url": "http://localhost/hotel/Endpoints/signup.php",
	  "method": "POST",
	  "timeout": 0,
	  "processData": false,
	  "mimeType": "multipart/form-data",
	  "contentType": false,
	  "data": form
	};

	$.ajax(settings).done(function (response) {
	  if(response){
        var myToast = Toastify({
                text: "Konto oprettet.",
                duration: 5000,
                backgroundColor: "#28a745",
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
	  "url": "http://localhost/hotel/Endpoints/login.php",
	  "method": "POST",
	  "timeout": 0,
	  "processData": false,
	  "mimeType": "multipart/form-data",
	  "contentType": false,
	  "data": form
	};

	$.ajax(settings).done(function (response) {
        alert(response);
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
                    <div class="loginbar">
                            <input style="width:230px" type="email" class="form-control" id="Email" placeholder="Email">
                            <input type="password" style="width:230px" type="email" class="form-control" id="Password" placeholder="Password">
                            <button onclick="Login()" type="button" class="btn btn-secondary shadow-none">Login</button>
                            <button onclick="CreateUser()" type="button" class="btn btn-success shadow-none">Opret konto</button>
                    </div>
                </div>
            </div>'
        );
?>