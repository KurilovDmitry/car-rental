<div class="row">
    <div class="col-md-6">
        <h2>Заказы</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Дата</th>
                    <th>Период</th>
                    <th>Клиент</th>
                </tr>
            </thead>
            <?php
            foreach($data['preferences'] as $preference) {
                echo '<tr>';
                echo '<td>'.$preference['id'].'</td>';
                echo '<td>'.$preference['StartDate'].'</td>';
                echo '<td>'.$preference['RentDuration'].'</td>';
                echo '<td>'.$preference['Client_FirstName'].' '.$preference['Client_LastName'].'</td>';
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
                <th>Дата</th>
                <th>Период</th>
                <th>Клиент</th>
            </tr>
            </thead>
            <?php
            foreach($data['deals'] as $deal) {
                echo '<tr>';
                echo '<td>'.$preference['id'].'</td>';
                echo '<td>'.$preference['StartDate'].'</td>';
                echo '<td>'.$preference['RentDuration'].'</td>';
                echo '<td>'.$preference['Client_FirstName'].' '.$preference['Client_LastName'].'</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <?php
        foreach($data['deals'] as $deal) {

        }
        ?>
    </div>
</div>