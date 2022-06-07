<?php
session_start();
@include("header.php");
?>
<div class="content">
    <div id="head-title">
        <div class="container centered ">
            <h1>Вітаємо на сторінці медичного центру MED HOUSE!
                <br>
                Тут ти можеш знайти цікаву інформацію про нас, а ми тобі допоможемо залишатися здоровим)
            </h1>
        </div>
    </div>

    <div class="container-fluid centered">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <img src="/img/pexels-mart-production-7088837.jpg" class="img-rounded" alt="Responsive image"
                     style="width:100%">
            </div>
            <div class="col-md-5 container centered">
                <p class="text-center photo-text">У нас працюють кращі спеціалісти країни!</p>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <p class="text-center photo-text">Ми піклуємось за своїх пацієнтів</p>
            </div>
            <div class="col-md-5">
                <img src="/img/pexels-pavel-danilyuk-5998448.jpg" class="img-rounded" alt="Responsive image"
                     style="width:100%">
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <img src="/img/pexels-edward-jenner-4031321.jpg" class="img-rounded" alt="Responsive image"
                     style="width:100%">
            </div>
            <div class="col-md-5">
                <p class="text-center photo-text">Лікуємо кращими ліками та новітнім обладнанням</p>
            </div>
        </div>

        <br><br><br>
        <h3>Розташування</h3>
        <br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20136.300995199745!2d34.832702566720116!3d50.88601399434307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4128fe0120892805%3A0xb837b8752f41a97e!2z0KHRg9C80YHRjNC60LjQuSDQtNC10YDQttCw0LLQvdC40Lkg0YPQvdGW0LLQtdGA0YHQuNGC0LXRgiwg0KHRg9C80JTQow!5e0!3m2!1sru!2sua!4v1653901695844!5m2!1sru!2sua"
                width="80%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        <br>
        <br>
    </div>
</div>
<?php
@include("footer.php");
?>


