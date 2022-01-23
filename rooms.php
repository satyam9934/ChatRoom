<?php

//get parameter
$roomname = $_GET['roomname'];


//databasee connection
include 'db_connect.php';

//Excute sql to check wheather room exists

$sql = "SELECT  * From `rooms` WHERE  roomname ='$roomname'";
$result = Mysqli_query($conn, $sql);
if ($result){
    //check if room is exist 
    if (mysqli_num_rows($result) == 0){
        $message = "This is room does not exist. Try creating a new one";
            echo '<script type="text/javascript">';
        echo ' alert("'.$message.'");';  //not showing an alert box.
        echo 'window.location="http://localhost/ChatRoom";';
        echo '</script>';

    }
}
else{
    echo "Error".mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/product.css" rel="stylesheet">
    <style>
    body {
        margin: 0 auto;
        max-width: 800px;
        padding: 0 20px;
    }

    .container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .container::after {
        content: "";
        clear: both;
        display: table;
    }

    .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .container img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }

    .anyclass {
        height: 350px;
        overflow-y: scroll;
    }
    </style>

</head>

<body>
    <nav class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="#" aria-label="Product">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img"
                viewBox="0 0 24 24">
                <title></title>
                <circle cx="12" cy="12" r="10" />
                <path
                    d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94" />
            </svg>
        </a>
        <a class="py-2 d-none d-md-inline-block" href="#">Tour</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Product</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Features</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Enterprise</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Support</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Pricing</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Cart</a>
    </nav>

    <h2>Chat Messages - <?php echo $roomname; ?></h2>



    <div class="container">
        <div class="anyclass">
            
        </div>
    </div>

    <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Message">
    <button type="button" class="btn btn-secondary m-2" name="submitmsg" id="submitmsg"> Send</button>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script type="text/javascript">
    //check for new messages every one second
    setInterval(runfunction, 1000);

    function runfunction() {
        $.post("htcont.php", {
                room: '<?php echo $roomname ?>'
            },
            function(data, status) {
                document.getElementsByClassName('anyclass')[0].innerHTML = data;
            }

        )
    }

    // Using Enter key to the the submit
    var input = document.getElementById("usermsg");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("submitmsg").click();

        }
    });

    //if user submit the form

    $("#submitmsg").click(function() {
        var clientsmg = $("#usermsg").val();
        $.post("postmsg.php", {
                text: clientsmg,
                room: '<?php echo $roomname; ?>',
                ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>'
            },
            function(data, status) {
                document.getElementsByClassName('anyclass')[0].innerHTML = data;
            });
        $("#usermsg").val("");
        return false;
    });
    </script>
</body>

</html>