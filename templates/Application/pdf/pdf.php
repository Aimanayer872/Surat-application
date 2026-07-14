<!DOCTYPE html>
<html lang="en">
<head>
    <title>Application</title>
</head>
<style>
    @page{
        margin: 0px !important
        padding: 0px !important
    }

    body
    {
        font-family: Arial, Helvetica, sans-serif;
        font-size:13px;
    }

    .right{
        text-align:right;
        padding-right: 50px;
    }
    
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
    .content{
        margin-left:70px;
        margin-right:70px;
    }

    .qr{
        width: 100px;
    }

</style>
<body>
<section class ="top">
    <div class="one"></div>
    <div class="two"></div>
</section>

<div class="text-end my-4 me-5 m-10">
    <?php echo $this->Html->image('../img/gambar/logouitm.png',['width'=>'180px','fullBase'=>true]) ?>
</div>
<hr />

<div class="content">
<table width='320px'align="right">
    <tr>
        <td width='70px'>Ref Number</td>
        <td>:</td>
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
        <td>Tarikh</td>
        <td>:</td>
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

    <table>
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
        <br />

        <div class="justify">
            Dengan segala hormatnya saya merujuk kepada perkara di atas.
            <br /><br />
            2. &nbsp;&nbsp;&nbsp;&nbsp; Sukacita Dimaklumkan bahawa kami seramai <?php echo ($applicationEntity->Team_member) ?> orang,Pelajar daripada Program Kode <?php echo($applicationEntity->program->code) ?> <strong><?php echo($applicationEntity->program->name) ?></strong> ingin Mejalankan satu kajian dalam bentuk Sesi TemuBual di <strong><?php echo ($applicationEntity->company_name)?></strong> secara <?php echo ($applicationEntity->method)?>  bagi menyiapkan Tugasan yang telah Diberi.Pada tarikh <strong><?php echo date('d F Y',strtotime($applicationEntity->date_interview))?></strong>(tertakluk kepada perubahan dan cuti mingguan organisasi).
            <br /><br />
             3. &nbsp;&nbsp;&nbsp;&nbsp; Di samping itu, kami memohon jasa baik pihak Tuan/puan untuk membenarkan kami merakam sesi temubual tersebut bagi tujuan pembelajaran berterusan.  Dengan ini kami sertakan maklumat untuk pihak puan hubungi <?php echo ($applicationEntity->user->fullname)?> (<?php echo ($applicationEntity->group_leader_email) ?> dan <?php echo ($applicationEntity->group_leader_phone)?>)
              <br /><br />
              4. &nbsp;&nbsp;&nbsp;&nbsp; Pertimbangan dan kerjasama pihak Tuan/Puan dalam perkara ini amatlah dihargai.  Bersama-sama ini disertakan surat sokongan untuk makluman dan rujukan pihak puan selanjutnya.
              <br /><br />
            

              <table width='100%'>
            <tr>
                <td width='80%'>Sekian Terima Kasih.
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
                </td>
                <td width='8%' class="right">
                    <img src="http://localhost/surat/js/qr-pdf/qrcode.php?s=qrh&d=<?php echo $this->request->getUri();
                     ?>" class="qr" ?>
                </td>
            </tr>
        </table>
        </div>



        <br /> 
        <?= h($applicationEntity->user->fullname)?> <br/>
        <?= h($applicationEntity->faculty->name)?> <br/>
        <?= h($applicationEntity->program->name)?> <br/>
</div>
        <br/><br/>

        <section class ="top">
            <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/>
            <div class="one"></div>
            <div class="two"></div>
        </Section>
    
</body>
</html>