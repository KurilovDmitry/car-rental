<div class="page-header">
    <h2>Возврат автомобиля</h2>
</div>

<div class="row">
    <form action="/deals/carReturned/" method="post">
        <input type="hidden" name="dealId" value="<?=$data['dealId'] ?>" />
        <div class="form-group">
            <label for="fineType">Тип штрафа</label>
            <select type="date" class="form-control" name="fineType" id="fineType">
                <option value="0">Нет штрафа</option>
                <option value="1">Предупреждение</option>
                <option value="2">Штраф за нарушение сроков</option>
                <option value="3">Штраф за ущерб:
                    <input type="number" name="damageFineValue" value="100" />
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-default">ОК</button>
    </form>
</div>