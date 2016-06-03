$(document).ready(function() {
  var $container = $('#room-age-self');
  
  if ($container.length){
    var ageMax;
    var ageMin;
    var ageSolo;
    var numberOfroom = parseInt($('#pfa_mainbundle_room_numberOfCurrentMate').val());
    if (numberOfroom<=1){
      ageMax = $('#pfa_mainbundle_room_selfPreference_ageMax').parent().parent().detach();
      ageMin = $('#pfa_mainbundle_room_selfPreference_ageMin').parent().parent().detach();
    }
    else
    {
      ageSolo = $('#pfa_mainbundle_room_selfPreference_ageSolo').parent().parent().detach();
    }

    $('#pfa_mainbundle_room_numberOfCurrentMate').change(function() {
      numberOfroom = parseInt($(this).val());
      if ((numberOfroom>1) && ($container.find('#pfa_mainbundle_room_selfPreference_ageMax').parent().length == 0) && ($container.find('#pfa_mainbundle_room_selfPreference_ageMin').parent().length == 0)){
        ageMin.appendTo('#room-age-self');
        ageMax.appendTo('#room-age-self');
        ageSolo = $('#pfa_mainbundle_room_selfPreference_ageSolo').parent().parent().detach();
        ageMax = null;
        ageMin = null;
      } else if((numberOfroom==1) && ($container.find('#pfa_mainbundle_room_selfPreference_ageMax').parent().length != 0) && ($container.find('#pfa_mainbundle_room_selfPreference_ageMin').parent().length != 0)){
        ageMax = $('#pfa_mainbundle_room_selfPreference_ageMax').parent().parent().detach();
        ageMin = $('#pfa_mainbundle_room_selfPreference_ageMin').parent().parent().detach();
        ageSolo.appendTo('#room-age-self');
        ageSolo = null;
      }
    });
  }

  if ($('#current-colac').length){
    $('#pfa_mainbundle_room_numberOfCurrentMate').find('[value=0]').remove();

    $('#pfa_mainbundle_room_numberOfCurrentMate').selectpicker('refresh');
    $('#pfa_mainbundle_room_numberOfCurrentMate').selectpicker('render');

    var tmp = '<select id="pfa_mainbundle_room_numberOfCurrentMate" name="pfa_mainbundle_room[numberOfCurrentMate]" style="display: none;"><option value="0">0</option></select>';
    var currentBlock;
    if ($('#pfa_mainbundle_room_advertiserType').val() == 2) {
      currentBlock = $('#current-colac').detach();
      $('form').append(tmp);
    }

    $('#pfa_mainbundle_room_advertiserType').change(function() {
      if (($(this).val() == 2) && ($('#current-colac').length)) {
        currentBlock = $('#current-colac').detach();
        $('form').append(tmp);
      } else if (($(this).val() == 1) && ($('#current-colac').length == 0)) {
        $('#pfa_mainbundle_room_numberOfCurrentMate').remove();
        currentBlock.insertBefore($('#submit-button'));

        $('#pfa_mainbundle_room_numberOfCurrentMate').selectpicker('refresh');
        $('#pfa_mainbundle_room_numberOfCurrentMate').selectpicker('render');

        $('#pfa_mainbundle_room_selfPreference_gender').selectpicker('refresh');
        $('#pfa_mainbundle_room_selfPreference_gender').selectpicker('render');

        $('#pfa_mainbundle_room_selfPreference_ageSolo').selectpicker('refresh');
        $('#pfa_mainbundle_room_selfPreference_ageSolo').selectpicker('render');

        $('#pfa_mainbundle_room_selfPreference_ageMin').selectpicker('refresh');
        $('#pfa_mainbundle_room_selfPreference_ageMin').selectpicker('render');

        $('#pfa_mainbundle_room_selfPreference_ageMax').selectpicker('refresh');
        $('#pfa_mainbundle_room_selfPreference_ageMax').selectpicker('render');
      }
    });
  }
});