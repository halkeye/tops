<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h3><?php echo htmlentities($pluralName) ?></h3>

<table>
    <caption><a id="create<?php echo htmlentities($modelName) ?>" href="#">Create New <?php echo htmlentities($singleName) ?></a></caption>
    <thead>
        <tr>
            <th>ID</th>
            <?php foreach (array_values($fields) as $fieldData): ?>
            <th><?php echo htmlentities($fieldData['name']) ?></th>
            <?php endforeach ?>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="itemsBody">
    <?php foreach ($items as $item): ?>
        <tr<?php echo Text::alternate('', ' class="alt"'); ?>>
            <td class="itemId"><?php echo sprintf("%04d", $item->id) ?></td>

            <?php foreach (array_keys($fields) as $fieldKey): ?>
            <td><?php echo htmlentities($item->$fieldKey) ?></td>
            <?php endforeach ?>

            <td><a href="#" id="edit<?php echo htmlentities($modelName) ?><?php echo $item->id; ?>" class='edit<?php echo htmlentities($modelName) ?>Link'>(edit)</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>        

<div id="edit<?php echo htmlentities($modelName) ?>Dialog" title="Edit <?php echo htmlentities($singleName) ?>">
    <table>
    <?php foreach ($fields as $fieldKey=>$fieldData): ?>
    <tr><td>
        <?php echo htmlentities($fieldData['name']) ?>: 
    </td><td>
        <?php echo Form::input("edit$fieldKey", "", array('type'=>'text', 'id' => "edit$fieldKey")) ?>
    </td></tr>
    <?php endforeach ?>
    </table>
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

var edit<?php echo htmlentities($modelName) ?>Click = function() {
    var obj = jQuery(this);
    var itemId = obj.attr('id').substr(8);
    var itemNameTD = obj.parents('tr:eq(0)').find('.itemName');
    var old<?php echo htmlentities($modelName) ?>Name = itemNameTD.text();

    jQuery.fn.bar.removebar()
    var dialog = jQuery("#edit<?php echo htmlentities($modelName) ?>Dialog").dialog('open');
    dialog.dialog('option', 'title', "Edit <?php echo htmlentities($singleName) ?>");

    var itemNameInput = dialog.find('input:eq(0)');
    itemNameInput.val(old<?php echo htmlentities($modelName) ?>Name);

    dialog.dialog('option', 'buttons', {
            'Save' : function () {
            var itemName = itemNameInput.val();
            jQuery.post('<?php echo url::site('admin/'.$modelName.'Update') ?>', {id: itemId, name:itemName}, function(data) {
                if (data.success)
                {
                    jQuery.fn.bar({ message: "<?php echo htmlentities($modelName) ?> updated successfully" });
                    itemNameTD.text(data.name);
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
        jQuery("#edit<?php echo htmlentities($modelName) ?>Dialog").dialog({
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
        jQuery('#create<?php echo htmlentities($modelName) ?>').bind('click', function() {
            jQuery.fn.bar.removebar()
            var dialog = jQuery("#edit<?php echo htmlentities($modelName) ?>Dialog").dialog('open');
            dialog.dialog('option', 'title', "Create New <?php echo htmlentities($singleName) ?>");
            var itemNameInput = dialog.find('input:eq(0)');


            dialog.dialog('option', 'buttons', {
                "Save" : function () {
                    var itemName = itemNameInput.val();
                    jQuery.post('<?php echo url::site('admin/'.$modelName.'Create') ?>', {name:itemName}, function(data) {
                        if (data.success)
                        {
                            var table = jQuery('#itemsBody');
                            var lastRow = table.children('tr:last');
                            var newRow = lastRow.clone();
                            newRow.toggleClass('alt');
                            newRow.children('td:eq(0)').text(pad(data.id,4));
                            newRow.children('td:eq(1)').text(data.name);
                            newRow.children('td:eq(2)').children('a').attr('id', 'edit<?php echo htmlentities($modelName) ?>'+data.id);

                            jQuery('.edit<?php echo htmlentities($modelName) ?>Link', newRow).bind('click', edit<?php echo htmlentities($modelName) ?>Click);
                            table.append(newRow);

                            jQuery.fn.bar({ message: "New <?php echo htmlentities($modelName) ?> ("+data.name+") has been created" });
                            itemNameInput.val('');
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
        jQuery('.edit<?php echo htmlentities($modelName) ?>Link').bind('click', edit<?php echo htmlentities($modelName) ?>Click);

        <?php 
            foreach ($fields as $fieldKey=>$fieldData)
            {
                if ($fieldData['type'] == 'date')
                    echo "jQuery('#edit$fieldKey').datepicker({dateFormat: 'yy-mm-dd',});\n";
            }
        ?>
});
-->
</script>
