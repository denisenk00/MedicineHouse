<?php
@include("dbaccess.php");
@include("access_doctor.php");
@include("header.php");


$conclusion_id = $_GET["conclusion_id"];
$row = getConclusion($conclusion_id);
$patient_id = $row[1];
echo '<input type="hidden" id="conclusion-id" value="' . $conclusion_id . '">';
echo '<input type="hidden" id="patient-id" value="' . $patient_id . '">'
?>

<div class="content container centered">
    <br><br>
    <?php
    echo '<label for="conclusion">Діагноз:</label>';
    echo '<input type="text" id="conclusion" value="' . $row[6] . '"><br><br>';
    echo '<label for="symptoms">Симптоми:</label>';
    echo '<input type="text" id="symptoms" value="' . $row[4] . '"><br><br>';
    echo '<label for="recommendations">Рекомендації:</label>';
    echo '<input type="text" id="recommendations" value="' . $row[5] . '"><br><br>';
    ?>
    <button onclick="updateConclusion()">Оновити запис</button>
    <br><br>
    <button onclick="deleteConclusion()">Видалити запис</button>
</div>

<?php @include("footer.php"); ?>

<script>
    function updateConclusion() {
        var conclusion_id = document.getElementById("conclusion-id").value;
        var concl = document.getElementById("conclusion").value;
        var symptoms = document.getElementById("symptoms").value;
        var recommendation = document.getElementById("recommendations").value;
        var patient_id = document.getElementById("patient-id").value;


        if (concl === "" || symptoms === "" || recommendation === "") {
            alert("Перевірте чи заповнені всі поля!");
            exit;
        }

        $.ajax({
            url: 'ajax/update_conclusion.php',
            type: 'POST',
            data: {
                conclusion_id: conclusion_id,
                conclusion: concl,
                symptoms: symptoms,
                recommendations: recommendation
            }
        })
        window.location.href = "doctor_medcard.php?patient_id=" + patient_id;
    }

    function deleteConclusion() {
        var conclusion_id = document.getElementById("conclusion-id").value;
        var patient_id = document.getElementById("patient-id").value;

        $.ajax({
            url: 'ajax/delete_conclusion.php',
            type: 'POST',
            data: {
                conclusion_id: conclusion_id,
            }
        })
        window.location.href = "doctor_medcard.php?patient_id=" + patient_id;

    }
</script>
