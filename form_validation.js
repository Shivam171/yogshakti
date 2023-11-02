document.addEventListener("DOMContentLoaded", function () {
  // Get the form element
  var form = document.getElementById("registrationForm");

  // Add an event listener for form submission
  form.addEventListener("submit", function (event) {
    // Validate the name field to allow only letters (no numbers or special characters)
    var nameInput = document.getElementById("name");
    var nameValue = nameInput.value.trim();

    if (!isOnlyLettersAndSpaces(nameValue)) {
      alert("Name can only contain letters and spaces.");
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Validate the email field to allow only Gmail addresses
    var emailInput = document.getElementById("email");
    var emailValue = emailInput.value.trim();

    if (!isGmailAddress(emailValue)) {
      alert("Please enter a valid Gmail address.");
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Validate the phone number field to ensure it's at least 10 digits
    var phoneInput = document.getElementById("phone");
    var phoneValue = phoneInput.value.trim();

    if (phoneValue.length !== 10 || isNaN(phoneValue)) {
      alert(
        "Phone number must be exactly 10 digits long and consist of numbers only."
      );
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Validate the date field to ensure it's not empty and not before today
    var dateInput = document.getElementById("date");
    var dateValue = dateInput.value.trim();
    var today = new Date();

    if (dateValue === "" || new Date(dateValue) < today) {
      alert("Please choose a date that is today or later.");
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Validate the instructor dropdown to ensure a valid selection
    var instructorSelect = document.getElementById("instructor");
    var instructorValue = instructorSelect.value;

    if (instructorValue === "default") {
      alert("Please select an instructor.");
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Validate the message field to ensure it's not empty
    var messageInput = document.getElementById("message");
    var messageValue = messageInput.value.trim();

    if (messageValue === "") {
      alert("Please add a message.");
      event.preventDefault(); // Prevent form submission
      return;
    }
  });

  // Function to check if a string contains only letters and spaces
  function isOnlyLettersAndSpaces(str) {
    return /^[A-Za-z\s]+$/.test(str);
  }

  // Function to check if a string is a Gmail address
  function isGmailAddress(str) {
    return /@gmail\.com$/.test(str) || /@gmail\.co\.in$/.test(str);
  }
});
