<?php include "../../config/core_admin.php";
	
	// Қолданушыны тексеру
	if (!$user_id) go('/admin/');

   // 
	$work_id = $_GET['id'];
   $work_d = fun::work_d($work_id);
   if (!$work_d) go('/admin/works/');
   
   $user_pd = fun::user($work_d['user_id']);
   $udb_view = db::query("UPDATE `home_work` SET `view_a` = 1 where id = '$work_id'");


	// site setting
	$pod_menu_name = 'works';
	// $site_set['utop_nm'] = '12 - үй жұмысы';
	$site_set['utop_bk'] = ' ';
	$site_set['autosize'] = true;
	$css = ['admin/works', 'admin/chat'];
	// $js = [''];
?>
<?php include "../block/header.php"; ?>

	<div class="uchat">
      <div class="bl_c">

         <div class="uchat_c">
      
            <?php $works = db::query("select * from home_work_item where work_id = '$work_id'"); ?>
            <?php if (mysqli_num_rows($works)): ?>
               <?php while ($works_d = mysqli_fetch_assoc($works)): ?>
                  <?php if ($works_d['user_id']) $user_d = fun::user($works_d['user_id']); else $user_d = $user_pd; ?>
                  <div class="uchat_ci <?=($works_d['user_id']?'uchat_cir':'')?>">
                     <div class="uhwa_itm"><i class="fal fa-user"></i></div>
                     <div class="uhwa_ic">
                        <div class="uhwa_it">
                           <div class="uhwa_itcn">
                              <?php if ($user_d['name'] && $user_d['name'] != 'USER'): ?> <?=$user_d['name']?> <?=$user_d['surname']?> / <?php endif ?>
                              <?php if ($user_d['phone'] && !$user_d['right']): ?> <?=$user_d['phone']?> <?php endif ?>
                           </div>
                           <div class="uhwa_itcp"><div><?=date("m-d-Y", strtotime($works_d['ins_dt']))?></div><div><?=date("H:i", strtotime($works_d['ins_dt']))?></div></div>
                        </div>
                        <div class="uhwa_iw">
                           <div class="uchat_ciw"><?=$works_d['txt']?></div>
                        </div>
                     </div>
                  </div>
               <?php endwhile ?>
            <?php endif ?>
   
         </div>
   
         <div class="uchat_b">
            <div class="form_im_com">
               <textarea class="form_im_comment inp_form" rows="5" autocomplete="off" autocorrect="off" aria-label="Жауабыңызды жазыңыз .." placeholder="Жауабыңызды жазыңыз .."></textarea>
               <div class="btn_comment btn_add_work" data-work-id="<?=$work_id?>">Жіберу</div>
            </div>
            <script>autosize(document.querySelectorAll('.form_im_comment'));</script>
         </div>

      </div>
	</div>

<?php include "../block/footer.php"; ?>