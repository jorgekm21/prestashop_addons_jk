<?php
/**
* 2007-2021 PrestaShop
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
*  @author    Jorge Kassabji <jorgekm21@gmail.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')){
    exit;
}

class Import_Product_Jk extends Module
{
    public function __construct()
    {
        $this->name = 'import_product_jk';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'Jorge Kassabji';

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Importar Producto JK');
        $this->description = $this->l('Descripcion Importar Producto');

        $this->confirmUninstall = $this->l('Esta seguro que desea desinstalar?');
        
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        if (!parent::install())
        {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() || !Configuration::updateValue('JK_IMPORTAR_PRODUCTO', 'testing'))
        {
            return false;
        }

        return true;
    }

    public function getContent()
    {
        return $this->postProcess() . $this->getForm();
    }

    public function getForm()
    {
        $fieldsForm[0]['form'] = [
            'legend' => [
                'title' => $this->displayName,
            ],
            'input' => [
                [
                    'type' => 'file',
                    'label' => $this->l('Modulo activo'),
                    'name' => 'modulo_activo',
                    'size' => 20,
                ]
                ],
                'submit' => [
                    'title' => $this->l('Guardar'),
                    'class' => 'btn btn-default pull-right'
                ],
            ];

        $helper = new HelperForm();

        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        $helper->default_form_language = $defaultLang;
        $helper->allow_employee_form_lang = $defaultLang;

        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit';

        //$helper->fields_value['modulo_activo'] = Configuration::get('JK_IMPORTAR_PRODUCTO');

        return $helper->generateForm($fieldsForm);
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submit')){
            $modulo_activo = Tools::getValue('modulo_activo');

            Configuration::updateValue('JK_IMPORTAR_PRODUCTO', $modulo_activo);

            $this->cargarProducto();

            return $this->displayConfirmation($this->l('Actualizacion Exitosa'));
        }
    }

    public function cargarProducto(){
        return true;
    }
}