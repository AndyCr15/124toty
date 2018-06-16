<nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img src="/images/smlwrlogo.png" width="30" height="30" class="d-inline-block align-top" alt="" style="margin-right: 8px;">124 - <?php echo $_SESSION['userData']['firstname'] ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php        
        if(canCheck($_SESSION['userData']['employee'])) {
            ?>
            <li class="nav-item">
            <a class="nav-link" href="record.php">Record</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="reports.php">Reports</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="duty.php">Duty</a>
            </li>
            <?php
        }
        if($_SESSION['userData']['level'] < 10) {
            ?>
            <li class="nav-item">
            <a class="nav-link" href="admin.php">Admin</a>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="pull-right">
        <form action="viewpartners.php" class="navbar-form" role="search">
            <div class="input-group">
                <input class="form-control" type="text" id="search" name="search" placeholder="Search" aria-label="Search">
                <div class="input-group-btn">
                    <button class="btn btn-outline-success" id="submit" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</nav>