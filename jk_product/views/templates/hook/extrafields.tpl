<div class="mb-1 mt-1">
    <h2>Additional Fields</h2>

    <fieldset class="form-group">
        <div class="col-lg-12 col-xl-4">
            <label class="form-control-label">Campo Adicional</label>
            <input type="text" name="additional_field" class="form-control" {if $additional_field && $additional_field != ''}value="{$additional_field}"{/if}>
        </div>
    </fieldset>
</div>