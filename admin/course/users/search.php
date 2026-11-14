<?php include "../../../config/core_admin.php";

   $number = 0;
?>

   <!--  -->
   <?php if (isset($_GET['user_search'])): ?>
		<?php $search = strip_tags($_POST['search']); ?>
		<?php $cours_id = strip_tags($_POST['cours_id']); ?>

		<?php $user = db::query("select * from user where (phone like '%$search%') or (mail like '%$search%') or (name like '%$search%') or (surname like '%$search%') order by ins_dt desc"); ?>
      <?php while ($user_d = mysqli_fetch_assoc($user)): ?>
         <?php $userd_id = $user_d['id']; ?>
         <?php $cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' and user_id = '$userd_id'"); ?>
         <?php if (mysqli_num_rows($cours_buy) > 0 && $number < 50): ?>
            <?php $buy_d = mysqli_fetch_assoc($cours_buy); ?>
            <?php $pack_d = fun::pack($buy_d['pack_id']); ?>
            <?php $number++; ?>

            <div class="uc_ui">
               <div class="uc_uil">
                  <div class="uc_ui_number"><?=$number?></div>
                  <div class="uc_ui_right">
                     <div class="form_im form_im_toggle">
                        <input type="checkbox" class="homework" data-val="" />
                        <div class="form_im_toggle_btn <?=($buy_d['off']?'':'form_im_toggle_act')?> sub_buy_off" data-id="<?=$buy_d['id']?>"></div>
                     </div>
                  </div>
                  <a class="uc_uiln" href="/user/admin/users/item/?id=<?=$user_d['id']?>">
                     <div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$user_d['logo']?>"><?=($user_d['logo']!=null?'':'<i class="fal fa-user"></i>')?></div>
                     <div class="uc_uinu">
                        <div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
                        <div class="uc_ui_phone"><?=($user_d['phone'] != null?$user_d['phone']:$user_d['mail'])?></div>
                     </div>
                  </a>

                  <?php if ($buy_d['ins_dt'] != null && $buy_d['end_dt'] != null):?>
                     <?php $result = intval((strtotime($buy_d['end_dt']) - strtotime(date("d.m.Y"))) / (60*60*24)); ?>
                     <?php $access = intval((strtotime($buy_d['end_dt']) - strtotime($buy_d['ins_dt'])) / (60*60*24)); ?>
                     <?php 	if (($access - $result) == 0) $precent = 0; elseif (($access - $result) < $access) $precent = round(100 / ($access / ($access - $result))); else $precent = 100; ?>
                  <?php endif ?>
                  <div class="uc_uin_other uc_uin_date">
                     <?php if ($buy_d['end_dt'] != null): ?>
                        <div class="uc_uin_date_u">
                           <div class="">
                              <?php if ($result > 0): ?><?=$result?> күн қалды
                              <?php else: ?>Аяқталды<?php endif ?>
                           </div>
                           <div class=""><?=$precent?>%</div>
                        </div>
                        <div class="uc_uin_date_i"><span style="width:<?=$precent?>%"></span></div>
                     <?php else: ?><div class="uc_uin_date_u">Шексіз</div><?php endif ?>
                  </div>

                  <?php if (fun::pack_sum($cours_id) > 1): ?> <div class="uc_uin_other" data-name="Пакет"><?=$pack_d['name']?></div> <?php endif ?>
               </div>
               <div class="uc_uib sel_id" data-id="<?=$buy_d['id']?>">
                  <div class="uc_uibo"><i class="fal fa-ellipsis-v"></i></div>
                  <div class="menu_c uc_uibs">
                     <div class="menu_ci cursor_none">
                        <div class="menu_cin"><i class="fal fa-calendar-alt"></i></div>
                        <div class="menu_cih">Доступ уақыты</div>
                     </div>
                     <div class="menu_ci sms_send">
                        <div class="menu_cin"><i class="fal fa-paper-plane"></i></div>
                        <div class="menu_cih">СМС қайта жіберу</div>
                     </div>
                     <div class="menu_ci uc_uib_del user_del">
                        <div class="menu_cin"><i class="fal fa-trash-alt"></i></div>
                        <div class="menu_cih">Оқушыны өшіру</div>
                     </div>
                  </div>
               </div>
            </div>

         <?php endif ?>
      <?php endwhile ?>
		<?php exit(); ?>
	<?php endif ?>