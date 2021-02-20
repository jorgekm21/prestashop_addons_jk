<?php

class AdminReporte_NotaCreditoModelsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap   = true;
        
        parent::__construct();

    }

    public function processSelect()
    {
        $gerente = $this->context->employee->id;

        $tienda_select = Db::getInstance()->executeS('SELECT `id_shop`, `name` FROM `'._DB_PREFIX_.'shop`');
        $this->context->smarty->assign('tienda', $tienda_select);

    }

    public function processForm()
    {
        $gerente = $this->context->employee->id;
        $url_actual = $_SERVER['REQUEST_URI'];
        if (Tools::isSubmit('consulta'))
        {
            $tienda = Tools::getValue('campana');
            $query = Db::getInstance()->executeS('SELECT `cedula_rep`, `'._DB_PREFIX_.'shop`.`name`, `num_nota`, `num_ref`, `sub_total` FROM `'._DB_PREFIX_.'notacredito`, `'._DB_PREFIX_.'shop` WHERE (`id_employee` = '.$gerente.') AND (`camp_elab` = '.$tienda.')');
            $this->context->smarty->assign('tabla', $query);
            $this->context->smarty->assign('activate', True);
        }
    }

     public function createTemplate($tpl_name) {
        if (file_exists($this->getTemplatePath() . $tpl_name) && $this->viewAccess())
                return $this->context->smarty->createTemplate($this->getTemplatePath() . $tpl_name, $this->context->smarty);
            return parent::createTemplate($tpl_name);
    }

    public function initContent(){
        parent::initContent();
        $this->processSelect();
        $this->processForm();
        $tpl = $this->createTemplate('informe_content.tpl')->fetch();
        $this->setTemplate('informe_content.tpl');

    }
}