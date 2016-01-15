    <footer class="page-footer">
      <div class="footer-copyright">
        <div class="container">
        © 2016 Copyright Astrid Garth

        <!-- Modal Trigger -->
        <div class="right">
          <a  <?php if($data['menu_active'] === 'kontakt'):?>class="active"<?php endif;?> href="<?= DIR ?>impressum">IMPRESSUM</a>
        </div>
        <a class="modal-trigger-footer" style="color:white" href="#modal_login_footer">
          <?php
          if(SESSION::get('admin')){
            echo SESSION::get('admin'); ?>
            Logout
         <?php } ?>
        </a>

        <!-- Modal Structure -->
        <div id="modal_login_footer" class="modal">
          <?php if (!Session::get('admin')):?>
          <div class="modal-content">
            <form action="<?= DIR ?>admin/login" autocomplete="off" method="POST">
              <div class="input-group">
    						<input type="text" class="form-control" name="username" placeholder="Username">
    					</div>
    					<div class="input-group">
    						<input  type="password" class="form-control" name="password" placeholder="Password">
    					</div>
    					<button class="btn btn-primary btn-block right" type="submit">Login</button>
    				</form>
            <br>
          </div>
          <?php else:?>
          <div class="modal-content">
            <p style="color:black;">Logout?</p>
            <a class="btn btn-primary" href="<?= DIR ?>admin/logout/<?= Session::get('admin') ?>" >Logout</a>
          </div>
          <?php endif;?>
        </div>
       </div>
      </div>
    </footer>

    <script src="<?= URL::MATERIALIZE('materialize.min','js') ?>"></script>
    <script src="<?= URL::MATERIALIZE('init','js') ?>"></script>
    <script src="<?= URL::EXTRAS('script','js') ?>"></script>

  </body>
</html>
