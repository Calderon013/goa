<?php
 // include "../../../../../builder/controller/connection.php";
 // include "../../../../../theodore/formbuilder/controller/connection.php";
 // include "../../../sb_tools/header.php";
  include ("dbconn.php");


$outTimesheet = ""; $outExpense = ""; $outPaymentClaim = ""; $outNoPreference = "";
$query = "
  SELECT DATE_FORMAT(x.date_registered, '%Y') AS year,DATE_FORMAT(x.date_registered, '%m') - 1 AS month,DATE_FORMAT(x.date_registered, '%d') AS day, x.preference, COUNT(x.preference) as count
  FROM
  ((SELECT y.email_address, y.date_registered, 'no preference' as preference, 'desktop ads' as registered_from
  FROM cs_users as y
  JOIN smallbui_theodore.onboarding_funnel as x
  WHERE y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND y.email_address NOT LIKE '%Zac%'
      AND y.email_address NOT LIKE '%noumaan%'

        AND y.email_address NOT LIKE '%phd%'
        AND y.email_address NOT LIKE '%trial%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND y.preference = ''
        AND y.registered_from != ''
        AND y.date_registered != '0000-00-00'
        AND y.date_registered > '2018-11-06'
            AND x.ip_address != '122.3.0.162'


  )
  UNION
  (SELECT y.email_address, y.date_registered, 'no preference' as preference, 'mobile ads' as registered_from
  FROM cs_users as y
  JOIN smallbui_theodore.onboarding_funnel as x
  WHERE y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
      AND y.email_address NOT LIKE '%noumaan%'

        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%phd%'
        AND y.email_address NOT LIKE '%trial%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND y.preference = ''
        AND y.date_registered != '0000-00-00'
        AND y.date_registered >= '2018-10-01'
        AND y.date_registered <= '2018-11-06'
            AND x.ip_address != '122.3.0.162'

  )
  UNION
  (SELECT y.email_address, y.date_registered, y.preference, y.registered_from
  FROM cs_users as y
  JOIN smallbui_theodore.onboarding_funnel as x
  WHERE y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND y.email_address NOT LIKE '%Zac%'
      AND y.email_address NOT LIKE '%noumaan%'
        AND y.email_address NOT LIKE '%phd%'
        AND y.email_address NOT LIKE '%trial%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        and y.preference != ''
        AND y.date_registered != '0000-00-00'
        AND y.date_registered >= '2018-10-01'
            AND x.ip_address != '122.3.0.162'

   )
         
  )                                                                                                                                                                                                                                                                                                                                                                                                                       vv as x
  GROUP BY x.date_registered, x.preference";
   // $executedQuery = mysqli_query($csportal_con, $query);
   // if (mysqli_num_rows($executedQuery) > 0) {
   //   while ($row = mysqli_fetch_array($executedQuery)) {
   //     if ($row['preference'] == "timesheet") {
   //       $outTimesheet .= "[Date.UTC(".$row['year'].", ".$row['month'].", ".$row['day']."),".$row['count']."],";
   //     } else if ($row['preference'] == "expense") {
   //       $outExpense .= "[Date.UTC(".$row['year'].", ".$row['month'].", ".$row['day']."),".$row['count']."],";
   //     } else if ($row['preference'] == "paymentclaim") {
   //       $outPaymentClaim .= "[Date.UTC(".$row['year'].", ".$row['month'].", ".$row['day']."),".$row['count']."],";
   //     } else if ($row['preference'] == "no preference") {
   //       $outNoPreference .= "[Date.UTC(".$row['year'].", ".$row['month'].", ".$row['day']."),".$row['count']."],";
   //     }
   //   }
   // }

