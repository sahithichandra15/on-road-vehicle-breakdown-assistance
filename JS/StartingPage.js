function UserLogin(){
            location.replace("UserLogin.html");
        }
        function AdminLogin(){
            location.replace("AdminLogin.html");
        }
        function BusinessLogin(){
            location.replace("BusinessLogin.html");
        }

        window.onload = function() {
            setTimeout(function() {
                document.querySelector('.website-name').classList.add('hidden');
                document.querySelector('.logo-container').classList.remove('hidden');
            }, 3000);
        };