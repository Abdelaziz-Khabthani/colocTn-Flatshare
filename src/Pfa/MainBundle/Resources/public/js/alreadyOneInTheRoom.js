$(document).ready(function() {
    var $container = $('#pfa_mainbundle_room_roomsInformations');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($container.length) {
        var alreadyOneThere = '<div class="col-md-6 col-sm-6"><div class="form-group"><div class="checkbox"><label><input type="checkbox" id="pfa_mainbundle_room_roomsInformations_index_alreadyOneThere" name="pfa_mainbundle_room[roomsInformations][index][alreadyOneThere]" value="1" /><label for="pfa_mainbundle_room_roomsInformations_index_alreadyOneThere">Il déja quelqun dans la chambre</label></label></div></div></div>';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($('#pfa_mainbundle_room_advertiserType').val() == 2) {
            $('[id ^=pfa_mainbundle_room_roomsInformations_][id $=_alreadyOneThere]').each(function() {
                $(this).parent().parent().parent().parent().remove(); //??
            })
        } else if ($('#pfa_mainbundle_room_advertiserType').val() == 1) {
            for (var i = 0; i < parseInt($('#pfa_mainbundle_room_numberOfRoomsToRent').val()); i++) {
                if (($('#pfa_mainbundle_room_roomsInformations_' + i).find('#pfa_mainbundle_room_roomsInformations_' + i + '_size').val() == 2) && ($('#pfa_mainbundle_room_roomsInformations_' + i).find('#pfa_mainbundle_room_roomsInformations_' + i + '_alreadyOneThere').length == 0)) {
                    var newString = alreadyOneThere.replace(/index/g, i);
                    $('#pfa_mainbundle_room_roomsInformations_' + i).find('.row').last().append(newString);
                    $('#pfa_mainbundle_room_roomsInformations_'+ index +'_alreadyOneThere').iCheck();
                }
            };
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('[id ^=pfa_mainbundle_room_roomsInformations_][id $=_size]').each(function() {
            if ($(this).val() == 1) {
                if ($(this).parent().parent().parent().parent().find('[id $=_alreadyOneThere]').length)
                    $(this).parent().parent().parent().parent().find('[id $=_alreadyOneThere]').parent().parent().parent().parent().parent().remove();
            } else if ($(this).val() == 2) {
                var index = parseInt($(this).parent().parent().parent().parent().attr('id')[$(this).parent().parent().parent().parent().attr('id').length - 1]);
                if (($(this).parent().parent().parent().parent().find('[id $=_alreadyOneThere]').length == 0) && ($('#pfa_mainbundle_room_advertiserType').val() == 1)) {
                    var newString = alreadyOneThere.replace(/index/g, index);
                    $(this).parent().parent().parent().parent().find('.row').last().append(newString);
                    $('#pfa_mainbundle_room_roomsInformations_'+ index +'_alreadyOneThere').iCheck();
                }
            }
        })

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('#pfa_mainbundle_room_advertiserType').change(function() {

            if ($(this).val() == 2) {
                $('[id ^=pfa_mainbundle_room_roomsInformations_][id $=_alreadyOneThere]').each(function() {
                    $(this).parent().parent().parent().parent().remove();
                })
            } else if ($(this).val() == 1) {
                for (var i = 0; i < parseInt($('#pfa_mainbundle_room_numberOfRoomsToRent').val()); i++) {
                    if (($('#pfa_mainbundle_room_roomsInformations_' + i).find('#pfa_mainbundle_room_roomsInformations_' + i + '_size').val() == 2) && ($('#pfa_mainbundle_room_roomsInformations_' + i).find('#pfa_mainbundle_room_roomsInformations_' + i + '_alreadyOneThere').length == 0)) {
                        var newString = alreadyOneThere.replace(/index/g, i);
                        $('#pfa_mainbundle_room_roomsInformations_' + i).find('.row').last().append(newString);
                        $('#pfa_mainbundle_room_roomsInformations_'+ i +'_alreadyOneThere').iCheck();
                    }
                };
            }


        });

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $(document).on('change', '[id ^=pfa_mainbundle_room_roomsInformations_][id $=_size]', function() {
            if ($(this).val() == 1) {
                if ($(this).parent().parent().parent().parent().find('[id $=_alreadyOneThere]').length)
                    $(this).parent().parent().parent().parent().find('[id $=_alreadyOneThere]').parent().parent().parent().parent().remove();
            } else if ($(this).val() == 2) {
                alert('aaa');
                var index = parseInt($(this).parent().parent().parent().parent().attr('id')[$(this).parent().parent().parent().parent().attr('id').length - 1]);
                if (($(this).parent().parent().parent().parent().find('[id $=_alreadyOneThere]').length == 0) && ($('#pfa_mainbundle_room_advertiserType').val() == 1)) {
                    alert('bbb');
                    var newString = alreadyOneThere.replace(/index/g, index);
                    $(this).parent().parent().parent().parent().find('.row').last().append(newString);
                    $('#pfa_mainbundle_room_roomsInformations_'+ index +'_alreadyOneThere').iCheck();
                }
            }
        });
    }
});