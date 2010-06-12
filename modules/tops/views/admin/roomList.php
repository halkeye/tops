<h3>Rooms</h3>

<table>
    <caption><a id="createRoom" href="#">Create New Room</a></caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="roomsBody">
    <?php foreach ($rooms as $room): ?>
        <tr<?php echo Text::alternate('', ' class="alt"'); ?>>
            <td class="roomId"><?php echo sprintf("%04d", $room->id) ?></td>
            <td class="roomName"><?php echo htmlentities($room->name); ?></td>
            <td><a href="#" id="editRoom<?php echo $room->id; ?>" class='editRoomLink'>(edit)</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>		

<div id="createRoomDialog" title="Create New Room">
    <div>Room Name: <input type="text" name="roomName" /></div>
</div>

<div id="editRoomDialog" title="Edit Room">
    <div>Room Name: <input type="text" name="roomName" /></div>
</div>

<script type="text/javascript">
<!--
function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}

var editRoomClick = function() {
    var obj = jQuery(this);
    var roomId = obj.attr('id').substr(8);
    var roomNameTD = obj.parents('tr:eq(0)').find('.roomName');
    var oldRoomName = roomNameTD.text();

    jQuery.fn.bar.removebar()
        var dialog = jQuery("#editRoomDialog").dialog('open');

    var roomNameInput = dialog.find('input:eq(0)');
    roomNameInput.val(oldRoomName);

    dialog.dialog('option', 'buttons', {
            "Save" : function () {
            var roomName = roomNameInput.val();
            jQuery.post('<?php echo url::site('admin/roomUpdate') ?>', {id: roomId, name:roomName}, function(data) {
                if (data.success)
                {
                    jQuery.fn.bar({ message: "Room name updated from '" + oldRoomName + "' to '" + data.name + "'" });
                    roomNameTD.text(data.name);
                    dialog.dialog("close");
                }
                else
                {
                    jQuery.fn.bar({ message: "Error: " + data.message, background_color: '#F00' });
                }

            }, "json");
        },
    });

    return false;
};


jQuery(document).ready(function() {
        jQuery("#editRoomDialog,#createRoomDialog").dialog({
            autoOpen: false,
            closeOnEscape: true,
            modal: true, 
            draggable: true,
            minWidth: 400,
            width: 400,
            buttons: {
                "Save" : function () {
                    jQuery(this).dialog("close");
                },
            }
        });
        jQuery('#createRoom').bind('click', function() {
            jQuery.fn.bar.removebar()
            var dialog = jQuery("#createRoomDialog").dialog('open');
            var roomNameInput = dialog.find('input:eq(0)');


            dialog.dialog('option', 'buttons', {
                "Save" : function () {
                    var roomName = roomNameInput.val();
                    jQuery.post('<?php echo url::site('admin/roomCreate') ?>', {name:roomName}, function(data) {
                        if (data.success)
                        {
                            var table = jQuery('#roomsBody');
                            var lastRow = table.children('tr:last');
                            var newRow = lastRow.clone();
                            newRow.toggleClass('alt');
                            newRow.children('td:eq(0)').text(pad(data.id,4));
                            newRow.children('td:eq(1)').text(data.name);
                            newRow.children('td:eq(2)').children('a').attr('id', 'editRoom'+data.id);

                            jQuery('.editRoomLink', newRow).bind('click', editRoomClick);
                            table.append(newRow);

                            jQuery.fn.bar({ message: "New Room ("+data.name+") has been created" });
                            roomNameInput.val('');
                            dialog.dialog("close");
                        }
                        else
                        {
                            jQuery.fn.bar({ message: "Error: " + data.message, background_color: '#F00' });
                        }

                    }, "json");
                },
            });

            return false;
        });
        jQuery('.editRoomLink').bind('click', editRoomClick);
});
-->
</script>
