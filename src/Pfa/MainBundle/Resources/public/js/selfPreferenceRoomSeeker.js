$(document).ready(function() {
  var $container = $('#room-age-self-seeker');
  
  if ($container.length){
    var ageMax;
    var ageMin;
    var ageSolo;
    var numberOfroom = parseInt($('#pfa_mainbundle_roomseeker_numberOfSeekers').val());
    if (numberOfroom<=1){
      ageMax = $('#pfa_mainbundle_roomseeker_selfPreference_ageMax').parent().parent().detach();
      ageMin = $('#pfa_mainbundle_roomseeker_selfPreference_ageMin').parent().parent().detach();
    }
    else
    {
      ageSolo = $('#pfa_mainbundle_roomseeker_selfPreference_ageSolo').parent().parent().detach();
    }

    $('#pfa_mainbundle_roomseeker_numberOfSeekers').change(function() {
      numberOfroom = parseInt($(this).val());
      if ((numberOfroom>1) && ($container.find('#pfa_mainbundle_roomseeker_selfPreference_ageMax').parent().length == 0) && ($container.find('#pfa_mainbundle_roomseeker_selfPreference_ageMin').parent().length == 0)){
        ageMin.appendTo('#room-age-self-seeker');
        ageMax.appendTo('#room-age-self-seeker');
        ageSolo = $('#pfa_mainbundle_roomseeker_selfPreference_ageSolo').parent().parent().detach();
        ageMax = null;
        ageMin = null;
      } else if((numberOfroom==1) && ($container.find('#pfa_mainbundle_roomseeker_selfPreference_ageMax').parent().length != 0) && ($container.find('#pfa_mainbundle_roomseeker_selfPreference_ageMin').parent().length != 0)){
        ageMax = $('#pfa_mainbundle_roomseeker_selfPreference_ageMax').parent().parent().detach();
        ageMin = $('#pfa_mainbundle_roomseeker_selfPreference_ageMin').parent().parent().detach();
        ageSolo.appendTo('#room-age-self-seeker');
        ageSolo = null;
      }
    });
  }
  });