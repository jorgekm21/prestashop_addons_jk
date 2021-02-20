<?php
/**
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'notacredito` (
					`id_nota` int(10) NOT NULL AUTO_INCREMENT,
                    `cedula_rep` varchar(12) NOT NULL,
                    `camp_elab` int NOT NULL,
                    `id_zona` int NOT NULL,
                    `id_sector` int,
                    `fecha_elab` date NOT NULL,
                    `id_employee` int NOT NULL,
                    `num_nota` varchar(12) NOT NULL,
                    `num_doc` varchar(15),
                    `camp_doc` int,
                    `num_ref` varchar(10) NOT NULL,
                    `num_ajuste` varchar(15) NOT NULL,
                    `sub_total` varchar(25),
                    PRIMARY KEY (`id_nota`));';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'detalle_notacredito` (
					`id_detalle` int(10) NOT NULL AUTO_INCREMENT,
                    `id_nota` int,
                    `codigo_producto` varchar(10) NOT NULL,
                    `cantidad` int NOT NULL,
                    `precio` varchar(25) NOT NULL,
                    `id_motivo` int NOT NULL,
                    PRIMARY KEY (`id_detalle`));';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
