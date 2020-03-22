<style>
    /* ceci pour label heure minute..*/
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .li_code {
        display: inline-block;
        font-size: 100%;
        font-family: Century Gothic, serif;
        list-style-type: none;
        padding: 3%;
        text-transform: uppercase;
        color: yellow;
        text-align: center;
        background: #0b2e13;
        border: solid black;

    }

    /* ceci pour label heure minute..*/
    .li_code span {
        display: block;
        font-size: 100%;
        color: white;
        text-align: center;
        background: #0b2e13;
        font-family: -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        Roboto,
        Oxygen-Sans,
        Ubuntu,
        Cantarell,
        "Helvetica Neue",
        sans-serif;
    }

    .container12x {
        color: white;
        margin: 0 auto;
        padding: 0.5rem;
        text-align: center;
        border: solid black;
        background: #0b2e13;
    }
</style>
<div class="row">

    <div class="col-xl-5 col-sm-6 mb-12">       <!--debut-->
        <div class="card text-black-50 bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                </div>
                <h4 style="color: white"><?php echo __('Les élection commencent dans:') ?></h4>
                <ul class="nav-item">
                    <li class="li_code"><span id="day"></span>days</li>
                    <li class="li_code"><span id="hour"></span>Hours</li>
                    <li class="li_code"><span id="min"></span>Minutes</li>
                    <li class="li_code"><span id="sec"></span>Seconds</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-sm-6 mb-12">       <!--debut-->
        <div class="card text-black-50 bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                </div>
                <h4 style="color: green;"><?php echo __('Les élection prennent fin dans:') ?></h4>
                <ul class="nav-item">
                    <li class="li_code"><span id="day1"></span>days</li>
                    <li class="li_code"><span id="hour1"></span>Hours</li>
                    <li class="li_code"><span id="min1"></span>Minutes</li>
                    <li class="li_code"><span id="sec1"></span>Seconds</li>
                </ul>
            </div>
        </div>
    </div>


</div>


<?php


use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

$group = $this->getRequest()->getSession()->read('Auth.User.n_group');

$voteLists = TableRegistry::getTableLocator()->get('VoteLists');
$time = $voteLists->find()->where(['n_group' => $group])->first();
if ($time != null) {
    //recuperer le temps
    $start_time1 = $time->get('start_election');
    $start_time = $start_time1->i18nFormat('yyyy-MM-dd HH:mm:ss');

    $end_time1 = $time->get('end_election');
    $end_time = $end_time1->i18nFormat('yyyy-MM-dd HH:mm:ss');
    $today1 = Time::now();
    $today = $today1->i18nFormat('yyyy-MM-dd HH:mm:ss');

    //convertis en second
    $sec_start_elec = $start_time1->getTimestamp();
    $sec_today = $today1->getTimestamp();

    $sec_end_elec = $end_time1->getTimestamp();

}

?>


<script>

    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo $start_time;?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function () {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"


        document.getElementById("day").innerHTML = days;
        document.getElementById("hour").innerHTML = hours;
        document.getElementById("min").innerHTML = minutes;
        document.getElementById("sec").innerHTML = seconds;

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);

            document.getElementById("day").innerHTML = '';
            document.getElementById("hour").innerHTML = '';
            document.getElementById("min").innerHTML = '';
            document.getElementById("sec").innerHTML = '';
            // Set the date we're counting down to
            var countDownDate1 = new Date("<?php echo $end_time;?>").getTime();

            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate1 - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="end"
                document.getElementById("day1").innerHTML = days;
                document.getElementById("hour1").innerHTML = hours;
                document.getElementById("min1").innerHTML = minutes;
                document.getElementById("sec1").innerHTML = seconds;
                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);

                    document.getElementById("day1").innerHTML = '';
                    document.getElementById("hour1").innerHTML = '';
                    document.getElementById("min1").innerHTML = '';
                    document.getElementById("sec1").innerHTML = '';
                }
            }, 1000);
        }
    }, 1000);
</script>

