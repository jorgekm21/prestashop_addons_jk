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

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'ajustes` (
                                            `id_ajustes`    int NOT NULL AUTO_INCREMENT,
                                            `id_employee`   int NOT NULL,
                                            `camp_creado`   int NOT NULL,
                                            `fecha_creado`  date NOT NULL,
                                            `cedula_rep`    varchar(10) NOT NULL,
                                            `id_zona`       int NOT NULL,
                                            `num_factura`   varchar(12) NOT NULL,
                                            `num_ajust`     varchar(12) NOT NULL,
                                            `camp_factura`  int NOT NULL,
                                            `tot_ajuste`    varchar(25),
                                            `tot_envio`     varchar(25),
                                            `tot_dif`       varchar(25),
                                            PRIMARY KEY  (`id_ajustes`));';
                                            
$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'detalles_ajustes` (
											`id_detalle` int NOT NULL AUTO_INCREMENT,
                                            `id_ajustes` int NOT NULL,
                                            `codigo_producto` varchar(10) NOT NULL,
                                            `cantidad` int NOT NULL,
                                            `precio` int NOT NULL,
                                            `id_motivo` int,
                                            PRIMARY KEY  (`id_detalle`))';
                                            
$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'detalle_ajustedevuelto` (
	                                        `id_detalle` INT(10) NOT NULL AUTO_INCREMENT,
	                                        `id_ajustes` INT(10) NOT NULL,
	                                        `codigo_producto` VARCHAR(10) NOT NULL,
	                                        `cantidad` INT(10) NOT NULL,
	                                        `precio` VARCHAR(10) NULL DEFAULT NULL,
	                                        PRIMARY KEY (`id_detalle`))';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
