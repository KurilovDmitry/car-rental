
<div class="page-header">
    <h1><?php echo $data['title'] ?></h1>
</div>

<dl class="dl-horizontal">
    <dt style="width:240px">Общая прибыль</dt>
    <dd style="margin-left:280px">$<?=round($data['total_revenue'], 2) ?></dd>

    <dt style="width:240px">Обратилось после штрафа</dt>
    <dd style="margin-left:280px"><?=round($data['fine_quality_1'], 2) ?></dd>

    <dt style="width:240px">Только предупреждения</dt>
    <dd style="margin-left:280px"><?=round($data['fine_quality_2'], 2) ?></dd>

</dl>