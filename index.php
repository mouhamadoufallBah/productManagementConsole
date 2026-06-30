<?php
//1- initialiser le tableau categories
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

//2-afficher les categories qui n'ont pas de produits
$categoriesWithEmptyProducts = [];
for ($i = 0; $i < count($categories); $i++) {
    if (empty($categories[$i]["products"])) {
        $categoriesWithEmptyProducts[] = $categories[$i];
    }
}

// var_dump($categoriesWithEmptyProducts);
//3-ajouter categorie
do {
    $code = trim(readline("Entrez le code: "));
    if (strlen($code) === 0) {
        echo "Ce champs est obligatoire";
        continue;
    }

    for ($i = 0; $i < count($categories); $i++) {
        if ($categories[$i]["code"] === strtolower($code)) {
            echo "Cette categorie existe deja";
            continue 2;
        }
    }

    break;
} while (true);

do {
    $name = trim(readline("Entrez le name: "));
    if (strlen($name) === 0) {
        echo "Ce champs est obligatoire";
        continue;
    }

    for ($i = 0; $i < count($categories); $i++) {
        if ($categories[$i]["name"] === strtolower($name)) {
            echo "Cette categorie existe deja";
            continue 2;
        }
    }

    break;
} while (true);

array_push(
    $categories,
     [
        "code" => $code,
        "name" => $name,
        "products" => []
    ]
);

var_dump($categories);
