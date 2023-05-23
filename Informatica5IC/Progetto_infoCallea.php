<?php
$searchQuery = isset($_GET['search']) ? $_GET['search'] : "";

if (!empty($searchQuery)) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://myanimelist.p.rapidapi.com/manga/search/" . urlencode($searchQuery) . "/10",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: myanimelist.p.rapidapi.com",
            "X-RapidAPI-Key: 4dcd71bc26msh1dacb8a17155ad0p1b28c0jsne7da5eee2bc2"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }

    $manga = json_decode($response, true);
} else {
    $manga = [];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Anime Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        nav {
                background-color: #f5f5f5;
                padding: 10px;
            }

            nav ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                text-align: right;
            }

            nav li {
                display: inline-block;
                margin-right: 10px;
            }

            nav a {
                text-decoration: none;
                color: #333;
                padding: 5px 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            nav a:hover {
                background-color: #333;
                color: #fff;
            }
    </style>
</head>
<body>
<nav>
            <div class="container">
                <ul>
                    <li>
                        <a href="./logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

    <div class="container">
      
        <h1>Anime Search</h1>
      



        <form method="GET" action="">
            <div class="form-group">
                <label for="search">Search:</label>
                <input type="text" name="search" class="form-control" id="search" value="<?php echo $searchQuery; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <br>
        <?php if (!empty($manga)): ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Titolo</th>
                    <th>immagine</th>
                    <th>Descrizione</th>
                    <th>Azione</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($manga as $item): ?>
                    <tr>
                        <td><?php echo $item['title']; ?></td>
                        <td><img src="<?php echo $item['picture_url']; ?>"
                                 alt="<?php echo $item['title']; ?>" style="max-height: 100px;"></td>
                        <td><?php echo $item['description']; ?></td>
                        <td><a href="<?php echo $item['myanimelist_url']; ?>"
                               class="btn btn-primary">View on MyAnimeList</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>