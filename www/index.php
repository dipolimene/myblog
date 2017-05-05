<?php


  $title = "Chache Chache Blog";

  # import functions lib..
  include 'includes/functions.php';

  # include dashboard header
  include 'includes/index_header.php';

  # include db connection
  include 'includes/connection.php';



?>



    <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">CHACHE CHACHE BLOG</h1>
        <p class="lead blog-description">An blog full of surprises.</p>
      </div>
    </div>

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

        


        <div class="blog-post">

        <?php $post = Utils::displayPost($conn); echo $post; ?>

 

          </div>     

          <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 offset-sm-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Another one! We the best.</p>
          </div>

          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">

            <?php  $fetch = Utils::fetchArchive($conn); echo $fetch; ?>  

            </ol>
          </div>

<!--          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>    -->
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Built for <a href="https://getbootstrap.com">Chache Chache Blog</a> by <a href="#">DO</a></p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/jquery-3.2.1.min.js"></script>
  </body>
</html>
