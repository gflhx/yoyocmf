<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/13
 * Time: 9:15 PM
 */

?>
<div class="btn-group">
    <input value="<?= $defaultValue?$defaultValue:"far fa-circle" ?>" name="<?=$inputName?>" id="<?= $inputId ?>" type="hidden">
    <button type="button" class="btn btn-default iconpicker-component"><i
                class="<?= $defaultValue?$defaultValue:"far fa-circle" ?>"></i></button>
    <button type="button" id="<?= $divId ?>" class="icp btn btn-default dropdown-toggle"
            data-selected="fa-car" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu"></div>
</div>