$query = "
  (
    SELECT
      x.step,
      COUNT(DISTINCT x.user_id) as count
    FROM
      onboarding_funnel as x
      JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
    WHERE
      action IN ('Viewed Step', 'Submit')
      AND x.timestamp >= '2018-10-10'
      AND y.email_address NOT LIKE '%test%'
      AND y.company NOT LIKE '%test%'
      AND y.email_address NOT LIKE '%demo%'
      AND y.company NOT LIKE '%demo%'
      AND y.company NOT LIKE '%Jerome%'
      AND y.company NOT LIKE '%Chic%'
      AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
      AND x.onboarding != 'Mobile Preparation'
      AND x.step IN ('Intro', 'Business Logo', 'Onboarding Selection')
      AND x.ip_address != '122.3.0.162'
      AND y.email_address NOT LIKE '%Zac%'
      AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'
    GROUP BY
      x.step
  )
  UNION
    (
      SELECT
        'Feature Introduce' as step,
        COUNT(DISTINCT x.user_id) as count
      FROM
        onboarding_funnel as x
        JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
      WHERE
        action IN ('Viewed Step', 'Submit')
        AND x.timestamp >= '2018-10-10'
        AND y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND x.onboarding != 'Mobile Preparation'
        AND x.ip_address != '122.3.0.162'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'

        AND x.step LIKE '%Introduce%'
    )
  UNION
    (
      SELECT
        'Pop Up 1' as step,
        COUNT(DISTINCT x.user_id) as count
      FROM
        onboarding_funnel as x
        JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
      WHERE
        action IN ('Viewed Step', 'Submit')
        AND x.timestamp >= '2018-10-10'
        AND y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
        AND x.ip_address != '122.3.0.162'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'

        AND x.step LIKE '%Pop Up 1%'
    )
  UNION
    (
      SELECT
        'Pop Up 2' as step,
        COUNT(DISTINCT x.user_id) as count
      FROM
        onboarding_funnel as x
        JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
      WHERE
        action IN ('Viewed Step', 'Submit')
        AND x.timestamp >= '2018-10-10'
        AND y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
        AND x.ip_address != '122.3.0.162'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'

        AND x.step LIKE '%Pop Up 2%'
    )
  UNION
    (
      SELECT
        'Completed Aha Stage' as step,
        COUNT(DISTINCT x.user_id) as count
      FROM
        onboarding_funnel as x
        JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
      WHERE
        action IN ('Viewed Step', 'Submit')
        AND x.timestamp >= '2018-10-10'
        AND y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
        AND x.ip_address != '122.3.0.162'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'

        AND x.step LIKE '%Aha'
    )
  UNION(
      SELECT
        'Completed Onboarding' as step,
        COUNT(DISTINCT x.user_id) as count
      FROM
        onboarding_funnel as x
        JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
      WHERE
        action IN ('Viewed Step', 'Submit')
        AND x.timestamp >= '2018-10-10'
        AND y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
        AND x.ip_address != '122.3.0.162'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'

        AND x.step LIKE '%Onboarding'
    )
  UNION
    (
      SELECT
        'Booked Demo Attempt' as step,
        COUNT(DISTINCT x.user_id) as count
      FROM
        onboarding_funnel as x
        JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
      WHERE
        action IN ('Viewed Step', 'Submit')
        AND x.timestamp >= '2018-10-10'
        AND y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
        AND x.ip_address != '122.3.0.162'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'

        AND x.step LIKE '%demo%'
    )
  UNION
    (
      SELECT
        'Upgrade Attempt' as step,
        COUNT(DISTINCT x.user_id) as count
      FROM
        onboarding_funnel as x
        JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
      WHERE
        action IN ('Viewed Step', 'Submit')
        AND x.timestamp >= '2018-10-10'
        AND y.email_address NOT LIKE '%test%'
        AND y.company NOT LIKE '%test%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.company NOT LIKE '%demo%'
        AND y.company NOT LIKE '%Jerome%'
        AND y.company NOT LIKE '%Chic%'
        AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
        AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
        AND x.ip_address != '122.3.0.162'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
          AND y.email_address NOT LIKE '%noumaan%'

        AND x.step LIKE '%Upgrade%'
    )
  ORDER BY
    count DESC";
$outCompletionRate = 0; $outDemoAttempt = 0; $outUpgradeAttempt = 0;
$tempIntro = 0; $tempCompleted = 0; $strOutCategory = ""; $strOutData = "";
$arraySort = array('Intro', 'Business Logo', 'Onboarding Selection', 'Feature Introduce', 'Pop Up 1', 'Pop Up 2', 'Completed Aha Stage', 'Completed Onboarding');
$arrayData = array();
 // $executedQuery = mysqli_query($theodore_con, $query);
 // if (mysqli_num_rows($executedQuery) > 0) {
   // while ($row = mysqli_fetch_array($executedQuery)) {
   //   if ($row['step'] == "Intro") {
   //     $tempIntro = $row['count'];
   //   } else if ($row['step'] == "Completed Onboarding") {
   //     $tempCompleted = $row['count'];
   //   } else if ($row['step'] == "Upgrade Attempt") {
   //     $outUpgradeAttempt = $row['count'];
   //   } else if ($row['step'] == "Booked Demo Attempt") {
   //     $outDemoAttempt = $row['count'];
   //   }

   //   if ($row['step'] != "Upgrade Attempt" && $row['step'] != "Booked Demo Attempt") {
   //     array_push($arrayData, array(
   //       'step' => $row['step'],
   //       'count' => $row['count'],
   //     ));
   //   }
   // }
   $outCompletionRate = $tempIntro == 0 ? "0" : number_format(($tempCompleted / $tempIntro) * 100);

   $bottomPart = 0;
   foreach ($arraySort as $sort) {
     foreach ($arrayData as $data) {
       if ($sort == $data['step']) {
         if ($data['step'] == "Intro") {
           $percent = 100;
           $bottomPart = $data['count'];
         } else {
           $lastPercent = $percent;
           $percent = $data['count'] == 0 ? 0 : number_format(($data['count'] / $bottomPart) * 100);
           $bottomPart = $data['count'];

           if ($lastPercent > $percent) {
             $lastPercent = $percent;
           }
         }

         $strOutCategory .= "'".$sort."',";
         $strOutData .= "
           {
             y: ".$data['count'].",
             color: '#0091dc',
             dataLabels: {
               enabled: true,
               align: 'left',
               verticalAlign: 'middle',
               format: '{y} Users (".$percent."%)',
             }
           },";
       }
     }
   }

   $strOutCategory = "[".$strOutCategory."]";
   $strOutData = "[".$strOutData."]";
 // } else {
 //   $strOutCategory = "[]";
 //   $strOutData = "[]";
 // }


