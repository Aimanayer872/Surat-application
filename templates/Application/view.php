<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Application $applicationEntity
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
							<li><?= $this->Html->link(__('Edit Application'), ['action' => 'edit', $applicationEntity->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Application'), ['action' => 'delete', $applicationEntity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicationEntity->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Application'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Application'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
							</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-8">
		<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">

<style>
    .top {
        width: 100%;
        margin:auto;
    }
    .one{
        width: 70%;
        height:25px;
        background:#292983;
        float:left;
    }
    .two{
        margin-left:15%;
        height:25px;
        background:#912891;

    }
    .capital
    {
        text-transform:uppercase;
    }
    .justify{
        text-align:justify;
    }

</style>

<section class ="top">
    <div class="one"></div>
    <div class="two"></div>
</section>

<div class="text-end my-4 me-5">
    <?php echo $this->Html->image('../img/gambar/logouitm.png',['width'=>'220px']) ?>
</div>

<hr />

<table width='100%'>
    <tr>
        <td width='80%' class="text-end">Ref Number  &nbsp;: &nbsp;</td>
        <td>
            <?php if ($applicationEntity->approval_status==0){
                echo '-';
            }elseif ($applicationEntity->approval_status==1){
                echo $applicationEntity->ref_no;
            } else
            echo 'Rejected'
            ?>
        </td>
    </tr>
    <tr>
        <td class="text-end">Tarikh: &nbsp;: &nbsp;</td>
        <td>
             <?php if ($applicationEntity->approval_status==0){
                echo '-';
            }elseif ($applicationEntity->approval_status==1){
                echo date ('d F Y',strtotime($applicationEntity->id));
            } else
            echo 'Rejected'
            ?>
        </td>
    </tr>
</table>

        <?= h($applicationEntity->company_name) ?> <br />
        <?= h($applicationEntity->company_street1) ?> <br />
        <?= h($applicationEntity->company_street2) ?> <br />
        <?= h($applicationEntity->company_postcode) ?> <br />
        <?= h($applicationEntity->company_city) ?> <br />
        <strong><?= h($applicationEntity->company_state)?></strong>
        <br /> <br />
        <table class="table table-bordered  table-sm capital table_transparent">
            <tr>
                <td>NAMA PELAJAR</td>
                <td>:</td>
                <td><?= h($applicationEntity->user->fullname) ?></td>
            </tr>
            <tr>
                <td>FACULTY</td>
                <td>:</td>
                <td><?= h($applicationEntity->faculty->name) ?></td>
            </tr>
            <tr>
                <td>PROGRAM</td>
                <td>:</td>
                <td><?= h($applicationEntity->program->name) ?></td>
            </tr>
            <tr>
                <td>EMAIL</td>
                <td>:</td>
                <td><?= h($applicationEntity->group_leader_email) ?></td>
            </tr>
            <tr><td>PHONE</td>
                <td>:</td>
                <td><?= h($applicationEntity->group_leader_phone) ?></td></tr>
            <tr>
                <td>GROUP MEMBER</td>
                <td>:</td>
                <td><?= h($applicationEntity->Team_member) ?></td>
            </tr>
        </table>
        <br />
        <strong>PERMOHONANAN SESI TEMUBUAL UNTUK MENJALANKAN KAJIAN</strong>
        <br /><br/>
        <div class="justify">
            Dengan segala hormatnya saya merujuk kepada perkara di atas.
            <br /><br />
            2. &nbsp;&nbsp;&nbsp;&nbsp; Sukacita Dimaklumkan bahawa kami seramai <?php echo ($applicationEntity->Team_member) ?> orang,Pelajar daripada Program Kode <?php echo($applicationEntity->program->code) ?> <strong><?php echo($applicationEntity->program->name) ?></strong> ingin Mejalankan satu kajian dalam bentuk Sesi TemuBual di <strong><?php echo ($applicationEntity->company_name)?></strong> secara <?php echo ($applicationEntity->method)?>  bagi menyiapkan Tugasan yang telah Diberi.Pada tarikh <strong><?php echo date('d F Y',strtotime($applicationEntity->date_interview))?></strong>(tertakluk kepada perubahan dan cuti mingguan organisasi).
            <br /><br />
             3. &nbsp;&nbsp;&nbsp;&nbsp; Di samping itu, kami memohon jasa baik pihak Tuan/puan untuk membenarkan kami merakam sesi temubual tersebut bagi tujuan pembelajaran berterusan.  Dengan ini kami sertakan maklumat untuk pihak puan hubungi <?php echo ($applicationEntity->user->fullname)?> (<?php echo ($applicationEntity->group_leader_email) ?> dan <?php echo ($applicationEntity->group_leader_phone)?>)
              <br /><br />
              4. &nbsp;&nbsp;&nbsp;&nbsp; Pertimbangan dan kerjasama pihak Tuan/Puan dalam perkara ini amatlah dihargai.  Bersama-sama ini disertakan surat sokongan untuk makluman dan rujukan pihak puan selanjutnya.
              <br /><br />
              Sekian Terima Kasih.

              <br /> <br />
              <?php if($applicationEntity->approval_status==0){
                echo '<strong class="text-danger">[Dalam Semakan]</strong>';
              }elseif ($applicationEntity->approval_status==1){
                echo 'Jabatan Hal Ehwal Pelajar<br />';
                echo 'Universiti Teknologi MARA<br /><br />';
                echo '<strong>CETAKAN KOMPUTER. TIDAK PERLU TANDA TANGAN</strong>';
              }else{
                echo 'Rejected';}
            ?>
              
        </div>
        <br />
        <?= h($applicationEntity->user->fullname)?> <br/>
        <?= h($applicationEntity->faculty->name)?> <br/>
         <?= h($applicationEntity->program->name)?> <br/>

         <br/><br/>
         <section class ="top">
            <div class="one"></div>
            <div class="two"></div>
        </Section>
			</div>
		</div>
		

            
            


		
	</div>
	<div class="col-md-4">
	  <div class="card bg-body-tertiary border-0 shadow rounded-0">
        <div class="card-body">
            <div class="card-title mb-0">Application Data</div>
            <div class="tricolor_line mb-3"></div>
    <table class="table table-sm table-hover">
        <tr>
            <td>Approval Date</td>
            <td><?php echo date('M d Y(h:i A)',strtotime($applicationEntity->created)) ?></td>
        </tr>
       <tr>
            <td>Approval date</td>
            <td><?php echo date('M d Y(h:i A)',strtotime($applicationEntity->modified)) ?></td>
        </tr>
       <tr>
            <td>Application Status</td>
            <td><?php  if ($applicationEntity->approval_status == 0){
						echo '<span class="badge bg-warning"> pending</span>';
					} elseif($applicationEntity->approval_status==1){
						echo '<span class="badge bg-success"> Approve</span>';
					}elseif ($applicationEntity->approval_status==2){
						echo '<span class="badge bg-danger"> Reject</span>';
					}
					else{
						echo '<span class="badge bg-danger"> Error</span>';
					} ?></td>
        </tr>
    </table>
    <?php echo $this->Html->link(('Download PDF'),['action'=>'Pdf',$applicationEntity->id],['class'=>'btn btn-sm btn-outline-primary','escapeTitle'=>false]) ?>
        </div>
      </div>
	</div>
</div>




