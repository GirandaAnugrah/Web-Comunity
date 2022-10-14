$("#postingan_text").click(function () {
  $("#postingModal").modal("show");
});

$(".posting").click(function () {
  const username = $(this).data("username");
  const id = $(this).data("id");
  const img = $(this).data("img");
  const profil = $(this).data("profil");
  const text = $(this).data("text");
  const kategori = $(this).data("kategori");
  const tgl = $(this).attr("tgl");
  const love = $(this).attr("love") + " Likes";
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
  $("#kategori").html(kategori.toUpperCase());
  console.log(love);
  $("#love").html(love);
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
});

// media Query

if ($(window).width() < 767) {
  $("#my-post").removeClass("overflow-auto");
}
