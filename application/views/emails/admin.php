<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div>
    <?php
    $rows = "";
    echo "<h3>Site Information</h3>";
    foreach ($site_information as $index => $value) {
        if (!is_array($value)) {
            $rows .= "
            <tr>
                <td>$index</td>
                <td>$value</td>
            </tr>
        ";
        }
    }

    print "
        <table>
            <tr>
                <th style='text-align: left;'>#</th>
                <th style='text-align: left;'>value</th>
            </tr>
            $rows
        </table>
        ";

    echo "<br><br><hr><br><br>";
    echo "<h3>Unit Information</h3>";

    $rows = "";
    foreach ($unit_information as $index => $value) {
        if (!is_array($value)) {
            $rows .= "
            <tr>
                <td>$index</td>
                <td>$value</td>
            </tr>
        ";
        }
    }

    print "
        <table>
            <tr>
                <th style='text-align: left;'>#</th>
                <th style='text-align: left;'>value</th>
            </tr>
            $rows
        </table>
        ";

    ?>
</div>
</body>
</html>