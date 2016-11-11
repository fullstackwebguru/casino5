<?php 

use yii\helpers\Url;
?>

<div class="side-wrapp-1 ">
    <p class="side-title-1 "><?= $side_title?></p>
    <table class="table table-condensed ">
        <tbody>
            <?php 
            
            $cateIndex = 0;
            foreach ($categories as$category) { 
                $cateIndex ++;
            ?>
            <tr>
                <td class="<?= $cateIndex == 1 ? 'first-categ' : 'categ' ?>">
                    <a href="<?=Url::toRoute($category->getRoute())?>" class="side-categ"><img src="/images/arrow.jpg " alt="arrow "> <?= $category->short_title ?></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>