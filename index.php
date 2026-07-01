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

function readRequiredString(string $smsSaisie): string {
    do {
        $value = trim(readline($smsSaisie));
        if (strlen($value) === 0) {
            echo "Ce champs est obligatoire\n";
            continue;
        }
        return $value;
    } while (true);
}

function readPositiveInteger(string $smsSaisie): int {
    do {
        $value = readline($smsSaisie);
        if (!ctype_digit($value)) {
            echo "Ce champs ne doit pas etre inferieur 0 \n";
            continue;
        }
        return (int)$value;
    } while (true);
}

function checkCodeExists(array $categories, string $code): bool {
    for ($i = 0; $i < count($categories); $i++) {
        if ($categories[$i]["code"] === strtolower($code)) {
            return true;
        }
    }
    return false;
}

function checkNameExists(array $categories, string $name): bool {
    for ($i = 0; $i < count($categories); $i++) {
        if ($categories[$i]["name"] === strtolower($name)) {
            return true;
        }
    }
    return false;
}

function checkRefExistsGlobal(array $categories, string $ref): bool {
    foreach ($categories as $cat) {
        foreach ($cat["products"] as $prod) {
            if ($prod["ref"] === strtolower($ref)) {
                return true;
            }
        }
    }
    return false;
}

function checkRefExistsSession(array $products, string $ref): bool {
    foreach ($products as $prod) {
        if ($prod["ref"] === strtolower($ref)) {
            return true;
        }
    }
    return false;
}
