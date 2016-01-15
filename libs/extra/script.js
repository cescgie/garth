$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal-trigger-footer').leanModal({
    dismissible: true, // Modal can be dismissed by clicking outside of the modal
    opacity: .5, // Opacity of modal background
    in_duration: 300, // Transition in duration
    out_duration: 200, // Transition out duration
    ready: function() {
      console.log('Ready');
    }, // Callback for Modal open
    complete: function() {
      console.log('Closed');
    } // Callback for Modal close
  });
});
//edit Images
$('.modal-trigger-Image').leanModal({
    dismissible: true, // Modal can be dismissed by clicking outside of the modal
    opacity: .5, // Opacity of modal background
    in_duration: 300, // Transition in duration
    out_duration: 200, // Transition out duration
    ready: function() {
      console.log('Ready');
    }, // Callback for Modal open
    complete: function() {
      console.log('Closed');
    } // Callback for Modal close
  }
);
//edit oberkategorie
$('.modal-trigger-kategorie').leanModal({
    dismissible: true, // Modal can be dismissed by clicking outside of the modal
    opacity: .5, // Opacity of modal background
    in_duration: 300, // Transition in duration
    out_duration: 200, // Transition out duration
    ready: function() {
      console.log('Ready');
    }, // Callback for Modal open
    complete: function() {
      console.log('Closed');
    } // Callback for Modal close
  }
);
//editreihenfolge
$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal-trigger-reihenfolge').leanModal({
    dismissible: true, // Modal can be dismissed by clicking outside of the modal
    opacity: .5, // Opacity of modal background
    in_duration: 300, // Transition in duration
    out_duration: 200, // Transition out duration
    ready: function() {
      console.log('Ready');
    }, // Callback for Modal open
    complete: function() {
      console.log('Closed');
    } // Callback for Modal close
  });
});
