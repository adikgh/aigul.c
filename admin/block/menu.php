<?php if ($site_set['um_menu']): ?>
   <div class="pmenu">
      <div class="pmenu_c">
			<a class="pmenu_i <?=($menu_name=='list'?'pmenu_i_act':'')?>" href="/admin/list/"><i class="fal fa-layer-group"></i></a>
			<a class="pmenu_i <?=($menu_name=='club'?'pmenu_i_act':'')?>" href="/admin/club/"><i class="fal fa-spa"></i></a>
			<div class="pmenu_i pmenu_is">
				<i class="fal fa-plus"></i>
			</div>
			<a class="pmenu_i <?=($menu_name=='users'?'pmenu_i_act':'')?>" href="/admin/users/"><i class="fal fa-users"></i></a>
         <a class="pmenu_i <?=($menu_name=='user'?'pmenu_i_act':'')?>" href="/admin/acc/"><i class="fal fa-user"></i></a>
      </div>
   </div>
<?php endif ?>

<!-- body start -->
<div class="app">

	<div class="ub1_l">
		<div class="ub1_lc">
			<div class="ub1_lm">
				<a class="ag_brand" href="/admin/">AIGUL ASQAR<small>Әкімші панелі</small></a>
				<div class="umenu_c">
					<div class="umenu_co">Басқару</div>
					<a class="umenu_ci <?=($menu_name=='list'?'menu_ci_act':'')?>" href="/admin/list/" data-title="Өнімдер">
						<div class="umenu_cin"><i class="fal fa-layer-group"></i></div>
						<div class="umenu_cih">Өнімдер</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='club'?'menu_ci_act':'')?>" href="/admin/club/" data-title="Қолдау клубы">
						<div class="umenu_cin"><i class="fal fa-spa"></i></div>
						<div class="umenu_cih">Қолдау клубы</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='users'?'menu_ci_act':'')?>" href="/admin/users/" data-title="Клиенттер">
						<div class="umenu_cin"><i class="fal fa-users"></i></div>
						<div class="umenu_cih">CRM / Клиенттер</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='works'?'menu_ci_act':'')?>" href="/admin/works/" data-title="Тапсырмалар">
						<div class="umenu_cin"><i class="fal fa-feather-alt"></i></div>
						<div class="umenu_cih">Тапсырмалар</div>
					</a>
					<a class="umenu_ci <?=($menu_name=='chats'?'menu_ci_act':'')?>" href="/admin/chats/" data-title="Чат">
						<div class="umenu_cin"><i class="fal fa-comments-alt"></i></div>
						<div class="umenu_cih">Чат
							<?php if (fun::chat_view_sum() != 0): ?>
								<span><?=fun::chat_view_sum()?></span>
							<?php endif ?>
						</div>
					</a>
				</div>
				<div class="umenu_c">
					<div class="umenu_co">Платформа</div>
					<a class="umenu_ci <?=($menu_name=='company'?'menu_ci_act':'')?>" href="/admin/company/" data-title="Баптаулар">
						<div class="umenu_cin"><i class="fal fa-sliders-h"></i></div>
						<div class="umenu_cih">Баптаулар</div>
					</a>
					<a class="umenu_ci" href="/" target="_blank" data-title="Сайт">
						<div class="umenu_cin"><i class="fal fa-external-link"></i></div>
						<div class="umenu_cih">Сайтты ашу</div>
					</a>
				</div>
			</div>
			<div class="ub1_lx">
				<div class="ub1_lt" href="/admin/" data-title="<?=$user['name']?> <?=($user['surname']?mb_substr($user['surname'],0,1).'.':'')?>">
					<div class="ub1_lti lazy_img" data-src="/assets/uploads/users/<?=$user['img']?>"><?php if (!$user['img']): ?><i class="fal fa-user"></i><?php endif ?></div>
					<div class="ub1_ltf"><?=$user['name']?> <?=($user['surname']?mb_substr($user['surname'],0,1).'.':'')?></div>
					<div class="ub1_ltic"><i class="fal fa-ellipsis-v"></i></div>
				</div>
				<div class="menu_c">
					<div class="menu_ci user_edit_pop">
						<div class="menu_cin"><i class="fal fa-user"></i></div>
						<div class="menu_cih">Менің аккаунтым</div>
					</div>
					<div class="menu_ci user_ph_pop">
						<div class="menu_cin"><i class="fal fa-mobile"></i></div>
						<div class="menu_cih">Телефон номерім</div>
					</div>
					<a class="menu_ci" href="https://wa.me/<?=$site['whatsapp']?>">
						<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
						<div class="menu_cih">Көмек (Whatsapp)</div>
					</a>
					<a class="menu_ci" href="/admin/exit.php">
						<div class="menu_cin"><i class="fal fa-sign-out"></i></div>
						<div class="menu_cih">Шығу</div>
					</a>
					<!-- <div class="umenu_c">
						<div class="umenu_co">Баптаулар</div>
						<a class="umenu_ci <?=($menu_name=='setting'?'menu_ci_act':'')?>" href="/u/setting.php">
							<div class="umenu_cin"><i class="fal fa-cog"></i></div>
							<div class="umenu_cih">Баптаулар</div>
						</a>
					</div> -->
				</div>
			</div>
		</div>

	</div>

	<?php if ($site_set['utop']): ?>
		<div class="uhead">
			<?php if ($site_set['utop_bk']): ?> <a class="uhead_lb" href="/admin/<?=$site_set['utop_bk']?>"><i class="fal fa-long-arrow-left"></i></a> <?php endif ?>
			<h4 class="uhead_c"><?=$site_set['utop_nm']?></h4>
		</div>
	<?php endif ?>