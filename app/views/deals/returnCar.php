<div class="page-header">
    <h2>Возврат автомобиля</h2>
</div>

<div class="row">
    <form action="/deals/returned/" method="post">
        <input type="hidden" name="dealId" value="<?=$data['dealId'] ?>" />
        <div class="radio">
            <label>
                <input type="radio" name="fineType" value="0" checked>
                Нет штрафа
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="fineType" value="1">
                Предупреждение
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="fineType" value="2">
                Штраф за нарушение сроков
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="fineType" value="3">
                Штраф за ущерб:
                <input type="number" name="damageFineValue" value="100" />
            </label>
        </div>

        <button type="submit" class="btn btn-default">ОК</button>
    </form>
</div>