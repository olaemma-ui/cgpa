<?php
  include "includes/header.php";
?>
<!-- md:top-60 md:absolute -->
  <div class="w-full flex justify-center">

      <div class="form relative md:top-80 bottom-14 lg:w-5/12 md:w-8/12 w-11/12">
        <div class="form-body p-3 bg-white shadow-xl border">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
                include "login.php";
              if (isset($alert)) {?>
                <div class="alert mb-5 md:mt-0 p-3 bg-red-400 rounded text-white shadow-md">
                  <?=$alert?>
                </div>
            <?php }
            }
          ?>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
              <div class="txt text-black text-center md:text-3xl bg-blue-500 text-white text-xl mb-8 pt-3 pb-4">
                Admin
              </div>
            <span class="md:inline block md:text-md txt mb-2 mt-3 text-black">Username: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($uname_err[0])) {
                    echo $uname_err[0];
                  }
                ?>
              </label>
            <input type="text" name="uname[]" class="txt p-1 mb-4 text-blue-400 w-full bg-white shadow-md border h-14 border-b-dark mb-3"
            value="<?php
                if (isset($uname[0])) {
                  echo $uname[0];
                }
              ?>"
            >

            <span class="md:inline block md:text-md text-black txt mb-2 mt-3">Password: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($psw_err[0])) {
                    echo $psw_err[0];
                  }
                ?>
              </label>
            <input type="password" name="psw[]" class="txt p-1 text-blue-400 w-full bg-white shadow-md border mb-4 h-14 border-b-dark"
            value="<?php
                if (isset($psw[0])) {
                  echo $psw[0];
                }
              ?>"
              >
            <button class="btn bg-green-500 text-white p-3 mt-3" name="login">
              Login <i class="far fa-user-circle"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
  include "includes/footer.php";
?>