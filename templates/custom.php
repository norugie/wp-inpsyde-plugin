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

            .user-info-div {
                width: 600px;
                margin: 20px auto;
                padding: 5px;
                border: 1px solid #ddd;
                overflow-x: auto;
            }

            .grid-container {
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 10px;
            }

            #user-address {
                grid-column:  1 / span 2;
            }
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
                    <td><a href="javascript: void(0)" data-id="<?php echo $result['id']; ?>" onclick="displayUserInfo(this)"><?php echo $result['id']; ?></a></td>
                    <td><a href="javascript: void(0)" data-id="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></td>
                    <td><a href="javascript: void(0)" data-id="<?php echo $result['id']; ?>"><?php echo $result['username']; ?></a></td>
                    <td><?php echo $result['email']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="user-info-div">
            <center><h3>User Information</h3></center>
            <div class="grid-container">
                <div id="user-name"></div>
                <div id="user-username"></div>
                <div id="user-email"></div>  
                <div id="user-address"></div>
                <div id="user-phone"></div>
                <div id="user-website"></div>
                <div id="user-company"></div>
                <div id="user-company-catchphrase"></div>
            </div>
        </div>

        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>

        <!-- Asynchronus call for user info -->
        <script>
            function displayUserInfo(e){
                const id = $(e).data("id");
                const apiURL = "https://jsonplaceholder.typicode.com/users/" + id;

                fetch(apiURL)
                .then(response => response.text())
                .then(contents => console.log(contents))
                .catch(() => console.log("Can’t access " + apiURL + " response. Blocked by browser?"))
            }
        </script>
    </body>
</html>