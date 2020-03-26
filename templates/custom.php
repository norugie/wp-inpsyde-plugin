<?php $results = $wpPluginInpsyde->consumeApi(); ?>

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
                width: 50%;
                margin: 20px auto;
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
                padding: 10px;
                border: 1px solid #ddd;
                display: none;
            }

            .grid-container {
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 10px;
            }

            #data-indicator, #user-address {
                grid-column:  1 / span 2;
            }

            #data-indicator {
                text-align: center;
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
                <?php if (empty($results) && !isset($results)) { ?>
                    <tr>
                        <td colspan="4"><center>There are no users found for this list.</center></td>
                    </tr>
                <?php } else {
                    foreach ($results as $result) : ?>
                        <tr>
                            <td><a href="javascript: void(0)" data-id="<?php echo $result['id']; ?>" onclick="displayUserInfo(this)"><?php echo $result['id']; ?></a></td>
                            <td><a href="javascript: void(0)" data-id="<?php echo $result['id']; ?>" onclick="displayUserInfo(this)"><?php echo $result['name']; ?></a></td>
                            <td><a href="javascript: void(0)" data-id="<?php echo $result['id']; ?>" onclick="displayUserInfo(this)"><?php echo $result['username']; ?></a></td>
                            <td><?php echo $result['email']; ?></td>
                        </tr>
                    <?php endforeach;
                } ?>
            </table>
        </div>
        <div class="user-info-div">
            <center><h3>User Information</h3></center>
            <div class="grid-container">
                <div id="data-indicator"></div>
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
            function displayUserInfo(e)
            {
                // show user information div
                if($(".user-info-div").css("display") == "none")
                    $(".user-info-div").css("display", "block");

                // clear div fields per new onclick
                $("#data-indicator").empty();
                $("#user-name").empty();
                $("#user-username").empty();
                $("#user-email").empty();
                $("#user-address").empty();
                $("#user-phone").empty();
                $("#user-company").empty();
                $("#user-company-catchphrase").empty();

                const id = $(e).data("id"); // user id
                const apiURL = "https://jsonplaceholder.typicode.com/users/" + id; // api link to user info

                // fetch user info
                fetch(apiURL)
                .then(response => response.json())
                .then($("#data-indicator").append("Fetching user data. Please wait. . ."))
                .then(function(response){
                    $("#data-indicator").empty(); // empty data-indicator
                    $("#data-indicator").append("Data has been fetched successfully!"); // append success message

                    // append user data
                    $("#user-name").append("<b>Name: </b>" + response["name"]);
                    $("#user-username").append("<b>Username: </b>" + response["username"]);
                    $("#user-email").append("<b>Email Address: </b>" + response["email"]);
                    $("#user-address").append("<b>Address: </b>" + response["address"]["suite"] + ", " + response["address"]["street"] + ", " + response["address"]["city"] + " " + response["address"]["zipcode"]);
                    $("#user-phone").append("<b>Phone Number: </b>" + response["phone"]);
                    $("#user-company").append("<b>Company: </b>" + response["company"]["name"]);
                    $("#user-company-catchphrase").append("<b>Company Catchphrase: </b>" + response["company"]["catchPhrase"]);
                })
                .catch(() => $("#data-indicator").replaceWith("<div id='data-indicator'>Can’t access " + apiURL + " response.</div>")); // replace data-indicator of with failure message on catch 
            }
        </script>
    </body>
</html>
