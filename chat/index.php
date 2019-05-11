<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

?>
<?php include_once("main-menu.html"); ?>

</header>
<!DOCTYPE html>
<head>

    <title>Chat Room</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css" media="screen"
    />

    <style>
        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .userSettings {
            margin-bottom: 20px;
            margin-left: 450px;
        }

        .chat {
            max-width: 700px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .chat #chatOutput {
            overflow-y: scroll;
            height: 350px;
            width: 790px;
            border: 0px solid #777;


        }

        .chat #chatOutput p {
            margin: 0;
            padding: 5px;
            border-bottom: 1px solid #fffbff;
            word-break: break-all;
        }

        .chat #chatInput {
            width: 75%;
        }

        .chat #chatSend {
            width: 25%;
            height: 40px;
        }
        </style>


</head>
<body>
<div class="container" align="center">

        <h1>Chat room</h1>

    <main >
        <div class="userSettings" align="right?100px">
            <label for="userName"> <strong> Logged in as: </strong> </label>
            <a style="color: #002ba1"> <?php echo htmlspecialchars($_SESSION["username"]); ?> </a>
        </div>
        <div class="chat" align="left">
            <div id="chatOutput"></div>
            <input id="chatInput" type="text"  placeholder=" Message" maxlength="400" onfocus="this.value=''" >
            <button type="button" class="btn btn-primary" id="chatSend"> Send </button>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        var chatInterval = 250; //refresh interval in ms
        var $chatOutput = $("#chatOutput");
        var $chatInput = $("#chatInput");
        var $chatSend = $("#chatSend");

        function sendMessage() {
            var chatInputString = $chatInput.val();

            $.get("./write.php", {

                text: chatInputString
            });

            retrieveMessages();
        }

        function retrieveMessages() {
            $.get("./read.php", function(data) {
                $chatOutput.html(data); //Paste content into chat output
            });
        }

        $chatSend.click(function() {
            sendMessage();
        });

        setInterval(function() {
            retrieveMessages();
        }, chatInterval);
    });
    </script>

</body>

<footer>
    <?php include_once("../main-footer.html"); ?>

</footer>
</html>