<style>
.tile-stats .num {
    font-size: 25px;
    font-weight: 700;
}
</style>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {
                // Sample Toastr Notification
                setTimeout(function()
                {
                    var opts = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                        "toastClass": "black",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("Welcome", "Kiddox App",opts);
                }, 3000);


                // Sparkline Charts
                $('.inlinebar').sparkline('html', {type: 'bar', barColor: '#ff6264'} );
                $('.inlinebar-2').sparkline('html', {type: 'bar', barColor: '#445982'} );
                $('.inlinebar-3').sparkline('html', {type: 'bar', barColor: '#00b19d'} );
                $('.bar').sparkline([ [1,4], [2, 3], [3, 2], [4, 1] ], { type: 'bar' });
                $('.pie').sparkline('html', {type: 'pie',borderWidth: 0, sliceColors: ['#3d4554', '#ee4749','#00b19d']});
                $('.linechart').sparkline();
                $('.pageviews').sparkline('html', {type: 'bar', height: '30px', barColor: '#ff6264'} );
                $('.uniquevisitors').sparkline('html', {type: 'bar', height: '30px', barColor: '#00b19d'} );


                $(".monthly-sales").sparkline([1,2,3,5,6,7,2,3,3,4,3,5,7,2,4,3,5,4,5,6,3,2], {
                    type: 'bar',
                    barColor: '#485671',
                    height: '80px',
                    barWidth: 10,
                    barSpacing: 2
                });


                // JVector Maps
                var map = $("#map");

                map.vectorMap({
                    map: 'europe_merc_en',
                    zoomMin: '3',
                    backgroundColor: '#383f47',
                    focusOn: { x: 0.5, y: 0.8, scale: 3 }
                });



                // Line Charts
                var line_chart_demo = $("#line-chart-demo");

                var line_chart = Morris.Line({
                    element: 'line-chart-demo',
                    data: [
                        { y: '2006', a: 100, b: 90 },
                        { y: '2007', a: 75,  b: 65 },
                        { y: '2008', a: 50,  b: 40 },
                        { y: '2009', a: 75,  b: 65 },
                        { y: '2010', a: 50,  b: 40 },
                        { y: '2011', a: 75,  b: 65 },
                        { y: '2012', a: 100, b: 90 }
                    ],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['October 2013', 'November 2013'],
                    redraw: true
                });

                line_chart_demo.parent().attr('style', '');


                // Donut Chart
                var donut_chart_demo = $("#donut-chart-demo");

                donut_chart_demo.parent().show();

                var donut_chart = Morris.Donut({
                    element: 'donut-chart-demo',
                    data: [
                        {label: "Download Sales", value: getRandomInt(10,50)},
                        {label: "In-Store Sales", value: getRandomInt(10,50)},
                        {label: "Mail-Order Sales", value: getRandomInt(10,50)}
                    ],
                    colors: ['#707f9b', '#455064', '#242d3c']
                });

                donut_chart_demo.parent().attr('style', '');


                // Area Chart
                var area_chart_demo = $("#area-chart-demo");

                area_chart_demo.parent().show();

                var area_chart = Morris.Area({
                    element: 'area-chart-demo',
                    data: [
                        { y: '2006', a: 100, b: 90 },
                        { y: '2007', a: 75,  b: 65 },
                        { y: '2008', a: 50,  b: 40 },
                        { y: '2009', a: 75,  b: 65 },
                        { y: '2010', a: 50,  b: 40 },
                        { y: '2011', a: 75,  b: 65 },
                        { y: '2012', a: 100, b: 90 }
                    ],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Series A', 'Series B'],
                    lineColors: ['#303641', '#576277']
                });

                area_chart_demo.parent().attr('style', '');




                // Rickshaw
                var seriesData = [ [], [] ];

                var random = new Rickshaw.Fixtures.RandomData(50);

                for (var i = 0; i < 50; i++)
                {
                    random.addData(seriesData);
                }

                var graph = new Rickshaw.Graph( {
                    element: document.getElementById("rickshaw-chart-demo"),
                    height: 193,
                    renderer: 'area',
                    stroke: false,
                    preserve: true,
                    series: [{
                        color: '#73c8ff',
                        data: seriesData[0],
                        name: 'Upload'
                    }, {
                        color: '#e0f2ff',
                        data: seriesData[1],
                        name: 'Download'
                    }
                    ]
                } );

                graph.render();

                var hoverDetail = new Rickshaw.Graph.HoverDetail( {
                    graph: graph,
                    xFormatter: function(x) {
                        return new Date(x * 1000).toString();
                    }
                } );

                var legend = new Rickshaw.Graph.Legend( {
                    graph: graph,
                    element: document.getElementById('rickshaw-legend')
                } );

                var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {
                    graph: graph,
                    legend: legend
                } );

                setInterval( function() {
                    random.removeData(seriesData);
                    random.addData(seriesData);
                    graph.update();

                }, 500 );
            });


            function getRandomInt(min, max)
            {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
        </script>

        <h1 class="page-title" > Dashboard </h1>
        <hr>
<?php if($_SESSION['sub_user_role']=='admin') {?>
        <div class="row">
		<?php $t=0;   $class= $this->admin_model->list_all_active_class();
		 foreach($class as $row){
			 $p=$this->admin_model->get_attendance_p_for_dashboard1($row['class_id']);
			 $t+=$p;

		 }

		?>
	        <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_student_count() ?>
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $t ;  ?> / <?php echo  $x ;  ?></div>

                    <h3>Students</h3>
                    <p></p>
                </div>

            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_guardian_count() ?>
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>

                    <h3>Guardian</h3>
                    <p></p>
                </div>

            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_teacher_count() ?>
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Teacher</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_employee_count() ?>
                <div class="tile-stats tile-yellow">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Employee</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_class_g_count() ?>
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Class Gallery</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_school_g_count() ?>
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>School Gallery</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_video_count() ?>
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-rss"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Video Gallery</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_event_count() ?>
                <div class="tile-stats tile-stats">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Events</h3>
                    <p></p>
                </div>
            </div>
            <!--==========================================================-->
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_section_count() ?>
                <div class="tile-stats tile-pink">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Section</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_exam_count() ?>
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Exam</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_vehicle_count() ?>
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Vehicle</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2 col-xs-6">
                <?php  $x = $this->admin_model->all_driver_count() ?>
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-rss"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Driver & Helper</h3>
                    <p></p>
                </div>
            </div>
            <!--==========================================================-->
            <!--==========================================================-->
            <div class="col-sm-4 col-xs-6">
                <?php  $x = $this->admin_model->all_book_count() ?>
                <?php  $y= $this->admin_model->all_book_issue_count() ?>
                <div class="tile-stats tile-pink">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><span  >T: </span><?php echo  $x ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >I : </span><?php echo  $y ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >A : </span><?php echo  $x-$y ;  ?></div>

                    <h3>Library Books</h3>
                    <p></p>
                </div>
            </div>

            <div class="col-sm-4 col-xs-6">
                <?php  $x = $this->admin_model->employee_p_count() ?>
                <?php  $y = $this->admin_model->employee_a_count() ?>
                <?php  $z = $this->admin_model->employee_l_count() ?>
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><span  >P : </span><?php echo  $x ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >A : </span><?php echo  $y ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >L : </span><?php echo  $z ;  ?></div>
                    <h3>Employee Present Today</h3>
                    <p></p>
                </div>

            </div>
            <div class="col-sm-4 col-xs-6">
                <?php  $p = $this->admin_model->lesson_plan_count(); ?>
                <?php  $pp = $this->admin_model->lesson_plan_p_count(); ?>
                <?php  $pa = $this->admin_model->lesson_plan_a_count(); ?>
                <div class="tile-stats tile-neon-red">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><span  ></span> T : <?php echo  $p ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >A: </span> <?php echo  $pa ;  ?>&nbsp;&nbsp;&nbsp;&nbsp;<span  >P: </span> <?php echo  $pp ;  ?></div>
                    <h3>Lesson Plan</h3>
                    <p></p>
                </div>
            </div>

            <!--==========================================================-->
            <div class="col-sm-3 col-xs-6">
                <?php  $x = $this->admin_model->fee_coll_this_month() ?>
                <div class="tile-stats tile-brown">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                    <h3>Fee Collection MTD</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <?php  $x = $this->admin_model->fee_coll_this_session() ?>
                <div class="tile-stats tile-pink">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                    <h3>Fee Collection YTD</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <?php  $x = $this->admin_model->fee_coll_this_today() ?>
                <div class="tile-stats tile-brown">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                    <h3>Fee Collection Today</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <?php  $x = $this->admin_model->all_route_count() ?>
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num"><?php echo  $x ;  ?></div>
                    <h3>Route</h3>
                    <p></p>
                </div>
            </div>
<!------------------------------------------>
            <div class="col-sm-3 col-xs-6">
                <?php  $x = $this->admin_model->expanse_this_month() ?>
                <div class="tile-stats tile-brown">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                    <h3>Expenditure MTD</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <?php  $x = $this->admin_model->expanse_this_year() ?>
                <div class="tile-stats tile-pink">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                    <h3>Expenditure YTD</h3>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <?php  $x = $this->admin_model->expanse_today() ?>
                <div class="tile-stats tile-brown">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                    <h3>Expenditure Today</h3>
                    <p></p>
                </div>
            </div>
<!------------------------------------------>
        </div>
<?php } ?>

<?php if($_SESSION['sub_user_role']=='Account Officer') {?>
    <div class="row">
        <!--==========================================================-->
        <div class="col-sm-3 col-xs-6">
            <?php  $x = $this->admin_model->fee_coll_this_month() ?>
            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                <h3>Fee Collection MTD</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-3 col-xs-6">
            <?php  $x = $this->admin_model->fee_coll_this_session() ?>
            <div class="tile-stats tile-pink">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                <h3>Fee Collection YTD</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-3 col-xs-6">
            <?php  $x = $this->admin_model->fee_coll_this_today() ?>
            <div class="tile-stats tile-brown">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                <h3>Fee Collection Today</h3>
                <p></p>
            </div>
        </div>

        <!--===========================================-->
        <div class="col-sm-3 col-xs-6">
            <?php  $x = $this->admin_model->expanse_this_month() ?>
            <div class="tile-stats tile-brown">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                <h3>Expenditure MTD</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-3 col-xs-6">
            <?php  $x = $this->admin_model->expanse_this_year() ?>
            <div class="tile-stats tile-pink">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                <h3>Expenditure YTD</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-3 col-xs-6">
            <?php  $x = $this->admin_model->expanse_today() ?>
            <div class="tile-stats tile-brown">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php if($x) echo  $x ; else echo '0'; ?> </div>
                <h3>Expenditure Today</h3>
                <p></p>
            </div>
        </div>

        <!--===========================================-->

    </div>
<?php } ?>
<?php if($_SESSION['sub_user_role']=='Librarian') {?>
    <div class="row">
        <?php  $all = $this->admin_model->all_book_count() ?>
        <?php  $issued= $this->admin_model->all_book_issue_count() ?>
        <!--==========================================================-->
        <div class="col-sm-4 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php echo  $all ;  ?></div>

                <h3>Total Books</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6">
            <?php  $x = $this->admin_model->all_book_count() ?>
            <?php  $y= $this->admin_model->all_book_issue_count() ?>
            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php echo  $issued ;  ?></div>

                <h3>Issued Books</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6">
            <?php  $x = $this->admin_model->all_book_count() ?>
            <?php  $y= $this->admin_model->all_book_issue_count() ?>
            <div class="tile-stats tile-pink">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num"><?php echo  $all - $issued ;  ?></div>

                <h3>Available Books</h3>
                <p></p>
            </div>
        </div>



    </div>
<?php } ?>
<?php if($_SESSION['sub_user_role']=='Exam Incharge') {?>
    <div class="row">
        <div class="col-sm-2 col-xs-6">
            <?php  $x = $this->admin_model->all_exam_count() ?>
            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num"><?php echo  $x ;  ?></div>
                <h3>Exam</h3>
                <p></p>
            </div>
        </div>

    </div>
<?php } ?>
<?php if($_SESSION['sub_user_role']=='Transport Incharge') {?>
    <div class="row">

        <div class="col-sm-2 col-xs-6">
            <?php  $x = $this->admin_model->all_vehicle_count() ?>
            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num"><?php echo  $x ;  ?></div>
                <h3>Vehicle</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-2 col-xs-6">
            <?php  $x = $this->admin_model->all_driver_count() ?>
            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-rss"></i></div>
                <div class="num"><?php echo  $x ;  ?></div>
                <h3>Driver & Helper</h3>
                <p></p>
            </div>
        </div>

        <div class="col-sm-2 col-xs-6">
            <?php  $x = $this->admin_model->all_route_count() ?>
            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num"><?php echo  $x ;  ?></div>
                <h3>Route</h3>
                <p></p>
            </div>
        </div>

    </div>
<?php } ?>
<?php if($_SESSION['sub_user_role']=='Academic Head') {?>
    <div class="row">
        <?php  $t_lp = $this->admin_model->lesson_plan_count(); ?>
        <?php  $p_lp = $this->admin_model->lesson_plan_p_count(); ?>
        <?php  $a_lp = $this->admin_model->lesson_plan_a_count(); ?>
        <div class="col-sm-4 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num"><?php echo  $t_lp ;  ?></div>
                <h3>All Lesson Plan</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num"><?php echo  $p_lp ;  ?></div>
                <h3>Pending Lesson Plan</h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num"><?php echo  $a_lp ;  ?></div>
                <h3>Approved Lesson Plan</h3>
                <p></p>
            </div>
        </div>



    </div>
<?php } ?>
        <div class="row" style="display: none">
            <div class="col-sm-8">

                <div class="panel panel-primary" id="charts_env">

                    <div class="panel-heading">
                        <div class="panel-title">Site Stats</div>

                        <div class="panel-options">
                            <ul class="nav nav-tabs">
                                <li class=""><a href="#area-chart" data-toggle="tab">Area Chart</a></li>
                                <li class="active"><a href="#line-chart" data-toggle="tab">Line Charts</a></li>
                                <li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="tab-content">

                            <div class="tab-pane" id="area-chart">
                                <div id="area-chart-demo" class="morrischart" style="height: 300px"></div>
                            </div>

                            <div class="tab-pane active" id="line-chart">
                                <div id="line-chart-demo" class="morrischart" style="height: 300px"></div>
                            </div>

                            <div class="tab-pane" id="pie-chart">
                                <div id="donut-chart-demo" class="morrischart" style="height: 300px;"></div>
                            </div>

                        </div>

                    </div>

                    <table class="table table-bordered table-responsive">

                        <thead>
                        <tr>
                            <th width="50%" class="col-padding-1">
                                <div class="pull-left">
                                    <div class="h4 no-margin">Pageviews</div>
                                    <small>54,127</small>
                                </div>
                                <span class="pull-right pageviews">4,3,5,4,5,6,5</span>

                            </th>
                            <th width="50%" class="col-padding-1">
                                <div class="pull-left">
                                    <div class="h4 no-margin">Unique Visitors</div>
                                    <small>25,127</small>
                                </div>
                                <span class="pull-right uniquevisitors">2,3,5,4,3,4,5</span>
                            </th>
                        </tr>
                        </thead>

                    </table>

                </div>

            </div>

            <div class="col-sm-4">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>
                                Real Time Stats
                                <br />
                                <small>current server uptime</small>
                            </h4>
                        </div>

                        <div class="panel-options">
                            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                        </div>
                    </div>

                    <div class="panel-body no-padding">
                        <div id="rickshaw-chart-demo">
                            <div id="rickshaw-legend"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



