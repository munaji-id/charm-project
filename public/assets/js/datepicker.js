$(function() {
  'use strict';

  if($('#datePickerStart').length) {
    // var date = new Date();
    // var today = new Date(date.getFullYear(), date.getMonth(), date.getDate()+3);
    $('#datePickerStart').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    });
    // $('#datePickerStart').datepicker('setDate', today);
  }
  if($('#datePickerEnd').length) {
    var date = new Date();
    // var today = new Date(date.getFullYear(), date.getMonth(), date.getDate()+3);
    $('#datePickerEnd').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    });
    // $('#datePickerEnd').datepicker('setDate', today);
  }
});