<?php
@include("header.php");
@include("dbaccess.php");
@include("access_admin.php");

$rows = getHumansNoDoctors($_SESSION["login"]);
?>
<div class="content container centered">
    <br>
    <h2>Додати лікаря</h2>
    <br>
    <label for="humans-selector">Виберіть аккаунт</label>
    <?php
    echo '<select placeholder="Виберіть людину" id="humans-selector"><br><br>';
    while ($row = mysqli_fetch_row($rows)) {
        echo "<option value='" . $row[1] . "'>" . $row[0] . "</option>";
    }
    echo '</select><br><br>';
    ?>
    <label for="specialization">Спеціалізація</label>
    <input type="text" title="specialization" id="specialization">
    <br><br>
    <button onclick="addDoc()">Призначити лікарем</button>
</div>

<?php
@include ("footer.php");
?>

<script>
    function addDoc() {
        var h_id = document.getElementById("humans-selector").value;
        var specialization = document.getElementById("specialization").value;
        $.ajax({
            url: 'ajax/add_doctor.php',
            type: 'POST',
            data: {
                h_id: h_id,
                specialization: specialization,
            },
            success: function (response) {
                history.go(0); // перезагружаем страницу
            }
        })
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
      integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous"/>
