$("#loading").show();
document.addEventListener("DOMContentLoaded", function() {
    $("#loading").hide();
});
window.addEventListener('beforeunload', function () {
    $("#loading").show();
});

// document.addEventListener('htmx:beforeRequest', function (e) {
//     console.log(e)
// });