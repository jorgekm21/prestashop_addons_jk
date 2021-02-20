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
                Nueva Nota de Credito
            </div>
            <form action="" method="POST" id="nota_credito-form">
                <div class="form-group">
                    <label for="">Cedula: </label>
                    <input  type="text" 
                            class="form-control"
                            name="cedula"
                            id="cedula"
                            placeholder="Introduzca Cedula de Representante"
                            required>
                </div>
                <div class="form-group">
                    <label for="">Campana: </label>
                    <select name="campana" 
                            id="campana">
                        {foreach from=$tienda item=rowtienda}
                        <option value="{$rowtienda.id_shop}">{$rowtienda.name}</option>
                        {/foreach}
                    </select>
                </div>
                <!-- Falta Campo Nombre -->
                <div class="form-group">
                    <label for="">Zona: </label>
                    <select name="zona" 
                            id="zona">
                        {foreach from=$zona item=rowzona}
                        <option value="{$rowzona.id_employee}">{$rowzona.CODIGOZONA}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sector: </label>
                    <select name="sector" 
                            id="sector">
                        {foreach from=$sector item=rowsector}
                        <option value="{$rowsector.id_sector}">{$rowsector.sector}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fecha: </label>
                    <input  type="date" 
                            name="fecha" 
                            id="fecha"
                            required>
                </div>
                <div class="form-group">
                    <label for="">Gerente: </label>
                    <select name="zonagerente" 
                            id="zonagerente">
                        {foreach from=$gerentezona item=rowgerentezona}
                        <option value="{$rowgerentezona.id_employee}">Gerente de Zona: {$rowgerentezona.CODIGOZONA}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="">N# de Nota: </label>
                    <input  type="text"
                            name="num_nota"
                            id="num_nota"
                            placeholder="N# de Nota de Credito"
                            required>
                </div>
                <div class="form-group">
                    <label for="">N# de Documento: </label>
                    <input  type="text"
                            name="num_doc"
                            id="num_doc"
                            placeholder="N# de Documento de Referencia a la Nota de Credito"
                            required>
                </div>
                <div class="form-group">
                    <label for="">Campana de Documento: </label>
                    <select name="camp_doc" 
                            id="camp_doc"
                            required>
                        <option value="">Campana del Documento de Referencia</option>
                        {foreach from=$tienda item=rowtienda}
                        <option value="{$rowtienda.id_shop}">{$rowtienda.name}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="">N# de Referencia: </label>
                    <input  type="text"
                            name="num_ref"
                            id="num_ref"
                            placeholder="Numero de Referencia"
                            required>
                </div>
                <div class="form-group">
                    <label for="">N# de Ajuste: </label>
                    <input  type="text"
                            name="num_ajust"
                            id="num_ajust"
                            placeholder="Numero de Ajuste de la Nota de Credito"
                            required>
                </div>
                <div class="form-group">
                    <center>
                    <table>
                        <!-- Cabecera -->
                        <tr>
                            <th class="text-center">Codigo Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Motivo</th>
                        </tr>
                        <!-- Producto 1 -->
                        <tr>
                            <td>
                                <input type="text" name="codigo1" id="codigo1">
                            </td>
                            <td>
                                <input type="text" name="cantidad1" id="cantidad1">
                            </td>
                            <td>
                                <input type="text" name="precio1" id="precio1">
                            </td>
                            <td><select name="motivo1" id="motivo1">
                                <option value=""></option>
                                {foreach from=$motivo item=rowmotivo}
                                <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                {/foreach}
                            </select></td>
                        </tr>
                        <!-- Producto 2 -->
                        <tr>
                            <td>
                                <input type="text" name="codigo2" id="codigo2">
                            </td>
                            <td>
                            <input type="text" name="cantidad2" id="cantidad2">
                            </td>
                            <td>
                                <input type="text" name="precio2" id="precio2">
                            </td>
                            <td>
                                <select name="motivo2" id="motivo2">
                                    <option value=""></option>
                                    {foreach from=$motivo item=rowmotivo}
                                    <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <!-- Producto 3 -->
                        <tr>
                            <td>
                                <input type="text" name="codigo3" id="codigo3">
                            </td>
                            <td>
                            <input type="text" name="cantidad3" id="cantidad3">
                            </td>
                            <td>
                                <input type="text" name="precio3" id="precio3">
                            </td>
                            <td>
                                <select name="motivo3" id="motivo4">
                                    <option value=""></option>
                                    {foreach from=$motivo item=rowmotivo}
                                    <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <!-- Producto 4 -->
                        <tr>
                            <td>
                                <input type="text" name="codigo4" id="codigo4">
                            </td>
                            <td>
                            <input type="text" name="cantidad4" id="cantidad4">
                            </td>
                            <td>
                                <input type="text" name="precio4" id="precio4">
                            </td>
                            <td>
                                <select name="motivo4" id="motivo4">
                                    <option value=""></option>
                                    {foreach from=$motivo item=rowmotivo}
                                    <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <!-- Producto 5 -->
                        <tr>
                            <td>
                                <input type="text" name="codigo5" id="codigo5">
                            </td>
                            <td>
                            <input type="text" name="cantidad5" id="cantidad5">
                            </td>
                            <td>
                                <input type="text" name="precio5" id="precio5">
                            </td>
                            <td>
                                <select name="motivo5" id="motivo5">
                                    <option value=""></option>
                                    {foreach from=$motivo item=rowmotivo}
                                    <option value="{$rowmotivo.id_motivo}">{$rowmotivo.sigla_motivo}: {$rowmotivo.descripcion}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                    </center>
                        <select name="id_nota" id="id_nota" style="display: none">
                            {foreach from=$id_nota item=rownota}
                            <option value="{$rownota.id_nota}">{$rownota.id_nota}</option>
                            {/foreach}
                        </select>
                    <div class="form-group" style="margin-top: 20px">
                    
                        <button type="reset" class="btn btn-danger col-xs-offset-2 col-xs-3">Cancelar</button>
                        <button type="submit" class="btn btn-success col-xs-3 col-xs-offset-2" name="boton" id="boton">Enviar</button>
                    
                    
                    </div>

                    {if $error eq "Debe Ingresar Los Campos Solicitados y al menos 1 producto"}
                    {/if}

                </div>
            </form>
        </div>
    </div>
</div>
