<?php

class AdminNota_CreditoModelsController extends ModuleAdminController
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

        $zona_select = Db::getInstance()->executeS('SELECT `CODIGOZONA`, `id_employee` FROM '._DB_PREFIX_.'zonas WHERE id_employee = '.$gerente);
        $this->context->smarty->assign('zona', $zona_select);

        $sector_select = Db::getInstance()->executeS('SELECT `'._DB_PREFIX_.'sector`.`id_sector`, `'._DB_PREFIX_.'sector`.`sector` FROM '._DB_PREFIX_.'sector, '._DB_PREFIX_.'zonas WHERE (`'._DB_PREFIX_.'sector`.`id_zona` = `'._DB_PREFIX_.'zonas`.`id_zona`) AND (`'._DB_PREFIX_.'zonas`.`id_employee` = '.$gerente);
        $this->context->smarty->assign('sector', $sector_select);

        $gerentezona_select = Db::getInstance()->executeS('SELECT `'._DB_PREFIX_.'employee`.`firstname`, `'._DB_PREFIX_.'employee`.`id_employee`, `'._DB_PREFIX_.'zonas`.`CODIGOZONA` FROM '._DB_PREFIX_.'zonas, '._DB_PREFIX_.'employee WHERE (`'._DB_PREFIX_.'zonas`.`id_employee` = `'._DB_PREFIX_.'employee`.`id_employee`) AND `'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente);
        $this->context->smarty->assign('gerentezona', $gerentezona_select);

        $motivo_select = Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.'motivos');
        $this->context->smarty->assign('motivo', $motivo_select);

        $nota = Db::getInstance()->executeS('SELECT id_nota FROM '._DB_PREFIX_.'notacredito ORDER BY id_nota DESC LIMIT 1');
        $this->context->smarty->assign('id_nota', $nota);
    }

    public function processForm()
    {
        $gerente = $this->context->employee->id;
        $url_actual = $_SERVER['REQUEST_URI'];
        if (Tools::isSubmit('boton')){

            /* Control DATAGRID */

            $codigo1 = Tools::getValue('codigo1');
            $codigo2 = Tools::getValue('codigo2');
            $codigo3 = Tools::getValue('codigo3');
            $codigo4 = Tools::getValue('codigo4');
            $codigo5 = Tools::getValue('codigo5');
            $cantidad1 = Tools::getValue('cantidad1');
            $cantidad2 = Tools::getValue('cantidad2');
            $cantidad3 = Tools::getValue('cantidad3');
            $cantidad4 = Tools::getValue('cantidad4');
            $cantidad5 = Tools::getValue('cantidad5');
            $precio1 = Tools::getValue('precio1');
            $precio2 = Tools::getValue('precio2');
            $precio3 = Tools::getValue('precio3');
            $precio4 = Tools::getValue('precio4');
            $precio5 = Tools::getValue('precio5');
            $motivo1 = Tools::getValue('motivo1');
            $motivo2 = Tools::getValue('motivo2');
            $motivo3 = Tools::getValue('motivo3');
            $motivo4 = Tools::getValue('motivo4');
            $motivo5 = Tools::getValue('motivo5');
            $id_notasiguiente = (((int)(Tools::getValue('id_nota'))) + 1);
            $total = 0;
            $cedula = Tools::getValue('cedula');
            $campana = Tools::getValue('campana');
            $zona = Tools::getValue('zona');
            $sector = Tools::getValue('sector');
            $fecha = Tools::getValue('fecha');
            $zonagerente = Tools::getValue('zonagerente');
            $num_nota = Tools::getValue('num_nota');
            $num_doc = Tools::getValue('num_doc');
            $camp_doc = Tools::getValue('camp_doc');
            $num_ref = Tools::getValue('num_ref');
            $num_ajust = Tools::getValue('num_ajust');

            /* Procesamiento DATAGRID */

            if (($codigo1||$codigo2||$codigo3||$codigo4||$codigo5) && ((Tools::isInt($cedula)) and (Tools::isInt($num_nota)) and (Tools::isInt($num_doc)) and (Tools::isInt($num_ref)) and (Tools::isInt($num_ajust)))) {

                $insert_principal = array(
                    'cedula_rep'    => pSQL($cedula),
                    'camp_elab'     => pSQL($campana),
                    'id_zona'       => (int)$zona,
                    'id_sector'     => (int)$sector,
                    'fecha_elab'    => pSQL($fecha),
                    'id_employee'   => (int)$zonagerente,
                    'num_nota'      => pSQL($num_nota),
                    'num_doc'       => pSQL($num_doc),
                    'camp_doc'      => pSQL($camp_doc),
                    'num_ref'       => pSQL($num_ref),
                    'num_ajuste'    => pSQL($num_ajust),
                    'sub_total'     => pSQL($total),
                );

                if ($codigo1 && $cantidad1 && $precio1 && $motivo1) {
                    $grid1 = array(
                        'id_nota'           => (int)$id_notasiguiente,
                        'codigo_producto'   => pSQL($codigo1),
                        'cantidad'          => (int)$cantidad1,
                        'precio'            => pSQL($precio1),
                        'id_motivo'         => (int)$motivo1,
                    );

                    $total = ($total) + ($cantidad1 * $precio1);
                    Db::getInstance()->insert('detalle_notacredito', $grid1);
                }

                if ($codigo2 && $cantidad2 && $precio2 && $motivo2) {
                    $grid2 = array(
                        'id_nota'           => (int)$id_notasiguiente,
                        'codigo_producto'   => pSQL($codigo2),
                        'cantidad'          => (int)$cantidad2,
                        'precio'            => pSQL($precio2),
                        'id_motivo'         => (int)$motivo2,
                    );

                    $total = ($total) + ($cantidad2 * $precio2);
                    Db::getInstance()->insert('detalle_notacredito', $grid2);
                }

                if ($codigo3 && $cantidad3 && $precio3 && $motivo3) {
                    $grid3 = array(
                        'id_nota'           => (int)$id_notasiguiente,
                        'codigo_producto'   => pSQL($codigo3),
                        'cantidad'          => (int)$cantidad3,
                        'precio'            => pSQL($precio3),
                        'id_motivo'         => (int)$motivo3,
                    );

                    $total = ($total) + ($cantidad3 * $precio3);
                    Db::getInstance()->insert('detalle_notacredito', $grid3);
                }

                if ($codigo4 && $cantidad4 && $precio4 && $motivo4) {
                    $grid4 = array(
                        'id_nota'           => (int)$id_notasiguiente,
                        'codigo_producto'   => pSQL($codigo4),
                        'cantidad'          => (int)$cantidad4,
                        'precio'            => pSQL($precio4),
                        'id_motivo'         => (int)$motivo4,
                    );

                    $total = ($total) + ($cantidad4 * $precio4);
                    Db::getInstance()->insert('detalle_notacredito', $grid4);
                }

                if ($codigo5 && $cantidad5 && $precio5 && $motivo5) {
                    $grid5 = array(
                        'id_nota'           => (int)$id_notasiguiente,
                        'codigo_producto'   => pSQL($codigo5),
                        'cantidad'          => (int)$cantidad5,
                        'precio'            => pSQL($precio5),
                        'id_motivo'         => (int)$motivo5,
                    );

                    $total = ($total) + ($cantidad5 * $precio5);
                    Db::getInstance()->insert('detalle_notacredito', $grid5);
                }

                Db::getInstance()->insert('notacredito', $insert_principal);
                header('location: '.$url_actual);

            } else {

                $error = "Debe Ingresar Los Campos Solicitados y al menos 1 producto";
                $this->context->smarty->assign('error', $error);
            }

        }
    }

    /* Funcion que crea el Template (Generica) */
    
    public function createTemplate($tpl_name) {
        if (file_exists($this->getTemplatePath() . $tpl_name) && $this->viewAccess())
                return $this->context->smarty->createTemplate($this->getTemplatePath() . $tpl_name, $this->context->smarty);
            return parent::createTemplate($tpl_name);
    }

    public function initContent(){
        parent::initContent();
        $this->processSelect();
        $this->processForm();
        $tpl = $this->createTemplate('content.tpl')->fetch();

    }
}

?>