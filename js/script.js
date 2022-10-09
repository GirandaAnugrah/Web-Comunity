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
  const username = $(this).data("username");
  const img = $(this).data("img");
  const profil = $(this).data("profil");
  const text = $(this).data("text");
  if (img == null) {
    $("#gambarDt").hide();
  }
  $("#imgPosting").attr("src", "img/posting/" + img);
  $("#detailUsername").html(username);
  $("#detailProfile").attr("src", "img/profil/" + profil);
  $("#detailText").html(text);
  $("#detailPosting").modal("show", "slow");
});
