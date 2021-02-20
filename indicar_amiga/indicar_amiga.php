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
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Indicar_amiga extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'indicar_amiga';
        $this->tab = 'front_office_features';
        $this->version = '1.7.2';
        $this->author = 'Corcaribe Tecnologia C.A';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Indicar Amiga');
        $this->description = $this->l('Módulo para que las representantes indiquen una amiga');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        Configuration::updateValue('INDICAR_AMIGA_LIVE_MODE', false);

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() &&

            $this->registerHook('displayClientesHook');
    }

    public function uninstall()
    {
        Configuration::deleteByName('INDICAR_AMIGA_LIVE_MODE');

        return parent::uninstall();
    }

    public function assignIndicar_amigaContent()
    {
    $representante = $this->context->customer->id;
    $amiga = Db::getInstance()->executeS('SELECT `'._DB_PREFIX_.'customer`.`lastname`, `'._DB_PREFIX_.'customer`.`firstname`, `'._DB_PREFIX_.'customer`.`id_customer`, `'._DB_PREFIX_.'customer`.`siret`,`'._DB_PREFIX_.'zonas`.`CODIGOZONA` 
    FROM `'._DB_PREFIX_.'customer`, `'._DB_PREFIX_.'asignaciongerente`, `'._DB_PREFIX_.'zonas`
    WHERE (`'._DB_PREFIX_.'customer`.`id_customer` = `'._DB_PREFIX_.'asignaciongerente`.`id_customer`) and (`'._DB_PREFIX_.'zonas`.`id_employee` = `'._DB_PREFIX_.'asignaciongerente`.`id_employee`) and (`'._DB_PREFIX_.'customer`.`id_customer` = '.$representante.')');

        $this->context->smarty->assign('amiga', $amiga);
    }


    
    public function postProcess()
    {

    }
    
        
    
    public function hookDisplayClientesHook($params)
    {
      if(tools::getValue('id_cms')!=8){
          return;
      }
    $this->assignIndicar_amigaContent();
    $this->postProcess();

    return $this->display(__FILE__,'displayClientesHook.tpl');

    }
}
