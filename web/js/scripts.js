$(function() {
  $(".remove-button").click(function() {
    var userToDelete = $(this).parent().text();
    var parentElementToDelete = $(this).parent().parent();
    $.post("/delete_one", {userToDelete: userToDelete}, function(response) {
      if (response) {
          parentElementToDelete.remove();
          if (!$(".card")[0]) {
            $("h2").remove();
            $("#delete-all-form").remove();
          }
      }
    });
  });
});
