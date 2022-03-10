function openpart(portion) {
    var i;
    var x = document.getElementsByClassName("portion");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(portion).style.display = "block";
}