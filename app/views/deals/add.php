<div class="row">
    <form action="/deals/add/" method="post">
        <input type="hidden" name="preference" value="<?=$data['preference']->ID ?>" />
        <div class="form-group">
            <label for="propertiesInput">Свойства</label>
            <select multiple class="form-control" id="propertiesInput" name="properties[]">
                <?php
                foreach ($data['car_properties'] as $c_property) {
                    echo '<option value="'.$c_property->ID.'">'.$c_property->DESCRIPTION.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="startDateInput">Дата начала</label>
            <input type="date" class="form-control" name="startDate" id="startDateInput" value="<?=$data['preference']->START_DATE ?>">
        </div>
        <div class="form-group">
            <label for="finishDateInput">Дата окончания</label>
            <input type="date" class="form-control" name="finishDate" id="finishDateInput" value="<?=$data['finishDate'] ?>">
        </div>
        <div class="form-group">
            <label for="customerSelect">Клиент</label>
            <select class="form-control" name="customer" id="customerSelect" value="<?=$data['preference']->CLIENT_ID ?>">
                <?php
                foreach ($data['customers'] as $customer) {
                    echo '<option value="'.$customer->ID.'">'.$customer->FIRST_NAME.' '.$customer->LAST_NAME.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="carSelect">Авто</label>
            <select class="form-control" name="car" id="carSelect">
                <?php
                    foreach ($data['cars'] as $car) {
                        echo '<option value="'.$car->ID.'">'.$car->MODEL.'</option>';
                    }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-danger">Добавить</button>
    </form>
</div>