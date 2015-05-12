<h1><?php echo $data['title'] ?></h1>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">Все</a></li>
        <li role="presentation"><a href="#regular" aria-controls="regular" role="tab" data-toggle="tab">Постоянные</a></li>
        <li role="presentation"><a href="#most-profitable" aria-controls="most-profitable" role="tab" data-toggle="tab">Прибыльные</a></li>
        <li role="presentation"><a href="#most-profitable" aria-controls="most-profitable" role="tab" data-toggle="tab">Прибыльные</a></li>
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
    <a href="#clientForm" data-toggle="collapse" class="btn btn-default">Добавить клиента <span class="caret"></span></a>
    <div class="collapse" id="clientForm" style="margin-top:2em">
        <form action="/clients/add/" method="post">
            <div class="form-group">
                <label for="firstName">Имя</label>
                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="имя">
            </div>
            <div class="form-group">
                <label for="lastName">Фамилия</label>
                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="фамилия">
            </div>
            <div class="form-group">
                <label for="middleName">Отчество</label>
                <input type="text" class="form-control" name="middleName" id="middleName" placeholder="отчество">
            </div>

            <div class="form-group">
                <label for="passport">Паспортные данные</label>
                <textarea class="form-control" rows="4" name="passport" id="passport">
                </textarea>
            </div>

            <div class="form-group">
                <label for="phoneNumber">Телефон</label>
                <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="+7 () ">
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
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Паспортные данные</th>
            <th>Телефон</th>
            <th>Скидка</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($array as $customer)
        {
            echo '<tr>';
            echo '  <td>'.$customer->FIRST_NAME.'</td>';
            echo '  <td>'.$customer->LAST_NAME.'</td>';
            echo '  <td>'.$customer->MIDDLE_NAME.'</td>';
            echo '  <td>'.$customer->PASSPORT.'</td>';
            echo '  <td>'.$customer->PHONE_NUMBER.'</td>';
            echo '  <td>'.$customer->DISCOUNT.'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
<?php
}
?>