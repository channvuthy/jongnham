<h3><b><span class="fa fa-calendar"></span> Working Day</b></h3>
<?php
	$exceptions = array(
            '2/24'  => array('11:00-18:00'),
            '10/18' => array('11:00-16:00', '18:00-20:30')
        );

        // OPTIONAL
        // Place HTML for output below. This is what will show in the browser.
        // Use {%hours%} shortcode to add dynamic times to your open or closed message.
        $template = array(
            'open'           => "Yes, we're open! Today's hours are {%hours%}.",
            'closed'         => "Sorry, we're closed. Today's hours are {%hours%}.",
            'closed_all_day' => "Sorry, we're closed today.",
            'separator'      => " - ",
            'join'           => " and ",
            'format'         => "g:ia", // options listed here: http://php.net/manual/en/function.date.php
            'hours'          => "{%open%}{%separator%}{%closed%}"
        );
        $working=new \App\Working\WorkingClass($hours,$exceptions,$template);
      echo "<br/>";
        echo '<table class="table table-bordered">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Day</th>";
        echo "<th>Working Hour</th>";
        echo "</tr>";
        echo"</thead>";
    foreach ($working->hours_this_week() as $days => $hours) {
        echo '<tr>';
        echo '<td>' . $days . '</td>';
        echo '<td>' . $hours . '</td>';
        echo '</tr>';
    }
    echo '</table>';
?>