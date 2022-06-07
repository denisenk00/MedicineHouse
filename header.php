<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MED_HOUSE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">MED HOUSE <i class="fa fa-medkit"></i></i></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="language">
                        <img src="/img/en.png" alt="en" data-google-lang="en" class="language__img" translate="no">
                        <img src="/img/uk.png" height="15px" width="22px" alt="uk" data-google-lang="uk"
                             class="language__img" translate="no">
                    </div>
                </li>
                <?php
                include("connect.php");
                if (isset($_SESSION['login'])) {
                    $login = $_SESSION['login'];
                    $query = "SELECT h.human_id, p.patient_id, d.doctor_id 
                                    FROM humans h 
                                        LEFT JOIN patients p ON (h.human_id = p.human_id) 
                                        LEFT JOIN doctors d ON (h.human_id = d.human_id)
                                    WHERE h.email = '$login'";
                    include("check_query.php");
                    foreach ($result as $row) {
                        $is_patient = $row["patient_id"];
                        $is_doctor = $row["doctor_id"];
                    }
                    if ($is_patient != null) {
                        echo '<li><a href="medcard.php">Медична картка</a></li>';

                    }
                    if ($is_doctor != null) {
                        echo '<li><a href="doctor_cabinet.php">Кабінет лікаря</a></li>';
                    }
                    if ($login == 'SYSADM') {
                        echo '<li><a href="personnel.php">Персонал</a></li>';
                    }
                    echo '<li><a href="index.php">Про нас</a></li>';
                    echo '<li><a href="cabinet.php">Аккаунт</a></li>';
                    echo '<li><a href="exit.php" id="header_btn"><i class="fa fa-sign-out"></i> Вихід</a></html></li> ';
                } else {
                    echo '<html>
                        <li><a href="index.php">Про нас</a></li>
                        <li><a href="login.php"><i class="fa fa-sign-in"></i> Вхід</a></li>
                        <li><a href="registration.php">Реєстрація<i class="fa-regular fa-user-plus"></i></a></li>
                        </html>';
                }
                ?>


            </ul>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="../js/google-translate.js"></script>
<script src="//translate.google.com/translate_a/element.js?cb=TranslateInit"></script>
</body>
</html>
