<?php
    // Get the category and the product type sent by GET Request
    $cat = $_GET['cat'];
    $pro = $_GET['pro'];

    // Define a Product class with a name property
    class Product {
        public string $name;
        
        public function __construct(string $name) {
            $this->name = $name;
        }
    }
    
    // Define a Category class with a name and products property
    class Category {
        public string $name;
        public array $products;
        
        public function __construct(string $name, array $products) {
            $this->name = $name;
            $this->products = $products;
        }
    }
    
    // Create an array $data containing instances of Category and Product
    $data = [
        new Category('Health and Wellness', [
            new Product('Walkers'),
            new Product('Adjustable walking canes'),
            new Product('Mobility scooters')
        ]),

        new Category('Home Safety and Comfort', [
            new Product('Grab bars for bathrooms'),
            new Product('Non-slip bath mats'),
            new Product('Raised toilet seats')
        ]),
            
        new Category('Home Accessibility', [
            new Product('Adaptive kitchen utensils'),
            new Product('Jar openers'),
            new Product('Reacher grabber tools')
        ]),
            
        new Category('Technology and Gadgets', [
            new Product('Senior-friendly smartphones'),
            new Product('Tablet computers with simplified interfaces'),
            new Product('Smart home devices')
        ]),
            
        new Category('Comfort and Leisure', [
            new Product('Memory foam pillows'),
            new Product('Adjustable bed wedges'),
            new Product('Electric blankets')
        ])
    ];
    
    /**
     * Return a product inside a category.
     *
     * @param string $category
     * @param string $productName
     *
     * @return Product|null
     */

     function getProductsInCategory(string $category, string $productName): ?Product {
        global $data;
    
        // Convert both the category and product names to lowercase
        $categoryLower = strtolower($category);
        $productNameLower = strtolower($productName);
    
        foreach ($data as $cat) {
            // Convert the category name in the array to lowercase for comparison
            $currentCategoryLower = strtolower($cat->name);
    
            if ($currentCategoryLower === $categoryLower) {
                foreach ($cat->products as $product) {
                    // Convert the product name in the array to lowercase for comparison
                    $currentProductLower = strtolower($product->name);
    
                    if ($currentProductLower === $productNameLower) {
                        return $product; // Early termination if the product is found
                    }
                }
            }
        }
    
        // Product not found
        return null;
    }
    
    // Function to check if a product exists in a category
    function doesProductExistInCategory(string $category, string $product): bool {
        // Send $category and $product as parsable parameters to the getProductsInCategory func
        $result = getProductsInCategory($category, $product);
    
        // If $result is not null, the product exists in the category
        return $result !== null;
    }

    // Check if category and product are selected in the GET request
    if ($cat != "Select Category" && $pro != "Select Product") {
        // Check if the product exists in the category
        if (doesProductExistInCategory($cat, $pro)) {
            // Display images for the product in the category
            $images = ['a.jpg', 'b.jpg', 'c.jpg'];
            foreach ($images as $image) {
                $rndomInteger = rand(1, 10000); // Adjust the range as needed
                echo '<div class="responsive">';
                echo '<div class="gallery">';
                echo "<a target='_blank' href='img/{$cat}/{$pro}/{$image}'>";
                echo "<img src='img/{$cat}/{$pro}/{$image}' alt='{$pro}'>";
                echo "</a>";
                echo "<div class='desc'>Price: R{$rndomInteger}.00</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // Display a message if the product does not exist in the category
            echo "<p>Product: [$pro] does not exist in Category: (" . ucfirst($cat) . ")</p>";
        }
    } else {
        // Display a message if category and product are not selected
        echo "<p>You must select Category and Product before Submitting</p>";
    }

?>