<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h3><?php echo htmlentities($pluralName) ?></h3>

<table>
    <caption><a id="create<?php echo htmlentities($singleName) ?>" href="#">Create New <?php echo htmlentities($singleName) ?></a></caption>
    <thead>
        <tr>
            <th>ID</th>
            <th><?php echo htmlentities($nameFieldLabel) ?></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="itemsBody">
    <?php foreach ($items as $item): ?>
        <tr<?php echo Text::alternate('', ' class="alt"'); ?>>
            <td class="itemId"><?php echo sprintf("%04d", $item->id) ?></td>
            <td class="itemName"><?php echo htmlentities($item); ?></td>
            <td><a href="#" id="edit<?php echo htmlentities($singleName) ?><?php echo $item->id; ?>" class='edit<?php echo htmlentities($singleName) ?>Link'>(edit)</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>        

<div id="create<?php echo htmlentities($singleName) ?>Dialog" title="Create New <?php echo htmlentities($singleName) ?>">
    <div><?php echo htmlentities($singleName) ?> <?php echo htmlentities($nameFieldLabel) ?>: <input type="text" name="itemName" class="nameEntry"/></div>
</div>

<div id="edit<?php echo htmlentities($singleName) ?>Dialog" title="Edit <?php echo htmlentities($singleName) ?>">
    <div><?php echo htmlentities($singleName) ?> <?php echo htmlentities($nameFieldLabel) ?>: <input type="text" name="itemName" class="nameEntry" /></div>
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

var edit<?php echo htmlentities($singleName) ?>Click = function() {
    var obj = jQuery(this);
    var itemId = obj.attr('id').substr(8);
    var itemNameTD = obj.parents('tr:eq(0)').find('.itemName');
    var old<?php echo htmlentities($singleName) ?>Name = itemNameTD.text();

    jQuery.fn.bar.removebar()
    var dialog = jQuery("#edit<?php echo htmlentities($singleName) ?>Dialog").dialog('open');

    var itemNameInput = dialog.find('input:eq(0)');
    itemNameInput.val(old<?php echo htmlentities($singleName) ?>Name);

    dialog.dialog('option', 'buttons', {
            'Save' : function () {
            var itemName = itemNameInput.val();
            jQuery.post('<?php echo url::site('admin/'.$modelName.'Update') ?>', {id: itemId, name:itemName}, function(data) {
                if (data.success)
                {
                    jQuery.fn.bar({ message: "<?php echo htmlentities($singleName) ?> name updated from '" + old<?php echo htmlentities($singleName) ?><?php echo htmlentities($nameFieldLabel) ?> + "' to '" + data.name + "'" });
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
        jQuery("#edit<?php echo htmlentities($singleName) ?>Dialog,#create<?php echo htmlentities($singleName) ?>Dialog").dialog({
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
        jQuery('#create<?php echo htmlentities($singleName) ?>').bind('click', function() {
            jQuery.fn.bar.removebar()
            var dialog = jQuery("#create<?php echo htmlentities($singleName) ?>Dialog").dialog('open');
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
                            newRow.children('td:eq(2)').children('a').attr('id', 'edit<?php echo htmlentities($singleName) ?>'+data.id);

                            jQuery('.edit<?php echo htmlentities($singleName) ?>Link', newRow).bind('click', edit<?php echo htmlentities($singleName) ?>Click);
                            table.append(newRow);

                            jQuery.fn.bar({ message: "New <?php echo htmlentities($singleName) ?> ("+data.name+") has been created" });
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
        jQuery('.edit<?php echo htmlentities($singleName) ?>Link').bind('click', edit<?php echo htmlentities($singleName) ?>Click);

        <?php if ($nameFieldType == 'date'): ?>
            jQuery(".nameEntry").datepicker({
                dateFormat: 'yy-mm-dd',
            });
        <?php endif ?>
});
-->
</script>
