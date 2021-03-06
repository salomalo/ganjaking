jQuery(document).ready(function($) {
  jQuery('.mepr-resend-welcome-email').click( function() {
    jQuery('.mepr-resend-welcome-email-loader').show();

    var data = {
      action: 'mepr_resend_welcome_email',
      uid: jQuery(this).data('uid'),
      nonce: jQuery(this).data('nonce')
    };

    jQuery.post(ajaxurl, data, function(response) {
      jQuery('.mepr-resend-welcome-email-loader').hide();
      jQuery('.mepr-resend-welcome-email-message').text(response);
    });

    return false;
  });

  $('body').on('click', '#submit', function (e) {
    var form = $(this).closest('form');
    var submittedTelInputs = document.querySelectorAll(".mepr-tel-input");
    for (var i = 0; i < submittedTelInputs.length; i++) {
      var iti = window.intlTelInputGlobals.getInstance(submittedTelInputs[i]);
      submittedTelInputs[i].value = iti.getNumber();
    }
  });
});