if (isset($_GET['startdate']) && isset($_GET['enddate']))
  $daterange = " AND date_registered BETWEEN '".$_GET['startdate']."' AND '".$_GET['enddate']."' ";
else
  $daterange = " AND DATE(date_registered) >= CURRENT_DATE() - INTERVAL 7 DAY ";
//total users reach aha
/*$query = "
  SELECT
    COUNT(DISTINCT a.email_address) as total_users_aha
  FROM (
    SELECT
      y.email_address, x.step
    FROM
      onboarding_funnel as x
    JOIN
      smallbui_cs_portal.cs_users as y
    ON
      x.user_id = y.user_id
    WHERE
      x.action IN ('Viewed Step','Submit')
      AND x.ip_address != '122.3.0.162'
      AND y.company NOT LIKE '%Chic%'
      AND y.company NOT LIKE '%demo%'
      AND y.company NOT LIKE '%Jerome%'
      AND y.company NOT LIKE '%test%'
      AND y.email_address NOT LIKE '%demo%'
      AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
      AND y.email_address NOT LIKE '%noumaan%'
      AND y.email_address NOT LIKE '%test%'
      AND y.email_address NOT LIKE '%Zac%'
      ".$daterange."
    ORDER BY
      x.id DESC
  ) as a
  WHERE
    a.step LIKE '%Aha'";*/
  $query = "
    SELECT COUNT(DISTINCT user_id) as registered_users
    FROM smallbui_cs_portal.cs_users
    WHERE email_address NOT LIKE '%TEST%'
    AND company NOT LIKE '%TEST%'
    AND company NOT LIKE '%demo%'
    AND email_address NOT LIKE '%demo%'
    AND email_address NOT LIKE '%wordpress%'
    AND email_address NOT LIKE '%trial%'
    AND email_address NOT LIKE '%zac%'
    AND email_address NOT LIKE '%chic%'
    AND email_address NOT LIKE '%pogi%' 
    AND email_address NOT LIKE '%lophils%'
    ".$daterange."
    ORDER BY user_id DESC";
  $outTotalUserReachAha = 0;
  $executedQuery = mysqli_query($theodore_con, $query);
  if (mysqli_num_rows($executedQuery) > 0) {
    $outTotalUserReachAha = mysqli_fetch_array($executedQuery)['registered_users'];
  }

if (isset($_GET['startdate']) && isset($_GET['enddate']))
  $daterange = " AND y.date_registered BETWEEN '".$_GET['startdate']."' AND '".$_GET['enddate']."' ";
else
  $daterange = " AND DATE(y.date_registered) >= CURRENT_DATE() - INTERVAL 7 DAY ";

//total users finished onboarding
$query = "
  SELECT
    COUNT(DISTINCT a.email_address) as total_users_completed
  FROM (
    SELECT
      y.email_address, x.step
    FROM
      onboarding_funnel as x
    JOIN
      smallbui_cs_portal.cs_users as y
    ON
      x.user_id = y.user_id
    WHERE
      x.action IN ('Viewed Step', 'Submit')
      AND x.ip_address != '122.3.0.162'
      AND y.company NOT LIKE '%Chic%'
      AND y.company NOT LIKE '%demo%'
      AND y.company NOT LIKE '%Jerome%'
      AND y.company NOT LIKE '%test%'
      AND y.email_address NOT LIKE '%demo%'
      AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
      AND y.email_address NOT LIKE '%noumaan%'
      AND y.email_address NOT LIKE '%test%'
      AND y.email_address NOT LIKE '%Zac%'
      ".$daterange."
    ORDER BY
      x.id DESC
  ) as a
  WHERE
    a.step LIKE '%Onboarding'";
$outTotalUserFinishOnboarding = 0;
$executedQuery = mysqli_query($theodore_con, $query);
if (mysqli_num_rows($executedQuery) > 0) {
  $outTotalUserFinishOnboarding = mysqli_fetch_array($executedQuery)['total_users_completed'];
}

