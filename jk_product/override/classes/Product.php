<?php

class Product extends ProductCore {
    public $additional_field;

    public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
    {
        self::$definition['fields']['additional_field'] = [
            'type' => self::TYPE_STRING,
            'required' => false,
            'size' => 255
        ];

        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
    }
}