<html>
    <head>
<style> 
div.main {
  width:110%;
  overflow:auto;
}
div.main div {
  width:33%;  
  float:left;
}
</style>
    </head>
    <body>
        
    <div class="main">
        <div>
            <p style="font-size: 2.5vw;">you should pay to +77780452342:</p>
        </div>
        <div>
             <p id="result" style="font-size: 2.5vw; text-align:right; color: purple;">0</p>
        </div>
        <div>
            <p style="font-size: 2.5vw;">KZT</p>
        </div>
    </div>
    
    <form>
    Try to guess the cost of our competition:
    <input type="text" id="gunum" /><br>
    <input type="button" onClick="checkGuess()" value="Check Guess"><br>
</form>

<script>
    function binarySearch(guess) {
        const writtenCosts = [1000, 1500, 1600, 1800, 2000];
        let low = 0;
        let high = writtenCosts.length - 1;

        while (low <= high) {
            let mid = Math.floor((low + high) / 2);

            if (writtenCosts[mid] === guess) {
                return true; // Guess found
            } else if (writtenCosts[mid] < guess) {
                low = mid + 1;
            } else {
                high = mid - 1;
            }
        }

        return false; // Guess not found
    }

    function checkGuess() {
        const guess = parseInt(document.getElementById('gunum').value);
        const result = binarySearch(guess);

        if (result) {
            alert("Congratulations! Your guess is correct.");
        } else {
            alert("Sorry, your guess is incorrect. Try again!");
        }
    }
</script>
    
    <form>
        <script>
            function linearSearch(array, target):
    for each element in array:
        if element equals target:
            return true
    return false
    
        </script>
    </form>
    <form>
    how many participants in your team?
    <input type="text" id="partnum" /><br>
    <input type="button" onClick="thecashBy()" value="count"><br>
    <script>
    function thecashBy()
    {
        num1 = document.getElementById('partnum').value;
        document.getElementById('result').innerHTML = num1 * 1600;
    }
    </script>
    </form>
    
<form>
    <input type="radio" id="kaspi" name="card" value="KASPI">
    <label for="kaspi">kaspi</label><br>
    <input type="radio" id="paypal" name="card" value="PAYPAL">
    <label for="paypal">paypal</label><br>
    <button type="button" onclick="myFunction()">pay</button>
</form>

<script>
function myFunction() {
    const kaspi = document.getElementById('kaspi');
    const paypal = document.getElementById('paypal');

    if (kaspi.checked || paypal.checked) {
        alert("Thank you for paying!! Now you should write some data about yourself.");
        window.location.href = "hackreg.php";  // Redirect to hackreg.php
    } else {
        alert("You need to press one of these radio buttons.");
    }
}
</script>
    </body>
</html>