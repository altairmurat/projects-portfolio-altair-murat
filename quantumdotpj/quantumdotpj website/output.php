<html>
<head>
    <h1>Registered people</h1>
</head>
<body>
    <p>Be quick, the number of seats that left: </p>
    <h2>Check if there is anyone who has the same Name as you:</h2>
    <input type="text" id="telegram" value="@"/> <br>
    <input type="button" onClick="search()" value="count"> <br>
    <label id="result"></label> <br>
    <script>
        function search() {
            const telegram = document.getElementById('telegram').value;
            if (telegram.trim() === '') {
                document.getElementById('result').innerHTML = "Please enter a telegram nickname";
                return;
            }
            fetch('participantnames.php?Telegram=' + encodeURIComponent(telegram))
                .then(response => response.text())
                .then(data => {
                    document.getElementById('result').innerHTML = data;
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    </script>
    
    <div class="main">
        <div>
            <label>if there is not any existing names</label>
        </div>
        <div>
            <a href="purchase.php">then clcik this link to register to our hackathon</a>
        </div>
    </div>
<?php
    $servername='localhost';
    $username='c778043d_ict2';
    $password='Hello123';
    $dbname = "c778043d_ict2";
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die('Could not Connect MySql Server:' .mysql_error());
    }

    $sql = "SELECT Name FROM hr";
    $result = mysqli_query($conn, $sql);

    $names = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $names[] = $row["Name"];
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
?>

<div id="names">
    <?php
        foreach ($names as $name) {
            echo "Name: " . $name . "<br>";
        }
    ?>
</div>

<button onclick="bubbleSort()">Sort Names</button>

<script>
    function bubbleSort() {
        var names = <?php echo json_encode($names); ?>;
        var len = names.length;
        for (var i = 0; i < len-1; i++) {
            for (var j = 0; j < len-i-1; j++) {
                if (names[j] > names[j+1]) {
                    var temp = names[j];
                    names[j] = names[j+1];
                    names[j+1] = temp;
                }
            }
        }
        var output = "";
        for (var i = 0; i < len; i++) {
            output += "Name: " + names[i] + "<br>";
        }
        document.getElementById("names").innerHTML = output;
    }
</script>

</body>
</html>