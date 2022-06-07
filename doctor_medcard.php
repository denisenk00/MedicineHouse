<?php
@include("dbaccess.php");
@include("access_doctor.php");
@include("header.php");

$patient_id = $_GET["patient_id"];
echo '<input type="hidden" id="patient_id" value="' . $patient_id . '">';
$row = getHumanByPatientId($patient_id);
?>

<div class="container centered content">
    <br>
    <?php
    echo '<h2>' . $row[1] . ' ' . $row[2] . ' </h2>';
    ?>
    <br>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#all-conclusions" role="tab" data-toggle="tab">Всі діагнози</a></li>
        <li><a href="#add-conclusion" role="tab" data-toggle="tab">Додати запис</a></li>
    </ul>
    <br>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="all-conclusions">
            <table class="table table-striped centered">
                <thead>
                <tr>
                    <th>Діагноз</th>
                    <th>Дата</th>
                    <th>Лікар</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 25;
                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $offset = $limit * ($page - 1);
                $total_pages = round(getConclusionsCountByPatientId($patient_id)[0] / $limit, 0);

                $rows = getConclusionsByPatientId($patient_id, $limit, $offset);
                while ($row = mysqli_fetch_row($rows)) {
                    echo "<tr>";
                    echo "<td><a href='conclusion.php?conclusion_id=" . $row[0] . "'>" . $row[1] . "</a></td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <?php
            $params = '&patient_id=' . $patient_id;
            @include("pagination.php");
            ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="add-conclusion">
            <label for="conclusion">Діагноз:</label>
            <input type="text" id="conclusion">
            <br><br>
            <label for="symptoms">Симптоми:</label>
            <input type="text" id="symptoms">
            <br><br>
            <label for="recommendations">Рекомендації:</label>
            <input type="text" id="recommendations">
            <br><br>
            <button onclick="addConclusion()">Додати</button>
        </div>
    </div>
</div>
<?php @include("footer.php"); ?>

<script>
    function addConclusion() {
        var patient_id = document.getElementById("patient_id").value;
        var concl = document.getElementById("conclusion").value;
        var symptoms = document.getElementById("symptoms").value;
        var recommendation = document.getElementById("recommendations").value;

        if (concl === "" || symptoms === "" || recommendation === "") {
            alert("Перевірте чи заповнені всі поля!");
            exit;
        }

        $.ajax({
            url: 'ajax/add_conclusion.php',
            type: 'POST',
            data: {
                patient_id: patient_id,
                conclusion: concl,
                symptoms: symptoms,
                recommendations: recommendation
            }
        })
        window.location.href = "doctor_medcard.php?patient_id=" + patient_id;
    }
</script>


