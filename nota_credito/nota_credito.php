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

class Nota_credito extends Module
{
    protected $config_form = false;

    protected $tabs = [
        [
            'name'      => 'Notas de Credito',
            'className' => 'AdminNota_CreditoModels',
            'active'    => 1,
            //submenus
            'childs'    => [
                [
                    'active'    => 1,
                    'name'      => 'Nueva Nota de Credito',
                    'className' => 'AdminNota_CreditoModels',
                ],
                [
                    'active'    => 1,
                    'name'      => 'Informe de Notas de Credito',
                    'className' => 'AdminReporte_NotaCreditoModels',
                ],
            ],
        ],
    ];
    
    public function __construct()
  {
    $this->name = 'nota_credito';
    $this->version = '1.0.2';
    $this->tab = 'other';
    $this->author = 'Corcaribe Tecnologia C.A';
    $this->author_uri = 'http://www.corcaribe.com/';
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.7.2.2');
    $this->displayName = $this->l('Notas de Credito');
    $this->description = $this->l('Modulo para el Manejo de Notas de Credito Jade');
    parent::__construct();
    if (!Configuration::get('nota_credito'))
      $this->warning = $this->l('No existe el módulo');
  }
  public function addTab(
        $tabs,
        $id_parent = 0
    )
    {
        foreach ($tabs as $tab)
        {
            $tabModel             = new Tab();
            $tabModel->module     = $this->name;
            $tabModel->active     = $tab['active'];
            $tabModel->class_name = $tab['className'];
            $tabModel->id_parent  = $id_parent;

            foreach (Language::getLanguages(true) as $lang)
            {
                $tabModel->name[$lang['id_lang']] = $tab['name'];
            }

            $tabModel->add();

            if (isset($tab['childs']) && is_array($tab['childs']))
            {
                $this->addTab($tab['childs'], Tab::getIdFromClassName($tab['className']));
            }
        }
        return true;
    }

    public function removeTab($tabs)
    {
        foreach ($tabs as $tab)
        {
            $id_tab = (int) Tab::getIdFromClassName($tab["className"]);
            if ($id_tab)
            {
                $tabModel = new Tab($id_tab);
                $tabModel->delete();
            }

            if (isset($tab["childs"]) && is_array($tab["childs"]))
            {
                $this->removeTab($tab["childs"]);
            }
        }

        return true;
    }

    public function install()
    {

        include(dirname(__FILE__).'/sql/install.php');
        $this->addTab($this->tabs);

        return parent::install();
    }

    public function uninstall()
    {
        $this->removeTab($this->tabs);

        return parent::uninstall();
    }

    
}