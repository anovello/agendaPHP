    
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>

    <script>
        var url = "<?php echo BASE_URL ?>";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    
    <script src="<?php echo BASE_URL.'public/assets/js/geral.js'?>"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.15.1/sweetalert2.all.js" integrity="sha256-NlHeNEXmgM59zSDcFwf3OphwpeatLuiFJ4utVbzowqk=" crossorigin="anonymous"></script>
    <?php
        if (isset($type) && $type === 'home')
        {
          echo '<script src="'.BASE_URL.'public/assets/js/home.js"></script>';
        } else {
          echo '<script src="'.BASE_URL.'public/assets/js/account.js"></script>';
        }
    ?>

  </body>
</html>