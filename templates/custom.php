<?php $results = $wpPluginInpsyde->consume_api(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test Plugin for Inpsyde</title>

        <style>
            .table-div {overflow-x: auto;}

            table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                border: 1px solid #ddd;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {background-color: #f2f2f2}
        </style>
    </head>
    <body>
        <div class="table-div">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email Address</th>
                </tr>
                <?php foreach($results as $result): ?>
                <tr>
                    <td><a href="#" data-id="<?php echo $result['id']; ?>"><?php echo $result['id']; ?></a></td>
                    <td><a href="#" data-id="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></td>
                    <td><a href="#" data-id="<?php echo $result['id']; ?>"><?php echo $result['username']; ?></a></td>
                    <td><?php echo $result['email']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="user-info-div"></div>
    </body>
</html>