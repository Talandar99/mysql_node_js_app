<?php
//CSS
echo "<head><style>
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
</style></head>";


$host = '127.0.0.1';
$user = 'root';
$password = 'password';
$database = 'database_name';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//czyszczenie bazy danych
$sql = "DROP TABLE IF EXISTS single_table";

if (mysqli_query($conn, $sql)) {
} else {
    echo "Error deleting table: " . mysqli_error($conn);
}

// sprawdzenie czy tabela już istnieje
$check_table = mysqli_query($conn, "SHOW TABLES LIKE 'single_table'");

if(mysqli_num_rows($check_table) == 0) {
    // Tworzenie tabeli
	$sql = "CREATE TABLE single_table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        word VARCHAR(255) NOT NULL,
        definition VARCHAR(1024) NOT NULL,
        category VARCHAR(255) NOT NULL
    	)";

    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}

// Wstawienie przykładowych danych
$single_tables = array(
	array('Example1', 'Example2', 'Example3'),
	array('TURING MACHINE', 'a hypothetical device that manipulates symbols on a strip of tape according to a table of rules. Despite its simplicity, a Turing machine can be adapted to simulate the logic of any computer algorithm, and is particularly useful in explaining the functions of a CPU inside a computer', 'artificial intelligence'),
	array('BEHAVIORISM', 'study of the effects of mental processes. All behavior can be explained by stimuli evoking responses', 'cognitive psychology'),
	array('REPRESENTATION', 'mental object, which replace a real one in our mind', 'cognitive psychology'),
    	array('COMPUTER TOMOGRAPHY', 'an advanced version of the conventional x-ray study (rotation, 3d pictures)', 'methodology'),
    	array('ASTROCYTES', 'large cells that surround neurons and come in close contact with vasculature, create BBB [brain-blood barrier]', 'neuroscience')
);

echo '<form action="" method="post">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search_word">
        <input type="submit" value="Search">
    </form>';

foreach ($single_tables as $food) {
    $sql = "INSERT INTO single_table (word, definition, category) VALUES ('" . $food[0] . "', '" . $food[1] . "', '" . $food[2] . "')";
    mysqli_query($conn, $sql);
}
if (isset($_POST['search_word'])) {
    	$search_word = mysqli_real_escape_string($conn, $_POST['search_word']);
	$sql = "SELECT * FROM single_table WHERE word = '$search_word'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<table>
                <tr>
                    <th>Word</th>
                    <th>Definition</th>
                    <th>Category</th>
                </tr>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>'.$row["word"].'</td>
                    <td>'.$row["definition"].'</td>
                    <td>'.$row["category"].'</td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo "No results found for '$search_word' in word";
    }
	echo "</br>";

    	$search_word = mysqli_real_escape_string($conn, $_POST['search_word']);
	$sql = "SELECT * FROM single_table WHERE category = '$search_word'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<table>
                <tr>
                    <th>Word</th>
                    <th>Definition</th>
                    <th>Category</th>
                </tr>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>'.$row["word"].'</td>
                    <td>'.$row["definition"].'</td>
                    <td>'.$row["category"].'</td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo "No results found for '$search_word' in category ";
    }
	echo "</br>";
}

echo "</br>";

$sql = "SELECT * FROM single_table";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	//<th>ID</th>
    echo '<table>
            <tr>
                	<th>Word</th>
                	<th>Definition</th>
			<th>Category</th>
            </tr>';
    while($row = mysqli_fetch_assoc($result)) {
	//	<td>'.$row["id"].'</td>
        echo '<tr>
                <td>'.$row["word"].'</td>
                <td>'.$row["definition"].'</td>
                <td>'.$row["category"].'</td>
              </tr>';
    }
    echo '</table>';
} else {
    echo "0 results";
}
?>
