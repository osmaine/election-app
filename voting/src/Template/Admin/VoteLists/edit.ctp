<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoteList $voteList
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $voteList->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $voteList->ID)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Vote Lists'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<title><?= $this->fetch(__('Vote create')); ?></title>
<?php echo $this->Html->css(['bootstrap-datetimepicker', 'bootstrap1.min']) ?>
<?php echo $this->fetch('css') ?>

<style>
    .center-block {
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
</style>
<div class="jumbotron">
    <nav class="bg-success">


        <?= $this->Html->link(__('<= Retour'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

    </nav>
    <?= $this->Form->create($voteList) ?>
    <div class="card">
        <div class="card-header" style="background: #c0a16b; text-align: center">
            <strong><?= __('Calendrier électoral') ?></strong>
        </div>
        <div class="card-body" style="background: #1a2732;">
            <div class="">
                <?= $this->Flash->render() ?>
                <div class="form-group">

                    <div class="col-md-3 col-xs-12">
                        <label class=""
                               style="color: white; text-underline: #0b2e13"><?php echo __('Date de debut ') ?></label>
                        <div class='input-group date'>
                 <span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
                 </span>
                            <?php
                            $this->Form->setTemplates(['dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}']);
                            echo $this->Form->text('start_election', ['label' => 'Date de debut de vote', 'placeholder' => 'Start election', 'class' => 'form-control datetimepicker']); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3 col-xs-12">
                        <label class=""
                               style="color: white; text-underline: #0b2e13"><?php echo __('Date de fin ') ?></label>

                        <div class='input-group date'>
					 <span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
                            <?php
                            echo $this->Form->text('end_election', ['label' => 'Date de debut de vote', 'placeholder' => 'End election', 'class' => 'form-control datetimepicker']); ?>
                        </div>
                    </div>
                </div>
                <div
                    class="form-group"> <?= $this->Form->button(__('Valider'), ['class' => 'btn btn-outline-success']) ?></div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
    <?= $this->Form->end() ?>
</div>

<?php echo $this->Html->script(['jquery', 'phonejs/moment-with-locales', 'bootstrap-datetimepicker.min']) ?>
<?php echo $this->fetch('script') ?>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            format: 'DD-MM-YYYY  HH:mm:ss',
        });
    });
</script>

