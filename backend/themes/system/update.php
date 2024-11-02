<?php
use yii\helpers\Url;

$this->title = Yii::t('backend', 'Update');
?>
<ul class="nav nav-pills">
    <li>
        <a href="<?= Url::to(['/system']) ?>">
            <i class="fa fa-chevron-left font-12"></i>
            <?= Yii::t('backend', 'Back') ?>
        </a>
    </li>
</ul>
<br>

<pre>
<?= $result ?>
</pre>
