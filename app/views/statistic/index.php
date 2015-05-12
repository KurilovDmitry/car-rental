
<div class="page-header">
    <h1><?php echo $data['title'] ?></h1>
</div>

<dl class="dl-horizontal">
    <dt style="width:240px">Общая прибыль</dt>
    <dd style="margin-left:240px"><?=$date['total_revenue'] ?></dd>

    <dt style="width:240px">Качество системы штрафов</dt>
    <dd style="margin-left:240px"><?=$date['fine_quality'] ?></dd>
</dl>