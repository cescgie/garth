    <footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Footer Content</h5>
            <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
        © 2015 Copyright Astrid Garth

        <!-- Modal Trigger -->
        <a class="grey-text text-lighten-4 right modal-trigger" style="color:black" href="#modal_login">
          <?php if(SESSION::get('admin')){
            echo SESSION::get('admin');
          }?>
          Netpoint-Media
        </a>

        <!-- Modal Structure -->
        <div id="modal_login" class="modal">
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
      $('.modal-trigger').leanModal({
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
    </script>
  </body>
</html>
