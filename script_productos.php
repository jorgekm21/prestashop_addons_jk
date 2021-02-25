<?php
header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('_PS_ADMIN_DIR_', getcwd());

//include_once(_PS_ADMIN_DIR_ . '/../config/settings.inc.php');
include_once(_PS_ADMIN_DIR_ . '/../config/config.inc.php');


use PrestaShop\PrestaShop\Core\Import\Configuration\ImportConfigInterface;
use PrestaShop\PrestaShop\Adapter\Tools;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use Tools as LegacyTools;

$context = Context::getContext();
$employee = new Employee(1);
$context->employee = $employee;


function loadProductsPost() {

    $_POST = array (
        'tab' => 'AdminImport',
        'forceIDs' => '0',
        'skip' => '1',
        'csv' => 'productos.csv',
        'entity' => '1',
        'separator' => ',',
        'multiple_value_separator' => ';',
        'iso_lang' => 'es',
        'convert' => '',
        'type_value' => array(
            0 => 'name',
            1 => 'reference',
            2 => 'ean13',
            3 => 'no',
            4 => 'no',
            5 => 'no',
            6 => 'quantity',
            7 => 'category',
            8 => 'no',


        ),
    );
}


$import = New AdminImportControllerCore();
loadProductsPost();
$import->productImport();


echo ('ejecutado');
?>