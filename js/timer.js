// Set the date we're counting down to
var countDownDate = new Date(brexit_string.uk_time).getTime();

// Update the count down every 1 second
var x = setInterval(function() {
    // Set the id for timer
    var timerID = "brexit-timer";
    // Get todays date and time
    var now = new Date().getTime();
    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById(timerID).innerHTML = brexit_string.wording + " (" + brexit_string.uk_time + ") is in " + days + " days " + hours + " hours " + minutes + " mins " + seconds + "s ";

    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById(timerID).innerHTML = "Brexit already happened.";
    }
}, 1000);

// console.log(brexit_string.wording);
// console.log(brexit_string.uk_time);