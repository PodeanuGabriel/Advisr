// Set app id selected to be deleted
$('#deleteAppModal').on('shown.bs.modal', function (e) {
  var appID = (e.relatedTarget && e.relatedTarget.parentElement ? e.relatedTarget.parentElement.id : "");
  $("#delete_app_id").val(appID);
});

