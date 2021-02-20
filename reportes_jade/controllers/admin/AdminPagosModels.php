<?php

class AdminPagosModelsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap   = true;
        parent::__construct();

    }

    public function processForm()
    {
        $gerente = $this->context->employee->id;

        $cedula = Db::getInstance()->executeS('SELECT `'._DB_PREFIX_.'customer`.`id_customer`, `'._DB_PREFIX_.'customer`.`siret` FROM `'._DB_PREFIX_.'customer`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'asignaciongerente` WHERE   (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'asignaciongerente`.`id_employee`) AND (`'._DB_PREFIX_.'asignaciongerente`.`id_customer` = `'._DB_PREFIX_.'customer`.`id_customer`)');
        $this->context->smarty->assign('cedula', $cedula);
    }

    public function processSelect()
    {
        $gerente = $this->context->employee->id;

        if(Tools::isSubmit('consulta'))
        {
            $cedula_select = Tools::getValue('cedula');

            $representante = Db::getInstance()->executeS('SELECT `firstname`, `lastname`, `siret` FROM `'._DB_PREFIX_.'customer` WHERE `id_customer` = '.$cedula_select.'');
            $this->context->smarty->assign('representante', $representante);

            $reporte = Db::getInstance()->executeS('SELECT `'._DB_PREFIX_.'mis_pagos`.`tipo_operacion`, `'._DB_PREFIX_.'banco`.`nombre_banco`, `'._DB_PREFIX_.'mis_pagos`.`fecha`, `'._DB_PREFIX_.'mis_pagos`.`num_operacion`, `'._DB_PREFIX_.'mis_pagos`.`monto` FROM `'._DB_PREFIX_.'mis_pagos`, `'._DB_PREFIX_.'banco` WHERE (`'._DB_PREFIX_.'mis_pagos`.`id_customer` = '.$cedula_select.') AND (`'._DB_PREFIX_.'mis_pagos`.`banco` = `'._DB_PREFIX_.'banco`.`id_banco`)');
            $this->context->smarty->assign('reporte', $reporte);

            $this->context->smarty->assign('activate', TRUE);
        }
    }

    public function createTemplate($tpl_name) {
        if (file_exists($this->getTemplatePath() . $tpl_name) && $this->viewAccess())
                return $this->context->smarty->createTemplate($this->getTemplatePath() . $tpl_name, $this->context->smarty);
            return parent::createTemplate($tpl_name);
    }

    public function initContent(){
        parent::initContent();
        $this->processForm();
        $this->processSelect();
        $tpl = $this->createTemplate('reportepago.tpl')->fetch();
        $this->setTemplate('reportepago.tpl');

    }
}

?>