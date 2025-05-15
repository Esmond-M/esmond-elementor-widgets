<h2>Site Admin view</h2>
<?php

  $teamLeaderArgs = array(  
    'role__in' => array( 'team_leader' ),   
);
$teamLeaderUsers = get_users( $teamLeaderArgs );

?>
    <table>
  <tr>
    <th>Number of Team Leaders: <?php echo $number_of_users = count($teamLeaderUsers); ?></th>
  </tr>   

</table> 
    <table>
  <tr>
    <th>Team Leader email</th>
    <th>Team Leader name</th>
    <th>Subordinates</th>
  </tr>
  <?php
foreach ( $teamLeaderUsers as $TeamLeaderUserInfo ) {

    $number_of_users = count($teamLeaderUsers);
 ?>

  <tr>
    <td><?php echo '<span>' . esc_html( $TeamLeaderUserInfo->user_email ) . '</span>'; ?></td>
    <td><?php echo '<span>' . esc_html( $TeamLeaderUserInfo->display_name ) . '</span>'; ?></td>
    <td>
    <?php
      $teamSubordinateArgs = array(  
        'role__in' => array( 'team_subordinate' ),   
        'meta_key'     => 'teamID',
        'meta_value'   => $TeamLeaderUserInfo->ID,       
    );
    $teamSubordinate = get_users( $teamSubordinateArgs );
    ?>  
    <?php echo $number_of_users = count($teamSubordinate); ?></td>
  </tr>

    <?php
}
?>
</table>

<?php