//total users quit onboarding
$query = "
  SELECT
    COUNT(DISTINCT a.email_address) as total_users_exit
  FROM (
    SELECT
      y.email_address, x.action
    FROM
      onboarding_funnel as x
    JOIN
      smallbui_cs_portal.cs_users as y
    ON
      x.user_id = y.user_id
    WHERE
      x.ip_address != '122.3.0.162'
      AND y.company NOT LIKE '%Chic%'
      AND y.company NOT LIKE '%demo%'
      AND y.company NOT LIKE '%Jerome%'
      AND y.company NOT LIKE '%test%'
      AND y.email_address NOT LIKE '%demo%'
      AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
      AND y.email_address NOT LIKE '%noumaan%'
      AND y.email_address NOT LIKE '%test%'
      AND y.email_address NOT LIKE '%Zac%'
      ".$daterange."
    ORDER BY
      x.id DESC
  ) as a
  WHERE
    a.action = 'Exit Onboarding'";
$outTotalUserQuitOnboarding = 0;
$executedQuery = mysqli_query($theodore_con, $query);
if (mysqli_num_rows($executedQuery) > 0) {
  $outTotalUserQuitOnboarding = mysqli_fetch_array($executedQuery)['total_users_exit'];
}

//total users no onboarding
$query = "
  SELECT
  COUNT(DISTINCT x.email_address) as total_no_onboarding
  FROM
    (
      SELECT
        y.user_id,
        CONCAT(y.user_fname, ' ', y.user_lname) as name,
        y.company,
        y.email_address,
        y.date_registered,
        y.preference,
        y.registered_from
      FROM
        cs_users as y
        JOIN smallbui_theodore.onboarding_funnel as x ON (y.user_id = x.user_id)
      WHERE
        email_address NOT LIKE '%TEST%'
        AND company NOT LIKE '%TEST%'
        AND company NOT LIKE '%demo%'
        AND y.email_address NOT LIKE '%demo%'
        AND y.email_address NOT LIKE '%wordpress%'
        AND y.email_address NOT LIKE '%trial%'
        AND y.email_address NOT LIKE '%zac%'
        AND y.email_address NOT LIKE '%chic%'
        AND y.email_address NOT LIKE '%pogi%'
        AND y.email_address NOT LIKE '%lophils%'
        AND y.email_address NOT LIKE '%noumaan%'
        AND y.email_address NOT LIKE '%Zac%'
        AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
        AND x.ip_address != '122.3.0.162'
        AND y.preference = ''
        AND y.date_registered != '0000-00-00'
        AND y.date_registered >= '2018-10-10'
      ORDER BY
        user_id DESC
    ) as x";
$outTotalUserNoOnboarding = 0;
 // $executedQuery = mysqli_query($csportal_con, $query);
 // if (mysqli_num_rows($executedQuery) > 0) {
 //   $outTotalUserNoOnboarding = mysqli_fetch_array($executedQuery)['total_no_onboarding'];
 // }

//new users today
$query = "
  SELECT user_id, company, email_address, registered_from, date_registered FROM cs_users 
  WHERE email_address NOT LIKE '%TEST%'
  AND company NOT LIKE '%TEST%'
  AND company NOT LIKE '%demo%'
  AND email_address NOT LIKE '%demo%'
  AND email_address NOT LIKE '%wordpress%'
  AND email_address NOT LIKE '%trial%'
  AND email_address NOT LIKE '%zac%'
  AND email_address NOT LIKE '%chic%'
  AND email_address NOT LIKE '%pogi%'
  AND email_address NOT LIKE '%lophils%'
  AND DATE(date_registered) >= CURRENT_DATE() - INTERVAL 7 DAY
  GROUP BY email_address
  ORDER BY user_id DESC";
$outNewUserToday = "";
 // $executedQuery = mysqli_query($csportal_con, $query);
 // if (mysqli_num_rows($executedQuery) > 0) {
 //   while ($row = mysqli_fetch_array($executedQuery)) {
 //     $outNewUserToday .= "
 //       <tr>
 //         <td>".$row['user_id']."</td>
 //         <td>".$row['company']."</td>
 //         <td>".$row['email_address']."</td>
 //       </tr>";
 //   }
 // }

//user registration source
$query = "
  SELECT x.registered_From, COUNT(DISTINCT x.user_id) as count FROM
  (SELECT user_id, CONCAT(user_fname,' ',user_lname) as name, company, email_address, date_registered, preference, registered_from FROM cs_users 
  WHERE email_address NOT LIKE '%TEST%'
  AND company NOT LIKE '%TEST%'
  AND company NOT LIKE '%demo%'
  AND email_address NOT LIKE '%demo%'
  AND email_address NOT LIKE '%wordpress%'
  AND email_address NOT LIKE '%trial%'
  AND email_address NOT LIKE '%zac%'  
  AND email_address NOT LIKE '%zac%'
  AND email_address NOT LIKE '%chic%'
  AND email_address NOT LIKE '%pogi%'
  AND email_address NOT LIKE '%lophils%'
  AND date_registered != '0000-00-00'
  AND date_registered >= '2018-10-10'
  ORDER BY user_id DESC
  ) as x
  GROUP BY x.registered_from";
