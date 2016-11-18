<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="http://allfont.net/allfont.css?fonts=montserrat-light" rel="stylesheet" type="text/css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <?= $this->render(
        'header.php'
    ) ?>

    <?= Alert::widget() ?>

    <?= $content ?>

    <?= $this->render(
        'footer.php'
    ) ?>   
<script>
// (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
// (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
// m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
// })(window,document,'script',' https://www.google-analytics.com/analytics.js','ga');

// ga('create', 'UA-78699744-2', 'auto');
// ga('send', 'pageview');

</script>


<script>
/**
* Function that tracks a click on an outbound link in Analytics.
* This function takes a valid URL string as an argument, and uses that URL string
* as the event label. Setting the transport method to 'beacon' lets the hit be sent
* using 'navigator.sendBeacon' in browser that support it.
*/
var trackOutboundLink = function(casino, url, pos) {
   var label = pos ? (casino + ' : ' + pos)  : casino;
   // ga('send', 'event', 'outbound', 'visit_casino', label, {
   //   'transport': 'beacon',
   //   'hitCallback': function(){document.location = url;}
   // });
}
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
