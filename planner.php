<?php 
include 'config.php';
session_start();

$pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare("SELECT * FROM courses");
    $stmt->execute();
    $courses= $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($courses);
?>

<?php 

if (isset($_POST['schedule_submit'])) {

    
    $next_start_date = $_POST['dateSelector']; // Initialize the start date

foreach ($courses as $course) {
    $faculty_id = $_SESSION['login_id'];
    $title = $course['description'];
    $schedule_type = 1;
    $is_repeating = 1;
    $start_date = $next_start_date; // Use the end date of the last iteration as the start date of this iteration
    $start_date_2 = strtotime($start_date);
    $end_date = date("Y-m-d", strtotime("+1 month", $start_date_2));
    $next_start_date = $end_date; // Store the end date to use as the start date of the next iteration
    $repeating_data = '{"dow":"1,2,3,4,5","start":"'.$start_date.'","end":"'.$end_date.'"}';
    $schedule_date = $start_date;
    $time_from = '09:00:00';
    $time_to = '17:00:00';

    $stmt = $pdo->prepare("INSERT INTO schedules (faculty_id, title, schedule_type, is_repeating, repeating_data, schedule_date, time_from, time_to) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$faculty_id, $title, $schedule_type, $is_repeating, $repeating_data, $schedule_date, $time_from, $time_to]);

    header("location: planner.php");
}
}
?>

<?php
if (isset($_POST['reschedule_submit'])) {

    $id = $_SESSION['login_id'];
        $stmt = $pdo->prepare("DELETE FROM schedules WHERE faculty_id='$id'");
        $stmt->execute();
    
    $next_start_date = $_POST['breakSelector']; // Initialize the start date

foreach ($courses as $course) {
    $faculty_id = $_SESSION['login_id'];
    $title = $course['description'];
    $schedule_type = 1;
    $is_repeating = 1;
    $start_date = $next_start_date; // Use the end date of the last iteration as the start date of this iteration
    $start_date_2 = strtotime($start_date);
    $end_date = date("Y-m-d", strtotime("+1 month", $start_date_2));
    $next_start_date = $end_date; // Store the end date to use as the start date of the next iteration
    $repeating_data = '{"dow":"1,2,3,4,5","start":"'.$start_date.'","end":"'.$end_date.'"}';
    $schedule_date = $start_date;
    $time_from = '09:00:00';
    $time_to = '17:00:00';

    $stmt = $pdo->prepare("INSERT INTO schedules (faculty_id, title, schedule_type, is_repeating, repeating_data, schedule_date, time_from, time_to) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$faculty_id, $title, $schedule_type, $is_repeating, $repeating_data, $schedule_date, $time_from, $time_to]);

    header("location: planner.php");
}
}

?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Gateway Platform</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
</head>
<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader end -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="../index.php"><h2>Gateway Platfrom</h2></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li class="active" ><a href="../index.php">Home</a></li>
                                                <li><a href="../courses.php">Courses</a></li>
                                                <li><a href="../about.php">About</a></li>
                                                <!-- Button -->
                                                <?php
      // Check if user is logged in 
      if (isset($_SESSION['login_id'])) {
          // User-only HTML elements
          echo '<li class="button-header margin-left "><a href="../app/index.php" class="btn">Check Schedule</a></li>
          <li class="button-header"><a href="../app/admin/ajax.php?action=logout" class="btn btn3">Logout</a></li>';
        } else {
        // Non-logged in user HTML elements
        echo '<li class="button-header margin-left "><a href="../app/index.php" class="btn">Check Schedule</a></li>
        <li class="button-header margin-left "><a href="../app/login-planner.php" class="btn">Planner</a></li>
        <li class="button-header"><a href="../app/admin/index.php" class="btn btn3">Admin Login</a></li>';
        }
        ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
</header>
	<main>
		<!--? slider Area Start-->
		<section class="slider-area slider-area2">
			<div class="slider-active">
				<!-- Single Slider -->
				<div class="single-slider slider-height2">
					<div class="container">
						<div class="row">
							<div class="col-xl-8 col-lg-11 col-md-12">
								<div class="hero__caption hero__caption2">
									<h1 data-animation="bounceIn" data-delay="0.2s"><?php echo $_SESSION['login_name'] ?>'s Planner</h1>
								</div>
							</div>
						</div>
					</div>          
				</div>
			</div>
		</section>
                                    <div class="container">
										<div class="section-top-border">
											<div class="row">
												<div class="col-lg-8 col-md-8">
													<h3 class="mb-30">Create Schedule</h3>
													<form method="POST" action="planner.php">
														<div class="mt-10">
                                                            <label>Student Name:</label>
															<input type="text" name="student_name" placeholder="<?php echo $_SESSION['login_name'] ?>"
                                                            readonly
														    required
															class="single-input">
														</div>
														<div class="mt-10">
                                                        <label>Student ID:</label>
															<input type="text" name="student_id" placeholder="<?php echo $_SESSION['login_id_no'] ?>"
															required
															class="single-input"
                                                            readonly>
														</div>
														<div class="input-group-icon mt-10">
                                                        
															<div class="icon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
															<div class="form-select" id="default-select">
																<select name="dateSelector">
                                                                <option value="" disabled selected hidden>Choose a preferred program start date</option>
																	<option value="2024-06-01">July 2024</option>
																	<option value="2024-11-01">November 2024</option>
																	<option value="2025-06-01">July 2025</option>
																	<option value="2025-11-01">November 2025</option>
																</select>
															</div>
														</div>
														<div class="mt-10">
                                                        <label>Program End Date:</label>
															<input type="text" 
                                                            name="end_date"
															required class="single-input-secondary"
                                                            placeholder=""
                                                            readonly>
														</div>
                                                        <!-- <input type="hidden" name="end_date_val"> -->
                                                        <div class="mt-10">
                                                        <input type="submit"
                                                         value="Schedule Now"
                                                         name="schedule_submit"    
                                                        class="genric-btn danger"
                                                        >
                                                        </div>
													</form>
                                                        <br><br><br>
                                                        <h3 class="mb-30">Reschedule</h3>
                                                        <h4 class="mb-30">Choose your new schedule</h4>
													    <form action="planner.php" method="POST">
														    <div class="mt-10">
                                                            <div class="form-select" id="default-select">
																<select name="breakSelector">
                                                                <option value="" disabled selected hidden>Choose a preferred program start date</option>
																	<option value="2024-06-01">July 2024</option>
																	<option value="2024-11-01">November 2024</option>
																	<option value="2025-06-01">July 2025</option>
																	<option value="2025-11-01">November 2025</option>
																</select>
															</div>
                                                            <br>
                                                            <div class="mt-12">
															<textarea name="break_message" value=""
                                                            readonly
															required
															class="single-textarea">
</textarea>
														</div>
                                                            <br>
                                                            <input type="submit" name="reschedule_submit" value="Take A Break" 
                                                            class="genric-btn primary">
                                                        </form>
                                                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>
								<!-- End Align Area -->
							</main>
							<footer>
								<div class="footer-wrappper footer-bg">
									<!-- footer-bottom area -->
									<div class="footer-bottom-area">
										<div class="container">
											<div class="footer-border">
												<div class="row d-flex align-items-center">
													<div class="col-xl-12 ">
														<div class="footer-copy-right text-center">
															<p>
																Copyright &copy;<script>document.write(new Date().getFullYear());</script>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- Footer End-->
								</div>
							</footer> 
								<!-- Scroll Up -->
								<div id="back-top" >
									<a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
								</div>
								<!-- JS here -->
								<script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
								<!-- Jquery, Popper, Bootstrap -->
								<script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
								<script src="../assets/js/popper.min.js"></script>
								<script src="../assets/js/bootstrap.min.js"></script>
								<!-- Jquery Mobile Menu -->
								<script src="../assets/js/jquery.slicknav.min.js"></script>

								<!-- Jquery Slick , Owl-Carousel Plugins -->
								<script src="../assets/js/owl.carousel.min.js"></script>
								<script src="../assets/js/slick.min.js"></script>
								<!-- One Page, Animated-HeadLin -->
								<script src="../assets/js/wow.min.js"></script>
								<script src="../assets/js/animated.headline.js"></script>
								<script src="../assets/js/jquery.magnific-popup.js"></script>

								<!-- Date Picker -->
								<script src="../assets/js/gijgo.min.js"></script>
								<!-- Nice-select, sticky -->
								<script src="../assets/js/jquery.nice-select.min.js"></script>
								<script src="../assets/js/jquery.sticky.js"></script>
								
								<!-- counter , waypoint,Hover Direction -->
								<script src="../assets/js/jquery.counterup.min.js"></script>
								<script src="../assets/js/waypoints.min.js"></script>
								<script src="../assets/js/jquery.countdown.min.js"></script>
								<script src="../assets/js/hover-direction-snake.min.js"></script>

								<!-- contact js -->
								<script src="../assets/js/contact.js"></script>
								<script src="../assets/js/jquery.form.js"></script>
								<script src="../assets/js/jquery.validate.min.js"></script>
								<script src="../assets/js/mail-script.js"></script>
								<script src="../assets/js/jquery.ajaxchimp.min.js"></script>
								
								<!-- Jquery Plugins, main Jquery -->	
								<script src="../assets/js/plugins.js"></script>
								<script src="../assets/js/main.js"></script>

                                <script>
$(document).ready(function() {
    var valueMap = {
        "2024-06-01": "July 2025",
        "2024-11-01": "November 2025",
        "2025-06-01": "July 2026",
        "2025-11-01": "November 2026"
    };

    $('select[name="dateSelector"]').change(function() {
        var selectedValue = $(this).val();
        if (valueMap.hasOwnProperty(selectedValue)) {
            $('input[name="end_date"]').val(valueMap[selectedValue]);
            // $('input[name="end_date_val"]').val(valueMap2[selectedValue]);
        } else {
            console.log('The selected value does not exist in valueMap:', selectedValue);
        }
    });
});
                                    </script>
                                    <script>
$(document).ready(function() {
    var valueMap = {
        "2024-06-01": "July 2024",
        "2024-11-01": "November 2024",
        "2025-06-01": "July 2025",
        "2025-11-01": "November 2025"
    };

        var valueMap2 = {
        "2024-06-01": "July 2025",
        "2024-11-01": "November 2025",
        "2025-06-01": "July 2026",
        "2025-11-01": "November 2026"
    };

    $('select[name="breakSelector"]').change(function() {
        var selectedValue = $(this).val();
        if (valueMap.hasOwnProperty(selectedValue)) {
           
            $('textarea[name="break_message"]').val("Please note that if you take a break by " + valueMap[selectedValue] + " then you would have to continue your course by " + valueMap2[selectedValue] + ".");
           
        } else {
            console.log('The selected value does not exist in valueMap:', selectedValue);
        }
    });
});
                                    </script>
								
							</body>
							</html>