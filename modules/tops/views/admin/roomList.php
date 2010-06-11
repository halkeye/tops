<script>
<!--
var roomData = <?php $jsonRooms = array();
foreach ($rooms as $room) 
    $jsonRooms[] = $room->as_array();

echo json_encode($jsonRooms); ?>;
-->
</script>
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
<pre>
</pre>

<div id="createRoomDialog" title="Create New Room">
    <form>
        <div>Room Name: <input type="text" name="roomName" /></div>
    </form>
</div>

<div id="editRoomDialog" title="Create New Room">
    <form>
        <div>Room Name: <input type="text" name="roomName" /></div>
    </form>
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
            jQuery("#createRoomDialog").dialog('open');
            return false;
        });
        jQuery('.editRoomLink').bind('click', function() {
            var obj = jQuery(this);
            var roomId = obj.attr('id').substr(8);
            var roomNameTD = obj.parents('tr:eq(0)').find('.roomName');
            var roomName = roomNameTD.text();

            var dialog = jQuery("#editRoomDialog").dialog('open');

            var roomNameInput = dialog.find('form').find('input:eq(0)');
            roomNameInput.val(roomName);

            dialog.dialog('option', 'buttons', {
                "Save" : function () {
                    var roomName = roomNameInput.val();
                    roomNameTD.text(roomName);
                    jQuery(this).dialog("close");
                },
            });

            return false;
        });
});
-->
</script>
