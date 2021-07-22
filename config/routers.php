<?php

return [

    "" => [
        "controller" => "material",
        "action" => "index"
    ],

    "material" => [
        "controller" => "material",
        "action" => "index"
    ],

    "material/create" => [
        "controller" => "material",
        "action" => "create"
    ],

    "material/change/(\d+)" => [
        "controller" => "material",
        "action" => "change",
        "params" => "$1"
    ],

    "material/(\d+)" => [
        "controller" => "material",
        "action" => "view",
        "params" => "$1"
    ],

    "material/delete/(\d+)" => [
        "controller" => "material",
        "action" => "delete",
        "params" => "$1"
    ],

    "material/tag/delete/(\d+)/(\d+)" => [
        "controller" => "material",
        "action" => "deleteTag",
        "params" => "$1,$2"
    ],

    "tag" => [
        "controller" => "tag",
        "action" => "index"
    ],

    "tag/create" => [
        "controller" => "tag",
        "action" => "create"
    ],

    "tag/(\d+)" => [
        "controller" => "tag",
        "action" => "view",
        "params" => "$1"
    ],

    "tag/change/(\d+)" => [
        "controller" => "tag",
        "action" => "change",
        "params" => "$1"
    ],

    "tag/delete/(\d+)" => [
        "controller" => "tag",
        "action" => "delete",
        "params" => "$1"
    ],

    "category" => [
        "controller" => "category",
        "action" => "index"
    ],

    "category/create" => [
        "controller" => "category",
        "action" => "create"
    ],

    "category/(\d+)" => [
        "controller" => "category",
        "action" => "viewSubCategories",
        "params" => "$1"
    ],

    "category/change/(\d+)" => [
        "controller" => "category",
        "action" => "change",
        "params" => "$1"
    ],

    "category/delete/(\d+)" => [
        "controller" => "category",
        "action" => "delete",
        "params" => "$1"
    ],

    "subcategory/create/(\d+)" => [
        "controller" => "category",
        "action" => "createSubCategory",
        "params" => "$1"
    ],

    "subcategory/change/(\d+)" => [
        "controller" => "category",
        "action" => "changeSubCategory",
        "params" => "$1"
    ],

    "subcategory/delete/(\d+)" => [
        "controller" => "category",
        "action" => "deleteSubCategory",
        "params" => "$1"
    ],

    "link/delete/(\d+)" => [
        "controller" => "material",
        "action" => "delete",
        "params" => "$1"
    ],

    "type" => [
        "controller" => "type",
        "action" => "index"
    ],

    "type/create" => [
        "controller" => "type",
        "action" => "create"
    ],

    "type/change/(\d+)" => [
        "controller" => "type",
        "action" => "change",
        "params" => "$1"
    ],

    "type/delete/(\d+)" => [
        "controller" => "type",
        "action" => "delete",
        "params" => "$1"
    ],

];
