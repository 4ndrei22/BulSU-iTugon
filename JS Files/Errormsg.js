$(document).ready(function () {
    $('#form').validate({
      rules: {
        firstname: {
          required: true
        },
        lastname: {
            required: true
        },
        email: {
          required: true,
          email: true
        },
        contact_number: {
          required: true,
          rangelength: [11, 12],
          number: true
        },
        password: {
          required: true,
          minlength: 8
        },
        confirmPassword: {
          required: true,
          equalTo: "#password"
        }
      },
      messages: {
        firstname: 'Please enter your first name.',
        lastname: 'Please enter last name.',
        email: {
          required: 'Please enter Email Address.',
          email: 'Please enter a valid Email Address.',
        },
        contactnum: {
          required: 'Please enter Contact.',
          rangelength: 'Contact should be 11 digit number.'
        },
        password: {
          required: 'Please enter Password.',
          minlength: 'Password must be at least 8 characters long.',
        },
        confirmPassword: {
          required: 'Please enter Confirm Password.',
          equalTo: 'Confirm Password do not match with Password.',
        }
      },
      submitHandler: function (form) {
        form.submit();
      }
    });
  });