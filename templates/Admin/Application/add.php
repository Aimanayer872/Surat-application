<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Application $applicationEntity
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $programs
 * @var \Cake\Collection\CollectionInterface|string[] $faculties
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
            <?= $this->Html->link(__('List Application'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($applicationEntity) ?>
            <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('program_id', ['options' => $programs, 
                        'empty' => '---select program----',
                        'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('faculty_id', ['options' => $faculties, 
                        'empty' => 'select faculty',
                        'class' => 'form-control']); ?>
                    </div>
                </div>

            <div class="card-title mb-0 mt-3">Company Detail</div>
            <div class="tricolor_line mb-3"></div>
                 <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->Form->control('company_name'); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('company_street1'); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('company_street2'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('company_postcode'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('company_city'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('company_state',
                        [
                            'option'=>
                            [
                                'Johor'=>'Johor',
                                'Kedah' => 'Kedah',
                                'Kelantan' => 'Kelantan',
                                'Melaka' => 'Melaka',
                                'Negeri Sembilan' => 'Negeri Sembilan',
                                'Pahang' => 'Pahang',
                                'Penang' => 'Penang',
                                'Perak' => 'Perak',
                                'Perlis' => 'Perlis',
                                'Sabah' => 'Sabah',
                                'Sarawak' => 'Sarawak',
                                'Selangor' => 'Selangor',
                                'Terengganu' => 'Terengganu',
                                'Wp Kuala Lumpur' => 'Wp Kuala Lumpur',
                                'Wp Labuan' => 'Wp Labuan',
                                'Wp Putrajaya' => 'Wp Putrajaya',
                            ],
                            'empty'=>'---select state---',
                            'class' =>'form-control', 
                            'label'=> 'Company State'        
                        ]
                        ); ?>
                    </div>
                </div>

                
            <div class="card-title mb-0 mt-3">Student Details</div>
            <div class="tricolor_line mb-3"></div>
                <div class="row">
                    <div class="col-md-9">
                        <?php echo $this->Form->control('group_leader_name'); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('Team_member'); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('group_leader_phone',['label'=>'Phone Number']); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('group_leader_email',['label'=>'Email']); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('date_interview',['label'=>'Date/Time']); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('ref_no'); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('method'); ?>
                    </div>

                    <div class="col-md-3">
                        <?php echo $this->Form->control('approval_status',[
                            'options'=> ['approve'=>'approve','pending'=>'pending','Rejected'=>'Rejected'],
                            'empty'=>'---select---',
                            'class' =>'form-control', 
                            'label'=> 'Status']); ?>
                    </div>

                </div>
                
                    
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
                </div>
        <?= $this->Form->end() ?>
    </div>
</div>