$outUserRegistrationFacebook = 0; $outUserRegistrationLinkedIn = 0; $outUserRegistrationGoogleAds = 0; $outUserRegistrationWebSearch = 0;
 // $executedQuery = mysqli_query($csportal_con, $query);
 // if (mysqli_num_rows($executedQuery) > 0) {
 //   while ($row = mysqli_fetch_array($executedQuery)) {
 //     if ($row['registered_From'] == "") {
 //       $outUserRegistrationWebSearch = $row['count'];
 //     } else if ($row['registered_From'] == "ads.smallbuilders.com.au/facebooksup151018-residential_builders/" || $row['registered_From'] == "sb ads") {
 //       $outUserRegistrationFacebook = $row['count'];
 //     } else if ($row['registered_From'] == "ads.smallbuilders.com.au/Linkedin-101818-residential_builders") {
 //       $outUserRegistrationLinkedIn = $row['count'];
 //     } else if ($row['registered_From'] == "") {
 //       $outUserRegistrationWebSearch = $row['count'];
 //     }
 //   }
 // }
?>



<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" type="text/css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css"></link>
<link rel="stylesheet" href="../../extensions/Editor/css/editor.dataTables.min.css" type="text/css"></link>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="../../extensions/Editor/js/dataTables.editor.min.js"></script> -->

<style>
.custom-breadcrumb{
    list-style:none;
    overflow: hidden;
}

.custom-breadcrumb li {
    text-decoration: none; 
    padding: 20px 0 20px 55px;
    position: relative; 
    display: block;
    float: left;

}

.custom-breadcrumb li:after {
    content: " ";
    display: block;
    width: 0; 
    height: 70px;
    border-top: 50px solid transparent;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 50%;
    margin-top: -50px;
    left: 100%;
    z-index: 2;
}

.custom-breadcrumb li:before {
    content: " "; 
  display: block; 
  width: 0; 
  height: 70px ;
  border-top: 50px solid transparent;       
  border-bottom: 50px solid transparent;
  border-left: 30px solid black;
  position: absolute;
  top: 50%;
  margin-top: -50px; 
  margin-left: 1px;
  left: 100%;
  z-index: 1;
}

.blue-crumb{
    background-color: #2980b9;
    color: white;
}
.blue-crumb:after{
    border-left:30px solid #2980b9;
}

.gray-crumb{
    background-color: #bdc3c7;
}
.gray-crumb:after{
    border-left: 30px solid #bdc3c7;
}

.light-blue-crumb:after{
    border-left:30px solid #BCC6CC ;
}
.light-blue-crumb{
    background: #BCC6CC  ;
    color: white;
}

.faded-crumb:after{
    border-left:30px solid #ecf0f1;
}

.faded-crumb{
    background: #ecf0f1;
    color: #95a5a6;
}

.current {
    
}

.row{
    padding: 8px;
}

.steps {

  padding: 20px;
  overflow: hidden;
}
.steps a {
  color: black;
  text-decoration: none;
}

.steps li {
  float: left;
  margin-left: 0;
  width: 179px; /* 100 / number of steps */
  height: 90px; /* total height */
  list-style-type: none;
  padding: 10px 20px 20px 20px; /* padding around text, last should include arrow width */
  border-right: 2px solid #BDCBDD; /* width: gap between arrows, color: background of document */
  position: relative;
}
/* remove extra padding on the first object since it doesn't have an arrow to the left */
.steps li:first-child {
  padding-left: 20px;
}
/* white arrow to the left to "erase" background (starting from the 2nd object) */
.steps li:nth-child(n+2)::before {
  position: absolute;
  top:0;
  left:0;
  display: block;
  border-left: 25px solid #00000036 ; /* width: arrow width, color: background of document */
  border-top: 40px solid transparent; /* width: half height */
  border-bottom: 40px solid transparent; /* width: half height */
  width: 0;
  height: 0;
  content: " ";
}
/* colored arrow to the right */
.steps li::after {
  z-index: 1; /* need to bring this above the next item */
  position: absolute;
  top: 0;
  right: -25px; /* arrow width (negated) */
  display: block;
  border-left: 25px solid black; /* width: arrow width */
  border-top: 40px solid transparent; /* width: half height */
  border-bottom: 40px solid transparent; /* width: half height */
  width:0;
  height:50px;
  content: " ";
}


