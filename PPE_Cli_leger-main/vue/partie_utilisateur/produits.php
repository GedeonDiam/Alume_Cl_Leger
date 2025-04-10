<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en ligne</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 40px 0;
            background: linear-gradient(135deg, #6366F1, #4F46E5);
            color: white;
            margin-bottom: 40px;
        }

        .search-bar {
            max-width: 600px;
            margin: 20px auto;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px;
            border: none;
            border-radius: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            font-size: 16px;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 20px;
            background: white;
            color: #4F46E5;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background: #4F46E5;
            color: white;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            padding: 20px 0;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-category {
            color: #6366F1;
            font-size: 0.9em;
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #1F2937;
        }

        .product-price {
            font-size: 1.4em;
            font-weight: 600;
            color: #4F46E5;
            margin-bottom: 15px;
        }

        .add-to-cart {
            width: 100%;
            padding: 12px;
            background: #4F46E5;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .add-to-cart:hover {
            background: #6366F1;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Notre Collection</h1>
        <p>Découvrez nos produits sélectionnés avec soin</p>
    </div>

    <div class="container">
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Rechercher un produit...">
        </div>

        <div class="filters">
            <button class="filter-btn">Tous</button>
            <button class="filter-btn">Électronique</button>
            <button class="filter-btn">Mode</button>
            <button class="filter-btn">Maison</button>
            <button class="filter-btn">Sport</button>
        </div>

        <div class="products-grid">
            <?php
            $products = [
                [
                    'name' => 'AirPods Pro',
                    'category' => 'Électronique',
                    'price' => '279.99',
                    'description' => 'Réduction de bruit active',
                    'image' => 'https://via.placeholder.com/300x200'
                ],
                [
                    'name' => 'MacBook Air M2',
                    'category' => 'Électronique',
                    'price' => '1299.99',
                    'description' => 'Puissant et léger',
                    'image' => 'https://via.placeholder.com/300x200'
                ],
                [
                    'name' => 'iPhone 14 Pro',
                    'category' => 'Électronique',
                    'price' => '1159.99',
                    'description' => 'Le dernier iPhone',
                    'image' => 'https://via.placeholder.com/300x200'
                ],
                [
                    'name' => 'iPad Air',
                    'category' => 'Électronique',
                    'price' => '699.99',
                    'description' => 'Parfait pour créer',
                    'image' => 'https://via.placeholder.com/300x200'
                ]
            ];

            foreach ($products as $product) {
                echo '<div class="product-card">
                    <img src="' . $product['image'] . '" alt="' . $product['name'] . '" class="product-image">
                    <div class="product-info">
                        <div class="product-category">' . $product['category'] . '</div>
                        <h3 class="product-title">' . $product['name'] . '</h3>
                        <div class="product-price">' . $product['price'] . ' €</div>
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
