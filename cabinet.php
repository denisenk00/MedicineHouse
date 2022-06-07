<?php
session_start();
@include("dbaccess.php");
@include("access.php");
@include("header.php");


$login = $_SESSION["login"];


$row = getHuman($login);
?>
<div class="container centered content">
    <br>
    <h2>Мій аккаунт</h2><br>
    <form class="form-horizontal">
        <div class="form-group">
            <label for="f_name" class="col-sm-2 control-label">Ім'я: </label>
            <div class="col-sm-4">
                <input type='text' id='f_name' value="<?php echo $row[0] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="s_name" class="col-sm-2 control-label">Прізвище: </label>
            <div class="col-sm-4">
                <input type='text' id='s_name' value="<?php echo $row[1] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">е-Пошта: </label>
            <div class="col-sm-4">
                <input type='text' id='email' value="<?php echo $row[2] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Телефон: </label>
            <div class="col-sm-4">
                <input type='text' id='phone' value="<?php echo $row[3] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <button onclick='changeHumanData()' class="btn btn-default">Редагувати дані</button>
            </div>
        </div>
    </form>
    <br><br>
    <form class="form-horizontal">
        <div class="form-group">
            <label for='old_pass' class="col-sm-2 control-label">Старий пароль: </label>
            <div class="col-sm-4">
                <input type='password' id='old_pass' required>
            </div>
        </div>
        <div class="form-group">
            <label for='new_pass' class="col-sm-2 control-label">Новий пароль: </label>
            <div class="col-sm-4">
                <input type='text' id='new_pass' required>
            </div>
        </div>
        <div class="form-group">
            <label for='new_pass_conf' class="col-sm-2 control-label">Підтвердити пароль: </label>
            <div class="col-sm-4">
                <input type='text' id='new_pass_conf' required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <button onclick='changePassword()' class="btn btn-default">Змінити пароль</button>
            </div>
        </div>
    </form>
</div>


<script>
    function changeHumanData() {
        var f_name = document.getElementById("f_name").value;
        var s_name = document.getElementById("s_name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;

        if (s_name === "" || f_name === "" || phone === "" || email === "") {
            alert("Заповніть всі поля!");
            exit;
        }

        const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;

        if (!EMAIL_REGEXP.test(email)) {
            alert("Невірний e-mail!");
            exit;
        }

        $.ajax({
            url: 'ajax/change_human.php',
            type: 'POST',
            data: {
                s_name: s_name,
                f_name: f_name,
                phone: phone,
                email: email
            },
            success: function (data) {
                if (data.success === "0") {
                    alert("Користувач з такою поштою вже існує");
                    exit;
                } else {
                    alert("Дані змінені успішно!");
                    window.location.href = "cabinet.php";
                    exit;
                }
            }
        })
    }

    function changePassword() {
        var old_pass = document.getElementById("old_pass").value;
        var new_pass = document.getElementById("new_pass").value;
        var new_pass_conf = document.getElementById("new_pass_conf").value;

        if (old_pass === "" || new_pass === "" || new_pass_conf === "") {
            alert("Заповніть всі поля!");
            exit;
        }
        if (old_pass === new_pass) {
            alert("Новий пароль співпадає зі старим!");
            exit;
        }
        if (new_pass_conf != new_pass) {
            alert("Новий пароль та його підтвердження відрізняються");
            exit;
        }

        $.ajax({
            url: 'ajax/change_password.php',
            type: 'POST',
            data: {
                new_pass: new_pass,
            }
        })
        alert("Пароль змінено успішно!");
        window.location.href = "cabinet.php";
        exit;
    }
</script>