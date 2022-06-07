<?php
@include("header.php");
@include("dbaccess.php");
@include("access.php");
?>
<div class="content container centered">
    <br><br>
    <h1>Моя картка</h1>
    <br><br>
    <table id="conclusions" class="table table-striped centered">
        <thead>
        <tr>
            <td>Діагноз</td>
            <td>Дата</td>
            <td>Лікар</td>
            <td>Симптоми</td>
            <td>Рекомендації</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $login = $_SESSION["login"];

        $rows = getConclusionsToMedcard($login);

        while ($row = mysqli_fetch_row($rows)) {
            echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<?php @include("footer.php"); ?>
