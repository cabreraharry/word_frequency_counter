<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Word Frequency Counter</h1>

    <form action="process.php" method="post">
        <label for="text">Paste your text here:</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required style="margin: 0 auto;"></textarea><br><br>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select><br><br>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" value="10" min="1"><br><br>
        
        <input type="submit" value="Calculate Word Frequency">
    </form>
</body>
</html>

<?php
// This will check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $inputText = $_POST["text"];

    // This will convert all user inputted words to lowercase
    $inputText = strtolower($inputText);


    $stopWords = array("the", "and", "in"); 

    // this code tokenize the input text into words
    $words = str_word_count($inputText, 1);


    $filteredWords = array_diff($words, $stopWords);

    // Here is where it calculate word frequency
    $wordCounts = array_count_values($filteredWords);

    // sorting
    $sortOrder = $_POST["sort"];
    if ($sortOrder == "asc") {
        asort($wordCounts);
    } else {
        arsort($wordCounts);
    }

    // limiter
    $limit = $_POST["limit"];


    echo "<h2>Word Frequencies:</h2>";
    echo "<ul>";
    $counter = 0;
    foreach ($wordCounts as $word => $count) {
        if ($counter >= $limit) {
            break;
        }
        echo "<li>$word: $count</li>";
        $counter++;
    }
    echo "</ul>";
}
?>
