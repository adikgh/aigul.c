<?php include "config/core.php";

	// site setting
	$menu_name = '404';
	http_response_code(404);
?>
<?php include "block/header.php"; ?>

   <div class="dev">
      <div class="bl_c">
         <div class="dev_c">
            <div class="devc_im"><i class="fal fa-leaf"></i></div>
            <div class="devc_t">
               <h2>Бұл бет табылмады</h2>
               <p>Басты бетке немесе жеке <br>кабинетіңізге өте аласыз</p>
               <div class="devc_b">
                  <a class="btn" href="/">Басты бет</a>
                  <a class="btn btn_cl" href="/education/">Жеке кабинет</a>
               </div>
            </div> 
         </div>
      </div>
   </div>

<?php include "block/footer.php"; ?>