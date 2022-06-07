<?php
@include("dbaccess.php");
@include("access_doctor.php");
@include("header.php");
?>
<div class="container centered content">
    <br>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#all-cards" role="tab" data-toggle="tab">Всі медичні картки</a></li>
        <li><a href="#add-card" role="tab" data-toggle="tab">Завести медичну карту</a></li>
    </ul>
    <br>
    <div class="tab-content centered">
        <div role="tabpanel" class="tab-pane active centered" id="all-cards">
            <table class="table table-striped centered">
                <thead>
                <tr>
                    <th>Прізвище</th>
                    <th>Ім'я</th>
                    <th>Дата народження</th>
                    <th>Стать</th>
                    <th>Телефон</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $login = $_SESSION["login"];

                $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 25;
                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $offset = $limit * ($page - 1);
                $total_pages = round(getPatientsCountWithoutMe($login)[0] / $limit, 0) + 1;

                $patients = getPatientsInfoWithoutMe($login, $limit, $offset);

                while ($row = mysqli_fetch_row($patients)) {
                    echo "<tr>";
                    echo "<td><a href='doctor_medcard.php?patient_id=" . $row[0] . "'>" . $row[1] . "</a></td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[4] . "</td>";
                    echo "<td>" . $row[5] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <?php @include("pagination.php"); ?>
        </div>
        <div role="tabpanel" class="tab-pane centered" id="add-card">
            <br><br>
            <label for="human-selector">Виберіть аккаунт</label>
            <?php
            $rows = getHumansNoPatients($_SESSION["login"]);
            echo '<select required id="human-selector">';
            while ($row = mysqli_fetch_row($rows)) {
                echo '<option value="' . $row[1] . '">' . $row[0] . '</option>';
            }
            echo '</select>';
            ?>
            <br><br>
            <label for="sex-selector">Стать:</label>
            <select id="sex-selector">
                <option value="MAN">Чоловік</option>
                <option value="WOMAN">Жінка</option>
            </select>
            <br><br>
            <label for="birthdate-picker">Дата народження</label>
            <input class="datepicker form-control" id="birthdate-picker" type="text"/>
            <br>
            <button onclick="addCard()">Створити</button>
        </div>
    </div>
</div>

<?php
@include("footer.php");
?>

<script src="https://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://bootstraptema.ru/plugins/2015/b-v3-3-6/bootstrap.min.js"></script>
<script src="https://bootstraptema.ru/_sf/3/393.js"></script>
<script>
    $('.datepicker').datepicker({
        weekStart: 1,
        color: 'red'
    });

    function addCard() {
        var human_id = document.getElementById("human-selector").value;
        var sex = document.getElementById("sex-selector").value;
        var birth_date = document.getElementById("birthdate-picker").value;

        $.ajax({
            url: 'ajax/add_medcard.php',
            type: 'POST',
            data: {
                h_id: human_id,
                sex: sex,
                birth_date: birth_date
            },
            success: function (response) {
                alert("Медичну карту успішно додано");
                history.go(0); // перезагружаем страницу
            }
        })
    }
</script>

