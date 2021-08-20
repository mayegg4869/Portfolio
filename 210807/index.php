<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
    </head>
    <body>
        <?php 
            for ($i = 5; $i < 101; $i++) {
                if($i%7===0 && $i%5===0){ //FizzBuzz
                    echo "FizzBuzz";
                } else if($i%7===0){ //Fizz
                    echo "Fizz";
                } else if($i%5===0){ //Buzz
                    echo "Buzz";
                } else {
                    echo "$i";
                }
                echo "<br>";
            }
        ?>
    </body>
</html>