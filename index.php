<?php
require 'db.php';
$stmt = $pdo->query("SELECT * FROM ads ORDER BY created_at DESC LIMIT 20");
$ads = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickSell Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .header {
            background-color: #002f34;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        .nav-links {
            display: flex;
            gap: 15px;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .nav-links a:hover {
            background-color: rgba(255,255,255,0.2);
        }
        .search-container {
            display: flex;
            margin: 20px 0;
        }
        .search-container input {
            flex-grow: 1;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #002f34;
            border-right: none;
            border-radius: 4px 0 0 4px;
        }
        .search-container button {
            padding: 10px 20px;
            background-color: #002f34;
            color: white;
            border: 2px solid #002f34;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-container button:hover {
            background-color: #00464e;
        }
        .ads-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .ad-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        .ad-card:hover {
            transform: scale(1.03);
        }
        .ad-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .ad-content {
            padding: 15px;
        }
        .ad-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #002f34;
        }
        .ad-price {
            font-weight: bold;
            color: #002f34;
            margin-bottom: 10px;
        }
        .ad-details-link {
            display: block;
            text-align: center;
            background-color: #002f34;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 0 0 8px 8px;
            transition: background-color 0.3s;
        }
        .ad-details-link:hover {
            background-color: #00464e;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container header-content">
            <a href="index.php" class="logo">QuickSell</a>
            <div class="nav-links">
                <a href="login.php">Login</a>
                <a href="signup.php">Sign Up</a>
                <a href="post-ad.php">Post Ad</a>
            </div>
        </div>
    </div>

    <div class="container">
        <form method="GET" action="search.php" class="search-container">
            <input type="text" name="query" placeholder="Search ads...">
            <button type="submit">Search</button>
        </form>

        <div class="ads-grid">
            <?php foreach ($ads as $ad): ?>
                <div class="ad-card">
                    <img src="<?= htmlspecialchars($ad['image_url']) ?>" alt="Ad Image" class="ad-image">
                    <div class="ad-content">
                        <h3 class="ad-title"><?= htmlspecialchars($ad['title']) ?></h3>
                        <p class="ad-price">₹ <?= htmlspecialchars(number_format($ad['price'], 0)) ?></p>
                    </div>
                    <a href="ad.php?id=<?= $ad['id'] ?>" class="ad-details-link">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
