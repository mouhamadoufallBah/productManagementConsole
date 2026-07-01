<?php
$categories = [
    [
        "code" => "c001",
        "name" => "cat-1",
        "products" => [
            ["ref" => "rprod-1", "name" => "prod-1", "quantity" => 100, "price" => 500],
            ["ref" => "rprod-2", "name" => "prod-2", "quantity" => 100, "price" => 500],
        ]
    ],
    [
        "code" => "c002",
        "name" => "cat-2",
        "products" => []
    ]
];

function readRequiredString(string $smsSaisie): string
{
    do {
        $value = trim(readline($smsSaisie));
        if (strlen($value) === 0) {
            echo "Ce champs est obligatoire\n";
            continue;
        }
        return $value;
    } while (true);
}

function readPositiveInteger(string $smsSaisie): int
{
    do {
        $value = readline($smsSaisie);
        if (!ctype_digit($value)) {
            echo "Ce champs ne doit pas etre inferieur 0 \n";
            continue;
        }
        return (int)$value;
    } while (true);
}

function checkCodeExists(array $categories, string $code): bool
{
    for ($i = 0; $i < count($categories); $i++) {
        if ($categories[$i]["code"] === strtolower($code)) {
            return true;
        }
    }
    return false;
}

function checkNameExists(array $categories, string $name): bool
{
    for ($i = 0; $i < count($categories); $i++) {
        if ($categories[$i]["name"] === strtolower($name)) {
            return true;
        }
    }
    return false;
}

function checkRefExistsGlobal(array $categories, string $ref): bool
{
    foreach ($categories as $cat) {
        foreach ($cat["products"] as $prod) {
            if ($prod["ref"] === strtolower($ref)) {
                return true;
            }
        }
    }
    return false;
}

function checkRefExistsSession(array $products, string $ref): bool
{
    foreach ($products as $prod) {
        if ($prod["ref"] === strtolower($ref)) {
            return true;
        }
    }
    return false;
}

function showCategoriesWithEmptyProducts(array $categories): void
{
    $categoriesWithEmptyProducts = [];
    for ($i = 0; $i < count($categories); $i++) {
        if (empty($categories[$i]["products"])) {
            $categoriesWithEmptyProducts[] = $categories[$i];
        }
    }
    var_dump($categoriesWithEmptyProducts);
}

function storeCategoryWithEmptyProducts(array &$categories): void
{

    do {
        $code = readRequiredString("Entrez le code: ");
        if (checkCodeExists($categories, $code)) {
            echo "Cette categorie existe deja\n";
            continue;
        }
        break;
    } while (true);

    do {
        $name = readRequiredString("Entrez le name: ");
        if (checkNameExists($categories, $name)) {
            echo "Cette categorie existe deja\n";
            continue;
        }
        break;
    } while (true);

    $categorie = [
        "code" => $code,
        "name" => $name,
        "products" => []
    ];

    $categories[] = $categorie;

    var_dump($categories);
}

function storeProductInExistingCategory(array &$categories): void {
    $indexCategorie = null;
    
    do {
        $code = readRequiredString("Entrez le code: ");
        
        for ($i = 0; $i < count($categories); $i++) {
            if ($categories[$i]["code"] === strtolower($code)) {
                $indexCategorie = $i;
                break;
            }
        }

        if ($indexCategorie !== null) {
            break;
        }

        echo "Cette categorie n'existe pas \n";
    } while (true);

    do {
        $ref = readRequiredString("Entre la ref: ");
        if (checkRefExistsGlobal($categories, $ref)) {
            echo "Cette ref existe deja \n";
            continue;
        }
        break;
    } while (true);

    $name = readRequiredString("Entre la name: ");
    $price = readPositiveInteger("Entre la price: ");
    $quantity = readPositiveInteger("Entre la quantity: ");

    $categories[$indexCategorie]["products"][] = [
        "ref" => strtolower($ref),
        "name" => $name,
        "quantity" => $quantity,
        "price" => $price
    ];

    var_dump($categories);
}

function storeCategoryWithProducts(array &$categories): void
{

    do {
        $code = readRequiredString("Entrez le code category: ");
        if (checkCodeExists($categories, $code)) {
            echo "Cette categorie existe deja";
            continue;
        }
        break;
    } while (true);

    do {
        $name = readRequiredString("Entrez le name category: ");
        if (checkNameExists($categories, $name)) {
            echo "Cette categorie existe deja";
            continue;
        }
        break;
    } while (true);

    $products = [];

    do {
        do {
            $ref = readRequiredString("Entre la ref produit: ");

            if (checkRefExistsGlobal($categories, $ref)) {
                echo "Cette ref existe deja \n";
                continue;
            }
            if (checkRefExistsSession($products, $ref)) {
                echo "Cette ref existe deja dans cette session \n";
                continue;
            }
            break;
        } while (true);

        $nameProduct = readRequiredString("Entre la name produit: ");
        $price = readPositiveInteger("Entre la price: ");
        $quantity = readPositiveInteger("Entre la quantity: ");

        $products[] = [
            "ref" => $ref,
            "name" => $nameProduct,
            "price" => $price,
            "quantity" => $quantity
        ];

        $choix = strtolower(readline(" voulez vous continuer  oui/non "));
    } while ($choix === "oui");

    $categorie = [
        "code" => $code,
        "name" => $name,
        "products" => $products
    ];

    $categories[] = $categorie;

    var_dump($categorie);
}


// showCategoriesWithEmptyProducts($categories);
// storeCategoryWithEmptyProducts($categories);
// storeProductInExistingCategory($categories);

storeCategoryWithProducts($categories);