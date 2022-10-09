$("#changeFotoProfile").hide();
// $("#postingModal").hide();
$("#foto-profil").click(function () {
  $("#changeFotoProfile").toggle("slow");
});

$("#postingan_text").click(function () {
  $("#postingModal").modal("show");
});

$("#like").click(function () {
  $("#like").addClass("text-danger");
  console.log("Hello");
});
$(".card").click(function () {
  console.log("Hello World");
});
