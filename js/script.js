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
$(".posting").click(function () {
  const username = $(this).data("username");
  const img = $(this).data("img");
  const profil = $(this).data("profil");
  const text = $(this).data("text");
  if (img == -1) {
    $("#gambarDt").addClass("visually-hidden");
    $("#besarModal").removeClass("modal-xl");
    $("#sesuai").removeClass("col-md-5");
    $("#sesuai").addClass("col-md-12");
  } else {
    $("#gambarDt").removeClass("visually-hidden");
    $("#besarModal").addClass("modal-xl");
    $("#sesuai").removeClass("col-md-12");
    $("#sesuai").addClass("col-md-5");
    $("#imgPosting").attr("src", "img/posting/" + img);
  }
  $("#detailUsername").html(username);
  $("#detailProfile").attr("src", "img/profil/" + profil);
  $("#detailText").html(text);
  $("#detailPosting").modal("show", "slow");
});

// media Query
// $(document).load($(window).bind("resize", checkPosition));
if (window.matchMedia("(max-width: 768px)").matches) {
  $("#my-post").removeClass("overflow-auto");
}
