<?php
    
 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
if (!defined('_PS_VERSION_')){
{
  exit;
    }
}

class contracts extends Module{
    
    public $models = ['ContractsModel'];
    
    protected $tabs = [
        [
            'name'      => 'Nuevos Contratos',
            'className' => 'AdminContractsModels',
            'active'    => 1,
            //submenus
            'childs'    => [
                [
                    'active'    => 1,
                    'name'      => 'Nuevos Contratos',
                    'className' => 'AdminContractsModels',
                ],
            ],
        ],
    ];
    
    public function __construct()
  {
    $this->name = 'contracts';
    $this->version = '1.0.1';
   
    //module category
    $this->tab = 'shipping_logistic';
    
    $this->author = 'Corcaribe Tecnologia C.A';
    $this->author_uri = 'http://www.corcaribe.com/';
    //$this->need_instance = 0;
    
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.7.2.2');
//    $this->bootstrap = true;

    

    $this->displayName = $this->l('Contratos - Nuevo Contrato');
    $this->description = $this->l('Modulo para el Manejo de Contratos Jade');

//    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    
    parent::__construct();
    //$this->templateFile = 'module:contracts/contratcs.tpl';

    if (!Configuration::get('contracts'))
      $this->warning = $this->l('No existe el módulo');
    
    //parent::__construct();
  }
  // Function to addtab in the Backoffice Menu
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

            //tab text in each language
            foreach (Language::getLanguages(true) as $lang)
            {
                $tabModel->name[$lang['id_lang']] = $tab['name'];
            }

            $tabModel->add();

            //submenus of the tab
            if (isset($tab['childs']) && is_array($tab['childs']))
            {
                $this->addTab($tab['childs'], Tab::getIdFromClassName($tab['className']));
            }
        }
        return true;
    }
  
    //remove a tab and its childrens from the backoffice menu
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
        foreach ($this->models as $model)
        {
        	require_once 'classes/' . $model . '.php';
            //instantiate the module
            $modelInstance = new $model();

            //create the table relative to this model in the database
            //if the table does not exists yet
            $modelInstance->createDatabase();

            //if the table already exists, add to it any column that may be missing.
            //this is useful in the case of new updates that require new columns
            //to exist in the table.
            $modelInstance->createMissingColumns();
        }

        //module installation
        $success = parent::install();

        //if the installation fails, return error
        if (!$success)
        {
            return false;
        }

        //create the tabs in the backoffice menu
        $this->addTab($this->tabs);

        return true;
    }

     
    public function uninstall(){
        $this->removeTab($this->tabs);
        return parent::uninstall();
    }
}