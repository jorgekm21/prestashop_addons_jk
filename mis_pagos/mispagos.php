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

if (!defined('_PS_VERSION_')) {
    exit;
}

class Mispagos extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'mispagos';
        $this->tab = 'front_office_features';
        $this->version = '1.7.2';
        $this->author = 'Corcaribe Tecnología C.A';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Mis Pagos');
        $this->description = $this->l('Modulo para que las representantes verifiquen sus pagos');

        $this->confirmUninstall = $this->l('Esta seguro de querer desinstalar el modulo');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        Configuration::updateValue('MISPAGOS_LIVE_MODE', false);

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() &&

            $this->registerHook('displayClientesHook');
    }

    public function uninstall()
    {
        Configuration::deleteByName('MISPAGOS_LIVE_MODE');

        return parent::uninstall();
    }

    public function assingClientesContent()
    {
        $representante = $this->context->customer->id;

        $xpagos = Db::getInstance()->executeS('
        SELECT `'._DB_PREFIX_.'banco`.`nombre_banco`, `'._DB_PREFIX_.'mis_pagos`.`fecha`, `'._DB_PREFIX_.'mis_pagos`.`tipo_operacion`, `'._DB_PREFIX_.'mis_pagos`.`num_operacion`, `'._DB_PREFIX_.'mis_pagos`.`monto` 
        FROM `'._DB_PREFIX_.'banco`, `'._DB_PREFIX_.'mis_pagos`
        WHERE (`'._DB_PREFIX_.'banco`.`id_banco`=`'._DB_PREFIX_.'mis_pagos`.`banco`) and (`id_customer`='.(int)$representante.')');

        $this->context->smarty->assign('xpagos', $xpagos);

        $pop = Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'banco` WHERE `pop` = 1');

        $this->context->smarty->assign('pop', $pop);

        $consiliado = Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'banco` WHERE `consiliado`= 1');

        $this->context->smarty->assign('consiliado', $consiliado);   
    }
    public function processClientesHook()
    {
        $representante = $this->context->customer->id;
        $url_actual = $_SERVER['REQUEST_URI'];
        if (Tools::isSubmit('agregar')){
            $fecha = Tools::getValue('fecha');
            $tipo_operacion = Tools::getValue('tipo');
            if ((Tools::getValue('tipo'))=="Deposito"){
                $dep = Tools::getValue('nombredelbanco');
            } else {
                $dep = Tools::getValue('nombredelbancod');
            }
            $planilla = Tools::getValue('planilla');
            $monto = Tools::getValue('monto');

            if ((Tools::isInt($planilla)) and (Tools::isInt($monto))) {
                $insert = array(
                    'id_customer' => (int)$representante,
                    'tipo_operacion' => pSQL($tipo_operacion),
                    'banco' => (int)$dep,
                    'fecha' => pSQL($fecha),
                    'num_operacion' => pSQL($planilla),
                    'monto' => (int)$monto,

                    );

                Db::getInstance()->insert('mis_pagos', $insert);
                header('location:'. $url_actual);

            } else {

                $error = "Debe Ingresar Los Campos Solicitados correctamente y/o al menos 1 producto a ajustar";
                $this->context->smarty->assign('error', $error);

            }

        }
    }

    public function hookDisplayClientesHook()
    {
        if(Tools::getValue('id_cms')!=7){

            return;
        }
        $this->assingClientesContent();
        $this->processClientesHook();
        return $this->display(__FILE__,'displayClientesHook.tpl');
    }
}