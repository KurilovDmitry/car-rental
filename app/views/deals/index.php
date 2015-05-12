<div class="row">
    <div class="col-md-6">
        <h2>Заказы</h2>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата</th>
                        <th>Период (дней)</th>
                        <th>Свойства</th>
                        <th>Клиент</th>
                        <th>Сделка</th>
                    </tr>
                </thead>
                <?php
                foreach($data['preferences'] as $preference) {
                    echo '<tr>';
                    echo '<td>'.$preference['ID'].'</td>';
                    echo '<td>'.$preference['START_DATE'].'</td>';
                    echo '<td>'.$preference['RENT_DURATION'].'</td>';
                    echo '<td>'.$preference['PROPERTIES'].'</td>';
                    echo '<td>'.$preference['Client_FirstName'].' '.$preference['Client_LastName'].'</td>';
                    echo '<td>';
                    if ($preference['DEAL_ID'] == NULL) {
                        echo '<a href="/deals/add/?preference='.$preference['ID'].'" class="btn btn-success">Доб.сделку</a>';
                    }
                    else {
                        echo $preference['Deal_Id'];
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>

        <div class="row">
            <a href="#dealForm" data-toggle="collapse" class="btn btn-default">Новый заказ <span class="caret"></span></a>
            <div class="collapse" id="dealForm" style="margin-top:2em">
                <form action="/deals/addPreference/" method="post">
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
                        <label for="carInput">Модель авто</label>
                        <select multiple class="form-control" id="carInput" name="carModels[]">
                            <?php
                            foreach ($data['car_models'] as $c_model) {
                                echo '<option value="'.$c_model->ID.'">'.$c_model->MODEL.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="startDateInput">Дата начала</label>
                        <input type="date" class="form-control" name="startDate" id="startDateInput" placeholder="день.месяц.год">
                    </div>
                    <div class="form-group">
                        <label for="rentDurationInput">Длительность</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="duration" id="rentDurationInput" placeholder="сколько">
                            <div class="input-group-addon">дней</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customerSelect">Клиент</label>
                        <select class="form-control" name="customer" id="customerSelect">
                            <?php
                            foreach ($data['customers'] as $customer) {
                                echo '<option value="'.$customer->ID.'">'.$customer->FIRST_NAME.' '.$customer->LAST_NAME.'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-danger">Добавить</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <h2>Сделки</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Начало проката</th>
                <th>Конец проката</th>
                <th>Заказ</th>
            </tr>
            </thead>
            <?php
            foreach($data['deals'] as $deal) {
                echo '<tr>';
                echo '<td>'.$deal->ID.'</td>';
                echo '<td>'.$deal->START_DATE.'</td>';
                echo '<td>'.$deal->FINISH_DATE.'</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>