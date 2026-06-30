<?php
$categories = [
    [
        "code" => "c001",
        "name" => "cat-1",
        "products" => [
            [
                "ref" => "rprod-1",
                "name" => "prod-1",
                "quantity" => 100,
                "price" => 500 
            ],
            [
                "ref" => "rprod-2",
                "name" => "prod-2",
                "quantity" => 100,
                "price" => 500 
            ],
        ]
    ],
    [
        "code" => "c002",
        "name" => "cat-2",
        "products" => []
    ]
];

$categoriesWithEmptyProducts = [];

for ($i=0; $i < count($categories); $i++) { 
    if (empty($categories[$i]["products"])) {
        $categoriesWithEmptyProducts[] = $categories[$i];
    }
}

var_dump($categoriesWithEmptyProducts);