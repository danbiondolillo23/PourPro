<?php

    $host = "db";
    $port = "5432";
    $database = "example";
    $user = "localuser";
    $password = "cs4640LocalUser!"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database";
    } else {
        echo "An error occurred connecting to the database";
    }

    $res = pg_query($dbHandle, "DROP TABLE IF EXISTS sales, orders, users, products");

    if (!$res) {
        echo "Error dropping tables: " . pg_last_error($dbHandle);
        exit;
    }

    // Create tables
    $res  = pg_query($dbHandle, "CREATE TABLE IF NOT EXISTS users (
            user_id SERIAL PRIMARY KEY,
            name TEXT,
            email TEXT,
            password TEXT,
            type TEXT
    );");

    $res = pg_query($dbHandle, "CREATE TABLE IF NOT EXISTS products (
        product_id SERIAL PRIMARY KEY,
        product_name VARCHAR(255) NOT NULL,
        category VARCHAR(100) DEFAULT 'N/A', 
        brand VARCHAR(100) DEFAULT 'N/A',
        volume VARCHAR(50),
        unit_price NUMERIC(10, 2) NOT NULL,
        supply_price NUMERIC(10, 2) NOT NULL,
        quantity_available INT NOT NULL,
        image_link TEXT,
        barcode  VARCHAR(255)
    )");

    
    $res = pg_query($dbHandle, "CREATE TABLE IF NOT EXISTS sales (
        sales_id SERIAL PRIMARY KEY,
        product_id INT REFERENCES products(product_id),
        sales_date DATE DEFAULT CURRENT_DATE,
        quantity_sold INT NOT NULL,
        total_price NUMERIC(10, 2) NOT NULL,
        customer_id INT REFERENCES users(user_id)
    );"); 

    $res = pg_query($dbHandle, "CREATE TABLE IF NOT EXISTS orders (
            order_id SERIAL PRIMARY KEY,
            product_id INT REFERENCES products(product_id),
            order_date DATE DEFAULT CURRENT_DATE,
            quantity_ordered INT NOT NULL,
            total_cost NUMERIC(10, 2) NOT NULL
        );");

    if (!$res) {
        echo "Error: " . pg_last_error($dbHandle);
    }


    $products = json_decode(file_get_contents("products.json"), true);
    
    
    $res = pg_prepare(
        $dbHandle,
        "myinsert",
        "INSERT INTO products (product_name, category, brand, volume, unit_price, supply_price, quantity_available, barcode, image_link) 
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)"
    );
    
    foreach ($products as $product) {
        if (!$res) {
            echo "Error re-preparing statement: " . pg_last_error($dbHandle);
            continue;
        }
    
        $res = pg_execute($dbHandle, "myinsert", [
            $product["product_name"],
            $product["category"],
            $product["brand"],
            $product["volume"],
            $product["unit_price"],
            $product["supply_price"],
            $product["quantity_available"],
            $product["barcode"],
            $product["image_link"]
        ]);
    
        if (!$res) {
            echo "Error inserting data: " . pg_last_error($dbHandle);
        }
    }
    
    