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
  const id = $(this).data("id");
  const img = $(this).data("img");
  const profil = $(this).data("profil");
  const text = $(this).data("text");
  const kategori = $(this).data("kategori");
  console.log(kategori);
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
  $("#tanggal").html(tgl);
  $("#detailProfile").attr("src", "img/profil/" + profil);
  $("#detailText").html(text);
  $("#detailPosting").modal("show", "slow");
  $("#form").attr("data-id", id);
  const newClass = "comment" + id.toString();
  const newContainer = "com" + id.toString();
  $("#inputComment").addClass(newClass);
  $("#modalComment").addClass(newContainer);
  // console.log(newClass);
  $("#modalComment").load("comment.php", { idPosting: id });
  // $(".comment").html("<h1><?=$_SESSION['foto_profil'];?></h1>");
});

// media Query
// $(document).load($(window).bind("resize", checkPosition));
if (window.matchMedia("(max-width: 768px)").matches) {
  $("#my-post").removeClass("overflow-auto");
}
