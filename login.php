<?php
session_start();
include("header.php");
?>


<div class="container centered content">
    <form class="form-horizontal" action="#">
        <br>
        <h1>Авторизація</h1>
        <br>
        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Логін</label>
            <div class="col-sm-4">
                <input type="text" name="" id="login" required>
            </div>
        </div>
        <div class="form-group">
            <label for="pass" class="col-sm-2 control-label">Пароль</label>
            <div class="col-sm-4">
                <input type="password" name="" id="pass" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <div class="checkbox">
                    <input type="checkbox" id="check" class="password-checkbox"> Показати пароль<br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <a class="col-sm-offset-1 col-sm-2" href="registration.php">Не маю облікового запису</a>
            <div class="col-sm-2">
                <button onclick="valid()">Авторизація</button>
            </div>
        </div>
    </form>
</div>

<?php
@include("footer.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery.maskedinput.min.js"></script>

<script> // показать пароль
    var pass = Array.from(document.querySelectorAll('input[type="password"]'));
    pass.forEach(function (checkbox, i) {
        $('body').on('click', '.password-checkbox', function () {
            if ($(this).is(':checked')) {
                checkbox.type = 'text';
            } else {
                checkbox.type = 'password';
            }
        });
    });
</script>

<script>
    function valid() {
        var login = document.getElementById("login").value;
        var pass = document.getElementById("pass").value;
        if (login === "" || pass === "") {
            alert("Введіть логін та пароль!");
            exit;
        }

        $.ajax({
            url: 'ajax/login_db.php',
            type: 'POST',
            data: {
                login: login,
                pass: pass
            },
            success: function (data) {
                if (data.success === "0") {
                    alert("Невірний логін/пароль");
                    exit;
                } else {
                    window.location.href = "index.php";
                    exit;
                }
            }
        });
    }

</script>

