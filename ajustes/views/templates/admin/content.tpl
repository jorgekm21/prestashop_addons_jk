{*
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
*}

<div class="row">
    <div class="col-lg-12">
        <div class="form-horizontal panel">
            <div class="panel-heading">
                <i class="icon-user"></i>
                Cargar Nuevo Ajuste
            </div>
            <form action="" method="POST" id="nuevoajuste">
                <div class="form-group">
                    <label for="">Campana Actual: </label>
                    <select name="camp_actual" id="">
                        {foreach from=$campana_actual item=campana}
                        <option value="{$campana.id_shop}">{$campana.name}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Cedula Representante: </label>
                    <input type="text" name="ced_rep" required placeholder="Introduzca la cedula de la representante">
                </div>
                <div class="form-group">
                    <label for="">Zona: </label>
                    <select name="zone" id="">
                        {foreach from=$zona item=zona_select}
                        <option value="{$zona_select.ID_ZONA}">{$zona_select.CODIGOZONA}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for=""># de Factura: </label>
                    <input type="text" placeholder="Introduzca el numero de factura" name="factura" required>
                </div>
                <div class="form-group">
                    <label for=""># de Ajuste: </label>
                    <input type="text" placeholder="Introduzca el numero de ajuste" name="num_ajust" required>
                </div>
                <div class="form-group">
                    <label for="">Campana a Ajustar: </label>
                    <select name="camp_ajust" id="" required>
                        <option value="">Seleccione la Campana de la Factura</option>
                        {foreach from=$campana_ajuste item=rowcampana}
                        <option value="{$rowcampana.id_shop}">{$rowcampana.name}</option>
                        {/foreach}
                    </select>
                </div>

                <!-- GRID -->

                <center>
                <table>
                    <tr>   
                        <p><b>PRODUCTOS FACTURADOS</b></p>
                    </br>
                        <th class="text-center">Codigo de Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio Unitario</th>
                        <th class="text-center">Motivo</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="producto1">
                        </td>
                        <td>
                            <input type="text" name="cantidad1">
                        </td>
                        <td>
                            <input type="text" name="precio1">
                        </td>
                        <td>
                            <select name="idmotivo1" id="">
                                <option value=""></option>
                                 {foreach from=$motivo item=rowmotivo}
                                <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="producto2">
                        </td>
                        <td>
                            <input type="text" name="cantidad2">
                        </td>
                        <td>
                            <input type="text" name="precio2">
                        </td>
                        <td>
                            <select name="idmotivo2" id="">
                                <option value=""></option>
                                {foreach from=$motivo item=rowmotivo}
                                <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="producto3">
                        </td>
                        <td>
                            <input type="text" name="cantidad3">
                        </td>
                        <td>
                            <input type="text" name="precio3">
                        </td>
                        <td>
                            <select name="idmotivo3" id="">
                                <option value=""></option>
                                {foreach from=$motivo item=rowmotivo}
                                <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="producto4">
                        </td>
                        <td>
                            <input type="text" name="cantidad4">
                        </td>
                        <td>
                            <input type="text" name="precio4">
                        </td>
                        <td>
                            <select name="idmotivo4" id="">
                                <option value=""></option>
                                {foreach from=$motivo item=rowmotivo}
                                <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="producto5">
                        </td>
                        <td>
                            <input type="text" name="cantidad5">
                        </td>
                        <td>
                            <input type="text" name="precio5">
                        </td>
                        <td>
                            <select name="idmotivo5" id="">
                                <option value=""></option>
                                {foreach from=$motivo item=rowmotivo}
                                <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                </center>

                <center>
                <table>
                    <tr>   
                        <p style="margin-top: 20px"><b>PRODUCTOS CAMBIO</b></p>
                    </br>
                        <th class="text-center">Codigo de Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio Unitario</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="productod1">
                        </td>
                        <td>
                            <input type="text" name="cantidadd1">
                        </td>
                        <td>
                            <input type="text" name="preciod1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="productod2">
                        </td>
                        <td>
                            <input type="text" name="cantidadd2">
                        </td>
                        <td>
                            <input type="text" name="preciod2">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="productod3">
                        </td>
                        <td>
                            <input type="text" name="cantidadd3">
                        </td>
                        <td>
                            <input type="text" name="preciod3">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="productod4">
                        </td>
                        <td>
                            <input type="text" name="cantidadd4">
                        </td>
                        <td>
                            <input type="text" name="preciod4">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="productod5">
                        </td>
                        <td>
                            <input type="text" name="cantidadd5">
                        </td>
                        <td>
                            <input type="text" name="preciod5">
                        </td>
                    </tr>
                </table>
                </center>
                <div class="form-group" style="display: none">
                    <select name="id_nota" id="">
                        {foreach from=$id_nota item=nota}
                        <option value="{$nota.id_ajustes}">Hola</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group" style="margin-top: 20px">
                
                    <button type="reset" class="btn btn-danger col-xs-offset-2 col-xs-3">Cancelar</button>
                    <button type="submit" class="btn btn-success col-xs-3 col-xs-offset-2" name="boton" id="boton">Enviar</button>
                
                
                </div>
            </form>

            {if $error eq "Debe Ingresar Los Campos Solicitados y al menos 1 producto"}
            {/if}
            
        </div>
    </div>
</div>