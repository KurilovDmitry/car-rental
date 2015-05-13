
<div class="page-header">
    <h1><?php echo $data['title'] ?></h1>
</div>

<dl class="dl-horizontal">
    <dt style="width:240px">Итоговая стоимость</dt>
    <dd style="margin-left:280px"><?=$data['totalPayment'] ?></dd>

    <?php if ($data['fine']) { ?>
    <dt style="width:240px">Размер штрафа</dt>
    <dd style="margin-left:280px"><?=$data['fine'] ?></dd>
    <?php } ?>
</dl>