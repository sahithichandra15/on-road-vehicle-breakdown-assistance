document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (email && password) {
                location.replace("AdminHomePage.html");
            } else {
                document.getElementById('errorMessage').style.display = 'block';
            }
        });