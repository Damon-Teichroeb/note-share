  <footer class="flex-footer">
    <a href="index.php"><h1>Note Share</h1></a>
    <div id="about">
      <h3 class="a" onclick="location.assign('about.php');">About Us</h3>
    </div>
    <div id="contact">
      <h3 class="a" onclick="showContactInfo()">Contact Info</h3>
    </div>
  </footer>
  <script src="scripts/main.js"></script>
</body>
</html>

<?php $dbh->close(); ?>