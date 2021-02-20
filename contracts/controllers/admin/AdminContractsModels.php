<?php

require_once _PS_MODULE_DIR_ . 'contracts/classes/ContractsModel.php';
class AdminContractsModelsController extends ModuleAdminController
{
    
    public function __construct()
    {
        $this->bootstrap  = true;
        $this->table      = 'contracts';
        $this->identifier = 'id_contracts';
        $this->className  = 'ContractsModel';
        
        parent::__construct();

        $id_lang = $this->context->language->id;
        
        $this->_join .= ' LEFT JOIN '._DB_PREFIX_.'contracts_lang b ON (b.id_contracts = a.id_contracts AND b.id_lang = '. $id_lang. ')';
        $this->fields_list  = [
            'id_contracts'  => ['title' => $this->l('ID'), 'type'           => 'text', 'align' => 'center', 'class' => 'fixed-width-xs'],
            'cedula'        => ['title' => $this->l('Cedula'), 'type' => 'text'],
            'apellido'      => ['title' => $this->l('Apellido'), 'type' => 'text'],
            'nombre'        => ['title' => $this->l('Nombre'), 'type' => 'text'],
            'telefono'      => ['title' => $this->l('Telefono'), 'type' => 'text'],
            'email'         => ['title' => $this->l('Correo Electronico'), 'type' => 'text'],
            ];

        $this->actions = ['edit', 'delete'];

        $this->bulk_actions = array(
            'delete' => array(
                'text'    => $this->l('Delete selected'),
                'icon'    => 'icon-trash',
                'confirm' => $this->l('Delete selected items?'),
            ),
        );
   
        $id_empleado    = $this->context->employee->id;        
        $query          = 'SELECT ID_ZONA as ID_ZONA, CODIGOZONA AS CODIGOZONA FROM `'._DB_PREFIX_.'zonas` where `id_employee`='.$id_empleado;
        $zonas          = Db::getInstance()->query($query);
        $query_campana  = 'SELECT id_shop AS id_campana, name AS campana FROM `'._DB_PREFIX_.'shop` WHERE `id_shop`>=2';
        $campana        = Db::getInstance()->query($query_campana);
        $query_seccion  = 'SELECT COD_SECCION, NOMBRESECCIONES FROM `'._DB_PREFIX_.'secciones` INNER JOIN `'._DB_PREFIX_.'zonas` ON `'._DB_PREFIX_.'secciones`.`id_zona`=`'._DB_PREFIX_.'zonas`.`id_zona` WHERE `'._DB_PREFIX_.'zonas`.`id_employee`='.$id_empleado;
        $seccion        = Db::getInstance()->query($query_seccion);
        $query_sector   = 'SELECT id_sector, sector FROM `'._DB_PREFIX_.'sector` INNER JOIN `'._DB_PREFIX_.'zonas` ON `'._DB_PREFIX_.'sector`.`id_zona`=`'._DB_PREFIX_.'zonas`.`id_zona` WHERE `'._DB_PREFIX_.'zonas`.`id_employee`='.$id_empleado;
        $sector         = Db::getInstance()->query($query_sector);


   //Este código creaba el formulario con los selects que no guardaban

            $this->fields_form = [

            'legend' => ['title'                => $this->l('Nuevo Contrato')],
            'input'  => ['id_tienda'            => ['type' => 'select','label'      => $this->l('Campana'),'name' => 'id_tienda', 'required' => true, 'options' =>array('query'=>$campana, 'id' => 'id_campana', 'name' => 'campana')],
                         'id_zona'              => ['type' => 'select', 'label'     => $this->l('Zona'),'name' => 'id_zona', 'required' => true, 'options' =>array('query' => $zonas, 'id' => 'ID_ZONA', 'name' => 'CODIGOZONA')], 
                         'id_seccion'           => ['type' => 'select', 'label'     => $this->l('Seccion'),'name' => 'id_seccion', 'hint' => $this->l('Seleccione la Seccion de la nueva representante'), 'options' =>array('query' =>$seccion, 'id' => 'COD_SECCION', 'name' => 'NOMBRESECCIONES')],
                         'id_sector'            => ['type' => 'select', 'label'     => $this->l('Sector'),'name' => 'id_sector', 'hint' => $this->l('Seleccione el Sector de la nueva representante'), 'options' =>array('query' =>$sector, 'id' => 'id_sector', 'name' => 'sector')],
                         'cedula'               => ['type' => 'text', 'label'       => $this->l('Cedula'),'name' => 'cedula', 'hint' => $this->l('Introduzca el numero de cedula de la nueva representante'), 'required' => true],
                         'nombre'               => ['type' => 'text', 'label'       => $this->l('Nombre'),'name' => 'nombre', 'hint' => $this->l('Introduzca el primer nombre de la nueva representante'), 'required' => true],
                         'apellido'             => ['type' => 'text', 'label'       => $this->l('Apellido'), 'name' => 'apellido', 'hint' => $this->l('Introduzca el primer apellido de la nueva representante'), 'required' => true],
                         'fecha_natal'          => ['type' => 'date', 'label'       => $this->l('Fecha de Nacimiento'),'name' => 'fecha_natal', 'hint' => $this->l('Seleccione la fecha de nacimiento de la nueva representante'), 'required' => true],
                         'telefono'             => ['type' => 'text', 'label'       => $this->l('Telefono'),'name' => 'telefono', 'hint' => $this->l('Introduzca un numero de telefono con el que se pueda localizar a la nueva representante'), 'required' => true],
                         'email'                => ['type' => 'text', 'label'       => $this->l('Correo Electronico'),'name' => 'email', 'hint' => $this->l('Introduzca el correo electronico de la nueva representante'), 'required' => true],
                         'direccion'            => ['type' => 'text', 'label'       => $this->l('Direccion'),'name' => 'direccion', 'hint' => $this->l('Introduzca la direccion de la nueva representante'), 'required' => true],
                         'contrato'             => ['type' => 'text', 'label'       => $this->l('Numero de Contrato'), 'name' => 'contrato', 'hint' => $this->l('Introduzca el numero de contrato de la nueva representante'), 'required' => true],
                         'fecha_indicacion'     => ['type' => 'date', 'label'       => $this->l('Fecha de Indicacion'),'name' => 'fecha_indicacion', 'hint' => $this->l('Si es indicada, Indique la fecha en la que se realizo la indicacion')],
                         'cedula_indicacion'    => ['type' => 'text', 'label'       => $this->l('Cedula quien indica'),'name' => 'cedula_indicacion', 'hint' => $this->l('Si es indicada, Indique la cedula de la persona que realizo la indicacion')],
            ],
                         'submit'               => ['title' => $this->l('Save'), 'name'=>'save'],
        ];
       
        
    }


    
    public function initContent()
    {
        parent::initContent();
       
    }   

}
?>