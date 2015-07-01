<?
            
$sql = new sql;
$sql2 = new sql;

$testMenu = "<ul class='dropdown-menu right-menu'>
  <li><a href='#'>menu 1</a></li>
  <li><a href='#'>menu 1</a></li>
  <li><a href='#'>menu 1</a></li>
  <li><a href='#'>menu 1</a></li>
  <li><a href='#'>menu 1</a></li>
  <li><a href='#'>menu 1</a></li>
</ul>";

$sql->query("select name,link from menu where parent=''");
while($sql->row()) {
  $menu[]="<li class='dropdown'><a href='/Home'>".$sql->col('name')."</a>";
  $menu[]="<ul class='dropdown-menu'>"
  $sql2->query("select name,link where parent='".$sql2->col('link')."'");
  while($sql2->row()) {
    if($sql2->col('link')=='Senior') {
      $menu[]="<li class='dropdown'></a href='/".$sql->col('link')."/".$sql2->col('link')."'>".$sql2->col('name')."$testMenu</a>";
    } else {
      $menu[]="<li></a href='/".$sql->col('link')."/".$sql2->col('link')."'>".$sql2->col('name')."</a>";
    }
  }
  $menu[]="</ul>";
  $menu[]="</li>";
}

/*            <li class='dropdown'><a href='#' >About Us</a>
              <ul class="dropdown-menu">
                <li><a href="/cms/AboutUs/WelcometoKES">Welcome to KES</a></li>
                <li><a href="/cms/AboutUs/KESToday">KES Today</a></li>
                <li><a href="/cms/AboutUs/History">History</a></li>
                <li><a href="/cms/AboutUs/TheLocalArea">The Local Area</a></li>
                <li><a href="/cms/AboutUs/TermDates/Calendar">Term Dates/Calendar</a></li>
                <li><a href="/cms/AboutUs/Staff">Staff</a></li>
                <li><a href="/cms/AboutUs/KeyStaff">Key Staff</a></li>
                <li><a href="/cms/AboutUs/AcademicPerformance">Academic Performance</a></li>
                <li><a href="/cms/AboutUs/ExaminationResults">Examination Results</a></li>
                <li><a href="/cms/AboutUs/UniversityDestinations">University Destinations</a></li>
                <li><a href="/cms/AboutUs/Facilities">Facilities</a></li>
                <li><a href="/cms/AboutUs/SchoolFacilities">School Facilities</a></li>
                <li><a href="/cms/AboutUs/FutureDevelopments">Future Developments</a></li>
                <li><a href="/cms/AboutUs/BusRoutes">Bus Routes</a></li>
                <li><a href="/cms/AboutUs/SchoolRules">School Rules</a></li>
                <li><a href="/cms/AboutUs/OnlineDocuments">Online Documents</a></li>
                <li><a href="/cms/AboutUs/GeneralDocuments">General Documents</a></li>
                <li><a href="/cms/AboutUs/SchoolPolicies">School Policies</a></li>
                <li><a href="/cms/AboutUs/JobVacancies">Job Vacancies</a></li>
                <li><a href="/cms/AboutUs/Testimonials">Testimonials</a></li>
              </ul>
            </li>
            <li class='separator'>|</li>
            <li><a href=''>Admissions</a></li>
            <li class='separator'>|</li>
            <li><a href='/OurSchool'>Our School</a></li>
            <li class='separator'>|</li>
            <li><a href=''>School life</a></li>
            <li class='separator'>|</li>
            <li><a href=''>News and Events</a></li>
            <li class='separator'>|</li>    
            <li><a href=''>Contacts</a></li> */