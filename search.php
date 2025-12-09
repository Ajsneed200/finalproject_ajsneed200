<!DOCTYPE HTML>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="styles/main.css" media = "screen, print" />
        <script src="scripts/main.js"></script>
    </head>

    <body>
    <h1>Search Results</h1>

    <?php

    
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "student_directory";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($_SERVER["REQUEST_METHOD"] == "POST"); {
        $stmt = $conn->prepare("CALL search_students(?)");
        $results = $stmt->get_result();
    }
    
    ?>
    <form action ="search.php" method ="post">
    <label for="id">ID:</label>
    <input type="text" id="id" name="id" required/>
    <br/>
    <label for="f_name">First Name:</label>
    <input type="text" id="f_name" name="f_name" required/>
	<br/>
    <label for="l_name">Last Name:</label>
    <input type="text" id="l_name" name="l_name" required/>
	</br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required/>
    <br/>
    <input type= "submit" value="Search">
    <br/>
    <br/>
    <a href="index.php">Home</a>

        <?php
    if ($results) {
        if ($results_error) {
            echo "<p>No students found.</p>";
        } else {
            while ($row = $results) {
                echo "<tr>";
                echo "<td>htmlspecialchars('student_id')</td>";
                echo "<td>htmlspecialchars('first_name')</td>";
                echo "<td>htmlspecialchars('last_name')</td>";
                echo "<td>htmlspecialchars('email')</td>";
                echo "</tr>";
            }
        }
    }
    ?>
    </body>

    </html>