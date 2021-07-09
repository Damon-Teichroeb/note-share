  <footer class="flex-footer">
    <a href="index.php"><h1>Note Share</h1></a>
    <div id="about">
      <h2 class="a" onclick="location.assign('about.php');">About</h2>
    </div>
    <div id="contact">
      <h2 class="a" onclick="showContactInfo()">Contact</h2>
    </div>
  </footer>
  <script src="scripts/main.js"></script>
</body>
</html>

<?php
$dbh->close();
?>