.steps li { background-color: #C7D5E7; }
.steps li::after { border-left-color: #C7D5E7; }


</style>

<div class="row">
  <div class="col-sm-3">
    <div class="card" onclick="popUpReport('onboardingfunnel/userreachaha.php');" style="cursor: pointer; padding: 25px;">
      <div class="card-content">
        <h4><center>Registrations</center></h4>
        <h5><center><?php
          if (isset($_GET['startdate']) && isset($_GET['enddate'])) echo $_GET['startdate']." - ".$_GET['enddate'];
          else echo "Last 7 days";
        ?></center></h5>
        <h1 class="text-center" style="color: rgb(0, 61, 109);"><?php echo $outTotalUserReachAha; ?></h1>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-content" onclick="popUpReport('onboardingfunnel/userfinishonboarding.php');" style="cursor: pointer; padding: 40px;">
       <h4><center>Completed Onboarding</center></h4>
        <h5><center><?php
          if (isset($_GET['startdate']) && isset($_GET['enddate'])) echo $_GET['startdate']." - ".$_GET['enddate'];
          else echo "Last 7 days";
        ?></center></h5>
        <h1 class="text-center" style="color: rgb(0, 61, 109);"><?php echo $outTotalUserFinishOnboarding; ?></h1>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-content" onclick="popUpReport('onboardingfunnel/userquitonboarding.php');" style="cursor: pointer; padding: 40px;">
       <h4><center>Conversions</center></h4>
        <h5><center><?php
          if (isset($_GET['startdate']) && isset($_GET['enddate'])) echo $_GET['startdate']." - ".$_GET['enddate'];
          else echo "Last 7 days";
        ?></center></h5>
        <h1 class="text-center" style="color: rgb(0, 61, 109);"><?php echo $outTotalUserQuitOnboarding; ?></h1>
      </div>
    </div>
  </div>
<div class="col-sm-3">
    <div class="card">
      <div class="card-content" onclick="popUpReport('onboardingfunnel/userquitonboarding.php');" style="cursor: pointer; padding: 30px;">
       <h4><center>New Users Average Days Active</center></h4>
        <h5><center><?php
          if (isset($_GET['startdate']) && isset($_GET['enddate'])) echo $_GET['startdate']." - ".$_GET['enddate'];
          else echo "Last 7 days";
        ?></center></h5>
        <h1 class="text-center" style="color: rgb(0, 61, 109);"><?php echo $outTotalUserQuitOnboarding; ?></h1>
      </div>
    </div>
  </div>
</div>

<div  class="container" style="margin-left: 0px;">
<div class="row">
<ul class="steps" style="width: 120%;">
  <center>
  <li style=" width: 10%; border-radius: 3px ;"><a href="#" title=""><span>Intro</span><br><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>
  <li style="width: 10%;"><a href="#" title=""><span>On Boarding Selection</span><br><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>
  <li ><a href="#" title=""><span>Completed Aha Phase</span><br><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>
  <li ><a href="#" title=""><span>Complete Onboarding</span><br><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>
   <li style="border-right: 0   "><a href="#" title=""><span>New <br>Project<br></span><Br><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>
     <li style="border-right: 30px "><a href="#" title=""><span>Completed <br>  Business Profile<br></span><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>
       <li style=" border-right: 30px "><a href="#" title=""><span>Added <br> Contacts</span><br><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>
  <li style=" border-right: 25px  solid transparent ; border-radius: 3px; /* width: arrow width */"><a href="#" title="" ><span>Converted</span><br><br><span>25 Users</span><br><span><?php echo $outTotalUserQuitOnboarding; ?></span></a></li>  
</center>
</ul>
</div>
</div>

<div style="margin-left: 1%; margin-bottom: 5px;">

    <div class="col-sm-12" style="display: inline-block;">
        <div class="card">
            <div class="card-content">
           <div class="dropdown" style="display: ">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
           <span class="caret"></span></button>
           <ul class="dropdown-menu">
          <li><a href="#">Onbaording User Summary</a></li>
         <li><a href="#">Link 2</a></li>
        <li><a href="#">Link 3</a></li>
    </ul>
  </div>
</div>
              
            </div>
        </div>
</div>

  <div style="margin-left: 2%;  ">
    <table id="dataTable" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">

   
        <thead>
            <tr>
                <th><center>User ID</center></th>
                <th><center>Name(Email Address)</center></th>
                <th><center>Onboarding Completion</center></th>
                <th><center>Tried Other Features?</center></th>
                <th><center>Created Project?</center></th>
                 <th><center>Upgraded?</center></th>
                <th><center>Date Registered</center></th>
                <th><center>Days Used</center></th>
            </tr>
        </thead>
        <tbody>
            <?php



            $selectRecord = "SELECT
              x.*,
              y.onboarding_completion,
              b.tried_other_onboarding,
              a.new_project,
              z.upgraded,
              x.date_registered,
              c.no_of_days_used
            FROM (
              SELECT
                x.user_id,
                CONCAT(
                  y.user_fname,
                  ' ',
                  y.user_lname,
                  ' (',
                  y.email_address,
                  ')'
                ) as name,
                y.date_registered
              FROM
                onboarding_funnel as x
                JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
              WHERE
                action IN ('Viewed Step', 'Submit')
                AND x.timestamp >= '2018-10-10' 
                AND y.email_address NOT LIKE '%test%'
                AND y.company NOT LIKE '%test%'
                AND y.email_address NOT LIKE '%demo%'
                AND y.company NOT LIKE '%demo%'
                AND y.company NOT LIKE '%Jerome%'
                AND y.company NOT LIKE '%Chic%'
                AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                AND x.onboarding != 'Mobile Preparation'
                AND x.step IN ('Intro', 'Onboarding Selection')
                AND x.ip_address != '122.3.0.162'".$daterange."
                AND y.email_address NOT LIKE '%Zac%'
                AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                AND y.email_address NOT LIKE '%noumaan%'
              GROUP BY
                x.user_id
            ) as x

            LEFT JOIN (
              SELECT
                x.user_id,
                CONCAT(ROUND((COUNT(x.user_id) / 9 * 100)), '%') as onboarding_completion
              FROM (
                (
                  SELECT
                    x.step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding != 'Mobile Preparation'
                    AND x.step IN ('Intro', 'Onboarding Selection')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                  GROUP BY
                    x.step,
                    x.user_id
                )
                UNION (
                  SELECT
                    'Pop Up 1' as step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                    AND x.step LIKE '%Pop Up 1%'
                )
                UNION (
                  SELECT
                    'Pop Up 2' as step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                    AND x.step LIKE '%Pop Up 2%'
                )
                UNION (
                  SELECT
                    'Completed Aha Stage' as step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
                    AND x.ip_address != '122.3.0.162' 
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                    AND x.step LIKE '%Aha'
                )
                UNION (
                  SELECT
                    'Completed Onboarding' as step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                    AND x.step LIKE '%Onboarding'
                )
                UNION (
                  SELECT
                    'Explore Report' as step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                    AND x.step LIKE '%Explore%'
                )
                UNION (
                  SELECT
                    'Feature Video 1' as step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10' 
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
                    AND x.ip_address != '122.3.0.162' 
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                    AND x.step LIKE '%Video%'
                    AND x.step NOT LIKE '%Report%'
                )
                UNION (
                  SELECT
                    'Feature Video 2' as step,
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding NOT IN ('Site Diary', 'CEO Report', 'Forecast')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                    AND x.step LIKE '%Report Video%'
                )
              ) as x
              GROUP BY
                x.user_id
            ) as y ON (x.user_id = y.user_id)

            LEFT JOIN (
              SELECT
                y.user_id,
                'Yes' as upgraded
              FROM
                smallbui_cs_portal.cs_user_activity as y
              WHERE
                y.user_id IN (
                  SELECT
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding != 'Mobile Preparation'
                    AND x.step IN ('Intro', 'Onboarding Selection')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                  GROUP BY
                    x.user_id
                )
                AND y.page_name = 'Upgrade to Business'
                AND y.activity LIKE '%Submit%'
            ) as z ON (x.user_id = z.user_id)
              
            LEFT JOIN (
              SELECT
                y.user_id,
                'Yes' as new_project
              FROM
                smallbui_cs_portal.cs_user_activity as y
              WHERE
                y.user_id IN (
                  SELECT
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding != 'Mobile Preparation'
                    AND x.step IN ('Intro', 'Onboarding Selection')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                  GROUP BY
                    x.user_id
                )
                AND y.page_name LIKE '%Dashboard%'
                AND y.activity LIKE '%Submit%'
              GROUP BY
                y.user_id
            ) as a ON (a.user_id = x.user_id)

            LEFT JOIN (
              SELECT
                y.user_id,
                CASE WHEN COUNT(DISTINCT y.onboarding) > 1 THEN 'Yes' ELSE 'No' END as tried_other_onboarding
              FROM
                onboarding_funnel as y
              WHERE
                y.user_id IN (
                  SELECT
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding != 'Mobile Preparation'
                    AND x.step IN ('Intro')
                    AND x.ip_address != '122.3.0.162'
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'
                  GROUP BY
                    x.user_id
                )
                AND y.onboarding NOT LIKE '%Preparation%'
              GROUP BY
                y.user_id
            ) as b ON (b.user_id = x.user_id)
              
            LEFT JOIN (
              SELECT
                y.user_id,
                COUNT(DISTINCT DATE(y.log_date)) as no_of_days_used
              FROM
                smallbui_cs_portal.cs_user_activity as y
              WHERE
                y.user_id IN (
                  SELECT
                    x.user_id
                  FROM
                    onboarding_funnel as x
                    JOIN smallbui_cs_portal.cs_users as y ON (x.user_id = y.user_id)
                  WHERE
                    action IN ('Viewed Step', 'Submit')
                    AND x.timestamp >= '2018-10-10'
                    AND y.email_address NOT LIKE '%test%'
                    AND y.company NOT LIKE '%test%'
                    AND y.email_address NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%demo%'
                    AND y.company NOT LIKE '%Jerome%'
                    AND y.company NOT LIKE '%Chic%'
                    AND CONCAT(y.user_fname, '', y.user_lname) NOT LIKE '%test%'
                    AND x.onboarding != 'Mobile Preparation'
                    AND x.step IN ('Intro', 'Onboarding Selection')
                    AND x.ip_address != '122.3.0.162' 
                    AND y.email_address NOT LIKE '%Zac%'
                    AND y.email_address NOT LIKE '%efficient.fitness@outlook.com%'
                    AND y.email_address NOT LIKE '%noumaan%'

                  GROUP BY
                    x.user_id
                )
              GROUP BY
                y.user_id
            ) as c ON (c.user_id = x.user_id)";
            $selectRecordResult = $theodore_con->query($selectRecord);

            if($selectRecordResult -> num_rows > 0) {

                while($Recordtbl = $selectRecordResult->fetch_assoc()) {

                    echo "<br>";
                    echo "<td>",$Recordtbl['user_id'], "</td>";
                    echo "<td>",$Recordtbl['name'], "</td>";
                    echo "<td>",$Recordtbl['onboarding_completion'], "</td>";
                    echo "<td>",$Recordtbl['tried_other_onboarding'], "</td>";
                    echo "<td>",$Recordtbl['new_project'], "</td>";
                    echo "<td>",$Recordtbl['upgraded'], "</td>";
                    echo "<td>",$Recordtbl['date_registered'], "</td>";
                    echo "<td>",$Recordtbl['no_of_days_used'], "</td>";
                  
                    echo "</tr>";
                }

            }
        else{
            echo "No entries";
        }
        ?>
        </tbody>
    </table>
</div>

<div id="divForTableReport"></div>

<script type="text/javascript">
  function loadTableReport(url) {
    $('#divForTableReport').html("<section style='text-align:center;padding:50px;'><h5 style='font-weight:bold;'>Please wait one moment...</h5><img src='<?php echo asset_host(); ?>/builder/portal/controller/formsource/dashboard_graph/loadingAnimation.gif'></section>");

    $.ajax({
      type: "GET",
      url: url,
      success: function(data) {
        $('#divForTableReport').html(data);
      },
      error: function(data) {
        $('#divForTableReport').html("Unexpected Error Occured");
      }
    });
  }

    $(document).ready(function() {
      Highcharts.chart('divOnboardingGraph', {
          chart: {
              type: 'column'
          },
          title: {
              text: ''
          },
          xAxis: {
            type: 'datetime'
          },
          yAxis: {
            title: {
              text: '',
            },
            tickInterval: 1,
          },
          plotOptions: {
            column: {
              stacking: 'normal',
              dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
              }
            }
          },
          series: [{
            name: 'Timesheet',
            data: [<?php echo $outTimesheet; ?>],
          }, {
            name: 'PCS',
            data: [<?php echo $outPaymentClaim; ?>],
          }, {
            name: 'Expense',
            data: [<?php echo $outExpense; ?>],
          }, {
            name: 'No Preference',
            data: [<?php echo $outNoPreference ?>],
          }],
          credits: {
              enabled: false,
          }
      });

      var chart = new Highcharts.Chart({
          chart: {
              renderTo: 'divDashboardOnboarding',
              marginLeft:120,
              type: 'bar',
          },
          legend: {
              enabled: false
          },
          colors: ['#173c64'],
          xAxis: {
              categories: <?php echo $strOutCategory; ?>,
              labels: {
                  reserveSpace: true,
                  align: 'left'
              }
          },
          yAxis: {
              lineWidth: 0,
              gridLineWidth: 0,
              lineColor: 'transparent',
              labels: {
                  enabled: false
              },  
              minorTickLength: 0,
              tickLength: 0,
              title: {
                  enabled: false
              }
          },
          plotOptions: {
              bar: {
                  stacking: "normal",
                  pointWidth: 25
              }
          },
          title: {
              text: '',
          },
          series: [{
              data: <?php echo $strOutData; ?>,
          }],
          credits: {
              enabled: false,
          }
      });
    });
</script>

<script>
    $(document).ready(function() {
    $('#dataTable').DataTable( {      
         "searching": true,
         "paging": true, 
         "info": true,         
         "lengthChange":true 
    } );
  </script>
