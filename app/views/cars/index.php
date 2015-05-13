<h1><?php echo $data['title'] ?></h1>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">Все</a></li>
        <li role="presentation"><a href="#popular" aria-controls="popular" role="tab" data-toggle="tab">Популярные</a></li>
        <li role="presentation"><a href="#rented" aria-controls="rented" role="tab" data-toggle="tab">В прокате</a></li>
        <li role="presentation"><a href="#not-rented" aria-controls="not-rented" role="tab" data-toggle="tab">Не в прокате</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="all">
            <?php printCars($data['all_cars']) ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="popular">
            <?php printCars($data['popular_cars']) ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="rented">
            <?php printCars($data['rented_cars']) ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="not-rented">
            <?php printCars($data['not_rented_cars']) ?>
        </div>
    </div>

</div>

<div class="row">
    <?php if ($_GET['error']) { ?>
        <p class="bg-danger" style="padding: 15px;"><?=$_GET['error'] ?></p>
    <?php } ?>
    <a href="#clientForm" data-toggle="collapse" class="btn btn-default">Добавить авто <span class="caret"></span></a>
    <div class="collapse" id="clientForm" style="margin-top:2em">
        <form action="/cars/add/" method="post">
            <div class="form-group">
                <label for="carModelInput">Модель авто</label>
                <select class="form-control" id="carModelInput" name="carModel">
                    <?php
                    foreach ($data['car_models'] as $c_model) {
                        echo '<option value="'.$c_model->ID.'">'.$c_model->MODEL.'</option>';
                    }
                    ?>
                </select>
            </div>

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
                <label for="priceInput">Цена</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="cost" id="priceInput" placeholder="сколько">
                    <div class="input-group-addon">$</div>
                </div>
            </div>

            <button type="submit" class="btn btn-danger">Добавить</button>
        </form>
    </div>
</div>

<?php
function printCars($array) {
    ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Модель</th>
            <th>Свойства</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($array as $customer)
        {
            echo '<tr>';
            echo '  <td>'.$customer->MODEL.'</td>';
            echo '  <td>'.$customer->PROPERTIES.'</td>';
            echo '  <td>'.$customer->COST.'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
<?php
}
?>