<?php
    # @variables : $params
?>
<div style="background: white; width: 700px;margin: 0 auto;padding: 10px;margin-bottom: 20px">
    <br>
    <p align="center"><img src="<?= $message->embed($logo); ?>" width="180" height="54" alt=""/></p>
    <p style="font-size: 18px; text-align: center;"><?= Yii::$app->formatter->asDate(new DateTime(), 'd MMMM yyyy года в HH:mm') ?><br>
        Вы зарегистрировались на сайте <a href="<?=\Yii::$app->params["APP_DOMAIN"]?>" target="_blank">markup.datamist.ru</a></p>
    <hr width="500">
</div>
<table align="center" border="0" cellspacing="5" cellpadding="5" width="700" class="table-info">
        <tr>
            <td align="right" style="font-weight: 500;">Ваш логин</td>
            <td align="left" style="font-style: italic;"><?= isset($params["username"]) ? $params["username"] : ""?>
            </td>
        </tr>
        <tr>
            <td align="right" style="font-weight: 500;">Ваш пароль:</td>
            <td align="left" style="font-style: italic;"><?= isset($params["password"]) ? $params["password"] : ""?>
            </td>
        </tr>
        <tr>
            <td align="right" style="font-weight: 500;">Ваш email:</td>
            <td align="left" style="font-style: italic;"><?= isset($params["email"]) ? $params["email"] : ""?>
            </td>
        </tr>
</table>