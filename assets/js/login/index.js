var timeIncrement = document.getElementById("timeIncrement").value;
var username = document.getElementById("username");
var password = document.getElementById("password");
var loginButton = document.getElementById("login-button");
var displayTimer = document.getElementById("display-timer");

// localStorage.clear("count_timer");
// localStorage.clear("timeIncrement");
let getTimeIncrement = localStorage.getItem("time_increment");
if (timeIncrement || count_timer != 0 || getTimeIncrement) {
    if (localStorage.getItem("count_timer")) {
        var count_timer = localStorage.getItem("count_timer");
    } else {
        var count_timer = 30 * timeIncrement;
    }
    let minutes = parseInt(count_timer / 60);
    let seconds = parseInt(count_timer % 60);
    localStorage.setItem("time_increment", timeIncrement);

    function countDownTimer() {
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }

        document.getElementById("total-time-left").innerHTML =
            " Please wait for " + minutes + " Minutes " + seconds + " Seconds";
        if (count_timer == 0) {
            localStorage.clear("count_timer");
            localStorage.clear("timeIncrement");
            loginButton.disabled = false
            username.disabled = false
            password.disabled = false
            displayTimer.style.display = "none"
        } else {
            displayTimer.style.display = "block"
            history.pushState(null, document.title, location.href);
            window.addEventListener('popstate', function (event) {
                history.pushState(null, document.title, location.href);
            });

            count_timer = count_timer - 1;
            minutes = parseInt(count_timer / 60);
            seconds = parseInt(count_timer % 60);
            localStorage.setItem("count_timer", count_timer);
            loginButton.disabled = true
            username.disabled = true
            password.disabled = true
            setTimeout("countDownTimer()", 1000);
        }
    }
    // countDownTimer()
    setTimeout("countDownTimer()", 1000);
}