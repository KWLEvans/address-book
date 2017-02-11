$(function() {

  if ($("#contacts")) {
    $("#new-contact-form").hide();
    $("#add-contact-header, #contacts").addClass("clickable-header");
    $("#add-contact-header").click(function() {
      $("#new-contact-form").slideToggle();
    });
    $("#contacts").click(function() {
      $("#contacts").nextAll().slideToggle();
    });
  }

  $("#new-contact-button").click(function() {
    event.preventDefault();
    var userInput = $("input").get();
    var valid = true;
    for (var i = 0; i < userInput.length; i++) {
      if (!userInput[i]["value"]) {
        valid = false;
      }
    }
    if (valid) {
      $("#new-contact-form").submit();
    } else {
      alert("Please fill all contact fields.")
    }
  })

  $(".remove-button").click(function() {
    var userToDelete = $(this).parent().text();
    var parentElementToDelete = $(this).parent().parent();
    $.get("/delete_one", {userToDelete: userToDelete}, function(response) {
      if (response) {
          parentElementToDelete.remove();
          if (!$(".card")[0]) {
            $("#contacts").remove();
            $("#delete-all-form").remove();
          }
      }
    });
  });

  $(".edit-button").click(function() {
    var cardToEdit = $(this).parent().parent();
    var contactToEdit = $(this).parent().text();
    $.get("/edit_one", {contactToEdit: contactToEdit}, function(response) {
      cardToEdit.html(response);
    });
  });
});
