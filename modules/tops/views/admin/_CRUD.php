<?php defined('SYSPATH') OR die('No direct access allowed.'); 
$jsonItems = array();
?>
<h3><?php echo htmlentities($pluralName) ?></h3>

<table>
    <caption><a id="createLink" href="#">Create New <?php echo htmlentities($singleName) ?></a></caption>
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

            <?php 
            foreach ($fields as $fieldKey => $fieldData)
            {
                $value = $item->$fieldKey;
                if ($fieldData['type'] == 'select')
                {
                    $value = @$fieldData['options'][$value];
                    if (!$value) $value = '[unknown]';
                }

                echo '<td>'.htmlentities($value).'</td>';
            } ?>

            <td><a href="#" id="edit<?php echo $item->pk(); ?>" class='editLink'>(edit)</a></td>
        </tr>
    <?php $jsonItems[$item->pk()] = $item->as_array(); endforeach ?>
    </tbody>
</table>        

<div id="editDialog" title="Edit <?php echo htmlentities($singleName) ?>">
    <form action="#" method="post">
    <table>
    <?php
        foreach ($fields as $fieldKey=>$fieldData)
        { 
            if($fieldData['type'] == 'hidden') continue;
            $attr = array('type'=>'text', 'id' => "edit$fieldKey");
            if($fieldData['type'] == 'color') $attr['class'] = "color {pickerPosition:'top'}";
            echo '<tr><td>';
            echo htmlentities($fieldData['name']) . ': ';
            echo '</td><td>';
            if ($fieldData['type'] == 'select')
            {
                echo Form::select("edit$fieldKey", $fieldData['options'], NULL, array('id' => "edit$fieldKey"));
            }
            else
                echo Form::input("edit$fieldKey", "", $attr);
            echo '</td></tr>';
        }
    ?>
    </table>
    </form>
</div>

<script type="text/javascript">
<!--
var itemsData = <?php echo json::encode($jsonItems); ?>;
var fieldOrder = <?php echo json::encode(array_keys($fields)); ?>;

function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}

var handleCRUDRow = function(row, data)
{
    var children = row.children('td');
    children.eq(0).text(pad(data.id,4));
    var value;
    for(var i = 0; i < fieldOrder.length; i++) 
    {
        value = data[fieldOrder[i]];
        if (data.hasOwnProperty(fieldOrder[i] + '.name'))
            value = data[fieldOrder[i] + '.name'];
        children.eq(i+1).text(value);
    }
    itemsData[data.id] = data;
}


var editClick = function() {
    var obj = jQuery(this);

    var itemId = obj.attr('id').substr(4);
    var itemData = itemsData[itemId];
    if (!itemData)
    {
        alert("cannot find data for " + itemId);
        return;
    }
    var dialog = jQuery("#editDialog");
    dialog.dialog('option', 'title', "Edit <?php echo htmlentities($singleName) ?>");
    dialog.dialog('option', 'buttons', { 'Save' : function () {
            jQuery.fn.bar.removebar()
            var dialogData = convertFormArrayToHash(dialog.find('form').serializeArray());
            dialogData['id'] = itemId;
            jQuery.post('<?php echo url::site('admin/'.$modelName.'Update') ?>', dialogData, function(data) {
                if (data.success)
                {
                    jQuery.fn.bar({ message: "<?php echo htmlentities($singleName) ?> updated successfully" });
                    var row = obj.parents('tr');
                    handleCRUDRow(row, data);

                    dialog.dialog("close");
                }
                else
                {
                    jQuery.fn.bar({ message: "Error: " + data.message, background_color: '#F00' });
                }

            }, "json");
        },
    });
    dialog.dialog('open');
    for(var i = 0; i < fieldOrder.length; i++) 
    {
        jQuery('#edit'+fieldOrder[i])
            .val(itemData[fieldOrder[i]])
            .focus()
            .blur();
    }

    return false;
};

function convertFormArrayToHash(data)
{
    var paramObj = {};
    $.each(data, function(_, kv) {
            /* Get rid of edit prefix */
            paramObj[kv.name.substr(4)] = kv.value;
    });
    return paramObj;
}


jQuery(document).ready(function() {
        jQuery("#editDialog").dialog({
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
        jQuery('#createLink').bind('click', function() {
            var dialog = jQuery("#editDialog");
            dialog.dialog('option', 'title', "Create New <?php echo htmlentities($singleName) ?>");
            var itemNameInput = dialog.find('input:eq(0)');

            dialog.dialog('option', 'buttons', {
                "Save" : function () {
                    jQuery.fn.bar.removebar()
                    var dialogData = convertFormArrayToHash(dialog.find('form').serializeArray());
                    jQuery.post('<?php echo url::site('admin/'.$modelName.'Create') ?>', dialogData, function(data) {
                        if (data.success)
                        {
                            var table = jQuery('#itemsBody');
                            var lastRow = table.children('tr:last');
                            var newRow = lastRow.clone();
                            newRow.toggleClass('alt');
                            handleCRUDRow(newRow, data);

                            newRow.children('td:last').children('a').attr('id', 'edit'+data.id);

                            jQuery('.editLink', newRow).bind('click', editClick);
                            table.append(newRow);

                            jQuery.fn.bar({ message: "New <?php echo htmlentities($singleName) ?> ("+data.asString+") has been created" });
                            dialog.dialog("close");
                        }
                        else
                        {
                            jQuery.fn.bar({ message: "Error: " + data.message, background_color: '#F00' });
                        }

                    }, "json");
                },
            });
            dialog.dialog('open');
            for(var i = 0; i < fieldOrder.length; i++) 
            {
                jQuery('#edit'+fieldOrder[i]).val('').css('background-color', '').css('color', '');
            }

            return false;
        });
        jQuery('.editLink').bind('click', editClick);

        <?php 
            foreach ($fields as $fieldKey=>$fieldData)
            {
                if ($fieldData['type'] == 'date')
                    echo "jQuery('#edit$fieldKey').datepicker({dateFormat: 'yy-mm-dd',});\n";
                else if ($fieldData['type'] == 'color')
                {
                    Assets::addJS('jscolor.js', 100);
                    ?>
                        jscolor.dir = '<?php echo url::site('static/img/jscolor_'); ?>';
                    <?php
                }
            }
        ?>
});
-->
</script>
