<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
echo $this->Html->css('css/all.min.css');
?>

<style>
    .alert {
        padding: 10px;
        background-color: #1c7430;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: red;
    }
</style>


<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <i class="fa fa-hand-peace"></i><?= $message ?>
</div>
