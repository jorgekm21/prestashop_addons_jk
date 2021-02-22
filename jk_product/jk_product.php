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

if (!defined('_PS_VERSION_')) {
    exit;
}

class Jk_Product extends Module{
    public function __construct(){
        $this->name = 'jk_product';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'Jorge Kassabji';

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Campo Producto');
        $this->descrition = $this->l('Campo Adicional agregado en la interfaz de producto en back y front');

        $this->confirmUninstall = $this->l('Esta seguro que desea desinstalar?');
        
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        if (!parent::install() || !$this->registerHook('displayAdminProductsMainStepLeftColumnMiddle') || !$this->registerHook('displayProductAdditionalInfo'))
        {
            return false;
        }

        $this->install_db();

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() || !$this->unregisterHook('displayAdminProductsMainStepLeftColumnMiddle') || !$this->unregisterHook('displayProductAdditionalInfo'))
        {
            return false;
        }

        $this->uninstall_db();

        return true;
    }

    public function install_db()
    {
        $sqlInstall = 'ALTER TABLE '. _DB_PREFIX_ . 'product '
            . 'ADD additional_field VARCHAR(255) NULL';

        $returnsql = Db::getInstance()->execute($sqlInstall);

        return $returnsql;
    }

    public function uninstall_db()
    {
        $sqlUninstall = 'ALTER TABLE '. _DB_PREFIX_ . 'product '
            . 'DROP additional_field';

        $sqlreturn = Db::getInstance()->execute($sqlUninstall);

        return $sqlreturn;
    }

    public function hookDisplayAdminProductsMainStepLeftColumnMiddle($params)
    {
        $product = new Product($params['id_product']);
        $this->context->smarty->assign(array(
            'additional_field' => $product->additional_field,
        ));

        return $this->display(__FILE__, 'views/templates/hook/extrafields.tpl');
    }

    public function hookdisplayProductAdditionalInfo($params)
    {
        $product = new Product($params['id_product']);
        $this->context->smarty->assign(array(
            'additional_field' => $product->additional_field,
        ));

        return $this->display(__FILE__, 'views/templates/hook/frontextrafields.tpl');
    }
}