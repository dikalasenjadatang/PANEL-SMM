<?php
session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}
}

include("lib/header.php");
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-info">
									<i class="fa fa-info-circle"></i> Anda dapat menghubungi kami untuk mengisi saldo & daftar
								</div>
							</div>
																<div class="row">
  <div class="column">
    <div class="card">
      <center><img src="as.jpg" alt="Jane" style="width:100%"></center>
      <div class="container">
        <h2>Dirhank.Jr / Darmawan Utama</h2>
        <p class="title">CEO &amp; Founder</p>
        <p>FB :Darmawan Utama</p>
        <p>WA : 085264520165</p>
        <p><button href="https://www.facebook.com/mr.cakil007" class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="35524068_379395035801574_8951204091065794560_n.jpg" alt="Mike" style="width:100%">
      <div class="container">
        <h2></h2>
        <p class="title">Admin</p>
        <p>FB : </p>
        <p>WA : </p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
   <div class="column">
    <div class="card">
      <img src="39442053_308240616602504_5506477918370398208_n.jpg" alt="Mike" style="width:100%">
      <div class="container">
        <h2></h2>
        <p class="title">Admin</p>
        <p>FB : .</p>
        <p>WA : </p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
   <div class="column">
    <div class="card">
      <img src="38779953_455920174885624_4199606386235015168_n.jpg" alt="Mike" style="width:100%">
      <div class="container">
       <h2> Dino</h2>
        <p class="title">Admin</p>
        <p>FB : Dino Dino.</p>
        <p>WA : Sensored</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="38851743_1225664490906524_1599487971839442944_n.jpg" alt="Mike" style="width:100%">
      <div class="container">
        <h2>Dika Utama</h2>
        <p class="title">Admin</p>
        <p>FB : Dika Utama.</p>
        <p>WA : Gk punya</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="39002826_686662728336127_366594601382838272_n.jpg" alt="John" style="width:100%">
      <div class="container">
        <h2>Joko Setiawan</h2>
        <p class="title">Admin</p>
        <p>FB : Joko Setiawan.</p>
        <p>WA : 6281269373884</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
   <div class="column">
    <div class="card">
      <img src="39927855_2383510248340608_7645660562818334720_n.png" alt="Mike" style="width:100%">
      <div class="container">
        <h2>Alfino G</h2>
        <p class="title">Admin</p>
        <p>FB : Alfino G.</p>
        <p>WA : 081289613280</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="41344610_2026492327573151_7398704624812687360_n.jpg" alt="John" style="width:100%">
      <div class="container">
        <h2>Edi Nurhidayat</h2>
        <p class="title">Admin</p>
        <p>FB : Edi Assegaff.</p>
        <p>WA : 082214440277</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>
<style>
    /* Three columns side by side */
.column {
    float: left;
    width: 33.3%;
    margin-bottom: 16px;
    padding: 0 8px;
}

/* Display the columns below each other instead of side by side on small screens */
@media screen and (max-width: 650px) {
    .column {
        width: 100%;
        display: block;
    }
}

/* Add some shadows to create a card effect */
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

/* Some left and right padding inside the container */
.container {
    padding: 0 16px;
}

/* Clear floats */
.container::after, .row::after {
    content: "";
    clear: both;
    display: table;
}

.title {
    color: grey;
}

.button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 8px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
}

.button:hover {
    background-color: #555;
}
</style>
						<!-- end row -->
								

                               
                               <div></div>

                              
</p>
                                </div>
                            </div>
                        </div>
                    </div>
						<!-- end row -->
<?php
include("lib/footer.php");
?>