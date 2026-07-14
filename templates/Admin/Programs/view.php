<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Program $program
 */
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa-solid fa-bars text-primary"></i>
			</button>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
							<li><?= $this->Html->link(__('Edit Program'), ['action' => 'edit', $program->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Program'), ['action' => 'delete', $program->id], ['confirm' => __('Are you sure you want to delete # {0}?', $program->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Programs'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Program'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
							</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-9">
		<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">
            <h3><?= h($program->name) ?></h3>
    <div class="table-responsive">
        <table class="table">
                <tr>
                    <th><?= __('Faculty') ?></th>
                    <td><?= $program->hasValue('faculty') ? $this->Html->link($program->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $program->faculty->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($program->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($program->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($program->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($program->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($program->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($program->modified) ?></td>
                </tr>
            </table>
            </div>

			</div>
		</div>
		

            
            

            <div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
            <div class="card-body text-body-secondary">
                <h4><?= __('Related Application') ?></h4>
                <?php if (!empty($program->application)) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Faculty Id') ?></th>
                            <th><?= __('Company Name') ?></th>
                            <th><?= __('Company Street1') ?></th>
                            <th><?= __('Company Street2') ?></th>
                            <th><?= __('Company Postcode') ?></th>
                            <th><?= __('Company City') ?></th>
                            <th><?= __('Company State') ?></th>
                            <th><?= __('Group Leader Name') ?></th>
                            <th><?= __('Group Leader Phone') ?></th>
                            <th><?= __('Group Leader Email') ?></th>
                            <th><?= __('Team Member') ?></th>
                            <th><?= __('Date Interview') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Method') ?></th>
                            <th><?= __('Approval Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($program->application as $application) : ?>
                        <tr>
                            <td><?= h($application->id) ?></td>
                            <td><?= h($application->user_id) ?></td>
                            <td><?= h($application->faculty_id) ?></td>
                            <td><?= h($application->company_name) ?></td>
                            <td><?= h($application->company_street1) ?></td>
                            <td><?= h($application->company_street2) ?></td>
                            <td><?= h($application->company_postcode) ?></td>
                            <td><?= h($application->company_city) ?></td>
                            <td><?= h($application->company_state) ?></td>
                            <td><?= h($application->group_leader_name) ?></td>
                            <td><?= h($application->group_leader_phone) ?></td>
                            <td><?= h($application->group_leader_email) ?></td>
                            <td><?= h($application->Team_member) ?></td>
                            <td><?= h($application->date_interview) ?></td>
                            <td><?= h($application->status) ?></td>
                            <td><?= h($application->method) ?></td>
                            <td><?= h($application->approval_status) ?></td>
                            <td><?= h($application->created) ?></td>
                            <td><?= h($application->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Application', 'action' => 'view', $application->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Application', 'action' => 'edit', $application->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Application', 'action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>

		
	</div>
	<div class="col-md-3">
	  Column
	</div>
</div>




