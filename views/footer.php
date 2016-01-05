    <footer class="page-footer">
      <div class="footer-copyright">
        <div class="container">
        © 2016 Copyright Astrid Garth

        <!-- Modal Trigger -->
        <a class="grey-text text-lighten-4 right modal-trigger-footer" style="color:black" href="#modal_login_footer">
          <?php if(SESSION::get('admin')){
            echo SESSION::get('admin'); ?>
            Logout
          <?php }else{?>
            Login
          <?php }?>
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

    <!-- Compiled and minified JavaScript -->
    <script src="<?= URL::MATERIALIZE('materialize.min','js') ?>"></script>
    <script src="<?= URL::MATERIALIZE('init','js') ?>"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
      $('.modal-trigger-footer').leanModal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        ready: function() {
          console.log('Ready');
        }, // Callback for Modal open
        complete: function() {
          console.log('Closed');
        } // Callback for Modal close
      });
    });
    //edit Images
    $('.modal-trigger-Image').leanModal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        ready: function() {
          console.log('Ready');
        }, // Callback for Modal open
        complete: function() {
          console.log('Closed');
        } // Callback for Modal close
      }
    );
    //edit oberkategorie
    $('.modal-trigger-kategorie').leanModal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        ready: function() {
          console.log('Ready');
        }, // Callback for Modal open
        complete: function() {
          console.log('Closed');
        } // Callback for Modal close
      }
    );
    </script>

  </body>
</html>
