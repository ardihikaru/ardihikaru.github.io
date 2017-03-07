<?php

date_default_timezone_set('Asia/Jakarta');

?>
<div id="guts">

    <nav>
        <div class="nav-wrapper cyan">
            <div class="col s12">
                <b class="breadcrumb"> &nbsp;Home</b> &nbsp;>
                <b class="breadcrumb"> &nbsp;Teaching</b> &nbsp;>
                <b class="breadcrumb"> &nbsp;<b class="blue darken-4">My Schedule</b></b>
                <!--
                <b class="breadcrumb"> | <?php echo '<b class="cyan darken-4">'.date('l, jS \o\f M, Y, g:i A').' ('.dayIndo(date('l')).')</b>'; ?></b>
                -->
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="wrapper light-blue-text text-darken-3">

            <!-- Begin Content -->
            <div id="contents">

                <div id="skrollr-body">
                    <div id="non-skrollr">

                        <br/>
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button btn blue darken-3' href='#' data-activates='dropdown1'>Today/Now</a>
                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="javascript:void(0)" onClick='getSchedule("-", "today")'> Today (default)</a></li>
                            <li><a href="javascript:void(0)" onClick='getSchedule("now", "today")'> Now</a></li>
                            <li><a href="javascript:void(0)" onClick='getSchedule("next", "today")'> Next Class</a></li>
                        </ul>

                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button btn blue darken-3' href='#' data-activates='dropdown1'>Day</a>
                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="javascript:void(0)" onClick='getSchedule("-", "Mon")'>Senin</a></li>
                            <li><a href="javascript:void(0)" onClick='getSchedule("-", "Tue")'>Selasa</a></li>
                            <li><a href="javascript:void(0)" onClick='getSchedule("-", "Wed")'>Rabu</a></li>
                            <li><a href="javascript:void(0)" onClick='getSchedule("-", "Thu")'>Kamis</a></li>
                            <li><a href="javascript:void(0)" onClick='getSchedule("-", "Fri")'>Jum'at</a></li>
                            <!-- <li><a href="javascript:void(0)" onClick='getSchedule("-", "ALL")'>[ SEMUA ]</a></li> -->
                        </ul>

                        <b class="breadcrumb"> &nbsp;&nbsp; <?php echo '<b>'.date('jS M, Y | g:i A').' ('.dayIndo(date('l')).')</b>'; ?></b>

                        <table class="striped responsive-table" id="my_schedule">
                            <thead>
                            <tr>
                                <th data-field="id">Hari</th>
                                <th data-field="name">Jam ke-</th>
                                <th data-field="price">Mata Kuliah</th>
                                <th data-field="price">Kelas Diajar</th>
                                <th data-field="price">Ruang Kelas</th>
                                <th data-field="price">Dosen</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>

                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>

            </div>

            <!-- END Content -->

        </div>
    </div>
</div>