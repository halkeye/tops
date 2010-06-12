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
    <tbody>
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
            jQuery("#createRoomDialog").dialog('open');
            return false;
        });
        jQuery('.editRoomLink').bind('click', function() {
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
                        jQuery.fn.bar({ message: "Room name updated from '" + oldRoomName + "' to '" + data.name + "'" });
                        roomNameTD.text(data.name);
                        dialog.dialog("close");
                    }, "json");
                },
            });

            return false;
        });
});
-->
</script>
