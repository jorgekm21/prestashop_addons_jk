<?php
require_once 'CustomObjectModel.php';

class ContractsModel extends ContractsCustomObjectModel
{

    /* Definicion de la tabla contracts */
    public static $definition = [
        'table'     => 'contracts',
        'primary'   => 'id_contracts',
        'multilang' => true,      
        'fields'    => ['id_contracts'      => ['type' => self::TYPE_INT, 'validate' => 'isInt'],
                        /* Seccion del contrato */
                        'id_tienda'         => ['type'  => self::TYPE_INT,      'db_type'   => 'int'],
                        'id_zona'           => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(100)'],
                        'id_seccion'        => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(100)'],
                        'id_sector'         => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(10)', 'validate' => 'isInt'],
                        'cedula'            => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(10)', 'validate' => 'isInt'],
                        'nombre'            => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(100)', 'validate' => 'isName'],
                        'apellido'          => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(100)', 'validate' => 'isName'],
                        'fecha_natal'       => ['type'  => self::TYPE_DATE,     'db_type'   => 'datetime'],
                        'telefono'          => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(13)', 'validate' => 'isPhoneNumber'],
                        'email'             => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(255)', 'validate' => 'isEmail'],
                        'direccion'         => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(255)'],
                        'contrato'          => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(50)', 'validate'   => 'isInt'],
                        /* Seccion de Indicacion */
                        'fecha_indicacion'  => ['type'  => self::TYPE_DATE,     'db_type'   => 'datetime'],
                        'cedula_indicacion' => ['type'  => self::TYPE_STRING,   'db_type'   => 'varchar(10)', 'validate' => 'isInt'],

                        ],
    ];

    public $id_contracts;
    public $id_tienda;
    public $id_zona;
    public $id_seccion;
    public $id_sector;
    public $id_empleado;
    public $id_comisionista;
    public $cedula;
    public $nombre;
    public $apellido;
    public $fecha_natal;
    public $telefono;
    public $email;
    public $direccion;
    public $contrato;
    public $fecha_indicacion;
    public $cedula_indicacion;



}
