<?php

require_once('config_local.php');
require_once('config.php');

if(isset($_COOKIE['login']) && $_COOKIE['login'] == 'successful'){ }
else {
    $forward_location = "LOCATION: " . WEB_PATH . "login.php";
    header($forward_location);
}

//classes
require_once(LOCAL_PATH . 'classes/query_class.php');
require_once(LOCAL_PATH . 'classes/transform_class.php');

$views = array(
    'modules' => array(
        'path' => 'modules',
        'title' => 'All Modules',
        'menu' => true,
    ),
    'lessons_module' => array(
        'path' => 'lessons_module',
        'title' => 'Lessons, per Module',
        'menu' => false,
    ),
    'activities_lesson' => array(
        'path' => 'activities_lesson',
        'title' => 'Activities, per Lesson',
        'menu' => false,
    ),
    'all_activities' => array(
        'path' => 'all_activities',
        'title' => 'All Activities',
        'menu' => true,
    ),
    'all_exercises' => array(
        'path' => 'all_exercises',
        'title' => 'All Exercises',
        'menu' => true,
    ),
    'syllabi' => array(
        'path' => 'syllabi',
        'title' => 'Syllabi',
        'menu' => true,
    ),
    'syllabus_lessons' => array(
        'path' => 'syllabus_lessons',
        'title' => 'Syllabi, Per Lesson',
        'menu' => false,
    ),
);


// is this s legal request? set parameters
if( isset($_GET['q']) && $_GET['q'] != '') {
    $request = $_GET['q'];
}
else $request = 'modules';

$available_view = array_keys($views);
if(in_array($request, $available_view)){
    $req_path = $localPath . "views/" . $request . ".php";
    require_once $req_path;
}
else die("We don't have that view (yet) Please speak with Keshet");

require_once('header.php') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->

                <!-- Card Body -->
                <div class="card-body">
                    <h1><?php echo $views[$request]['title']?></h1>
                    <?php if(isset($title)){ ?>
                        <h2 style="color:#4E73DE"><?php echo $title ?></h2>
                    <?php } ?>
                    <?php echo $table ?>
                </div>
            </div>
        </div>


    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php require_once('footer.php') ?>
