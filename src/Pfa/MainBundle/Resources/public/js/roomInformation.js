$(document).ready(function() {
  var $container = $('[id ^=pfa_mainbundle_][id $=_roomsInformations]');
  if ($container.length){
    var index = 0;
    
    if($('[id ^=pfa_mainbundle_wholeproperty]').length){
      var numberOfTotalRooms = parseInt($('#pfa_mainbundle_wholeproperty_numberOfTotalRooms').val());

      $('#pfa_mainbundle_wholeproperty_numberOfTotalRooms').change(function() {
        var numberOfTotalRooms = parseInt($(this).val());
       

        if ($container.find(':input').length > 0){
          $container.children('div').each(function() {
            $(this).remove();
          });
        }

        index = 0;
        for (var i = 0; i < numberOfTotalRooms; i++) {
          addRoomInfo($container);
        };
      });


    }

    else{

      $('#pfa_mainbundle_room_numberOfRoomsToRent').change(function() {
        var numberOfTotalRooms = parseInt($('#pfa_mainbundle_room_numberOfRoomsToRent').val());
        if ($container.find(':input').length > 0){
          $container.children('div').each(function() {
            $(this).remove();
          });
        }
        index = 0;
        for (var i = 0; i < numberOfTotalRooms; i++) {
          addRoomInfoRoom($container);
        };
      });

      $('#pfa_mainbundle_room_numberOfTotalRooms').change(function(){
        if ($container.find(':input').length > 0){
          $container.children('div').each(function() {
            $(this).remove();
          });
          index = 0;
          addRoomInfoRoom($container);
          index = 0;
        }
      });
    }

    function addRoomInfo($container) {
      var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Chambre N°' + (index+1))
        .replace(/__name__/g, index));
      
      $container.append($prototype);

      $('#pfa_mainbundle_wholeproperty_roomsInformations_' + index + '_size').selectpicker('refresh');
      $('#pfa_mainbundle_wholeproperty_roomsInformations_' + index + '_size').selectpicker('render');

      $('#pfa_mainbundle_wholeproperty_roomsInformations_' + index + '_suite').iCheck();
      index++;
    }

    function addRoomInfoRoom($container) {
      var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Chambre n°' + (index+1))
        .replace(/__name__/g, index));

      $container.append($prototype);

      $('#pfa_mainbundle_room_roomsInformations_' + index + '_size').selectpicker('refresh');
      $('#pfa_mainbundle_room_roomsInformations_' + index + '_size').selectpicker('render');

      $('#pfa_mainbundle_room_roomsInformations_' + index + '_suite').iCheck();
      $('#pfa_mainbundle_room_roomsInformations_'+ index +'_alreadyOneThere').iCheck();


      if ($('#pfa_mainbundle_room_advertiserType').val() == 2){
        $('#pfa_mainbundle_room_roomsInformations_'+ index +'_alreadyOneThere').parent().parent().parent().parent().parent().remove();
      }
      else if ($('#pfa_mainbundle_room_advertiserType').val() == 1){
        if ($('#pfa_mainbundle_room_roomsInformations_'+ index +'_size').val() == 1){
          $('#pfa_mainbundle_room_roomsInformations').find('[id $=_alreadyOneThere]').parent().parent().parent().parent().parent().remove();
        }
      }

      index++;
    }

  }
});