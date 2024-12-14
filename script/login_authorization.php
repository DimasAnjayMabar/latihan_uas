<script>
    //fungsi login
    function login(event){
        //fungsi agar bisa tekan enter saat login
        document.getElementById("username").addEventListener("keypress", function (event) {
            if(event.key === "Enter") {
                event.preventDefault();
                
            }
        });

        document.getElementById("password").addEventListener("keypress", function (event) {
            if(event.key === "Enter") {
                event.preventDefault();

            }
        });

        //inisialisasi
        event.preventDefault();
        
        //inisialisasi error message
        document.getElementById("usernameError").textContent = '';
        document.getElementById("passError").textContent = '';
        
        //mengambil username dan password dari inputan
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        let isValid = true;

        //jika username dan password kosong
        if(username === ''){
            document.getElementById("usernameError").textContent = 'username diperlukan';
            isValid = false;
        }

        if(password === ''){
            document.getElementById("passError").textContent = 'password diperlukan';
            isValid = false;
        }

        //jika username dan password terisi
        if(isValid){
            $.ajax({
                //mengarahkan ke backend
                url: "function/authorize_login.php",
                method: "POST",
                data: {
                    //data yang akan di post
                    username: username,
                    password: password
                },
                //cek response dari backend
                success: function(response){
                    //kalau login gagal tambah ini : console.log(response) dan lihat responsenya
                    if(response === "success"){
                        window.location.href = "home_page.php"
                    }else{
                        if(response === "Invalid username or password."){
                            document.getElementById("usernameError").textContent =response;
                        }else if(respons === "Invalid username or password."){
                            document.getElementById("passError").textContent =response;
                        }else{
                            document.getElementById("passError").textContent = "login gagal";
                        }
                    }
                },
                error:function(){
                    alert("error")
                }
            })
        }
    };
</script>