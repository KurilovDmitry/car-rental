<div class="row">
    <div class="col-md-6">
        <h2>Заказы</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Дата</th>
                    <th>Период</th>
                    <th>Свойства</th>
                    <th>Клиент</th>
                    <th>Сделка</th>
                </tr>
            </thead>
            <?php
            foreach($data['preferences'] as $preference) {
                echo '<tr>';
                echo '<td>'.$preference['Id'].'</td>';
                echo '<td>'.$preference['StartDate'].'</td>';
                echo '<td>'.$preference['RentDuration'].'</td>';
                echo '<td>'.$preference['Properties'].'</td>';
                echo '<td>'.$preference['Client_FirstName'].' '.$preference['Client_LastName'].'</td>';
                echo '<td>';
                if ($preference['Deal_Id'] == NULL) {
                    echo '<a href="#" class="btn btn-success">Доб.сделку</a>';
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

    <div class="col-md-6">
        <h2>Сделки</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Начало проеката</th>
                <th>Конец проката</th>
                <th># предпочтения</th>
            </tr>
            </thead>
            <?php
            foreach($data['deals'] as $deal) {
                echo '<tr>';
                echo '<td>'.$preference['ID'].'</td>';
                echo '<td>'.$preference['StartDate'].'</td>';
                echo '<td>'.$preference['RentDuration'].'</td>';
                echo '<td>'.$preference['Client_FirstName'].' '.$preference['Client_LastName'].'</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>