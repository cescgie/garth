<div class="row">
  <div class="input-field col s12 m12 l4 offset-l4">
    <i class="large material-icons center-align">perm_identity</i>
        <form action="<?= DIR ?>admin/login" autocomplete="off" method="POST">
          <div class="input-group">
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="input-group">
            <input  type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <button class="btn btn-primary btn-block right" type="submit">Login</button>
        </form>
  </div>
</div>
