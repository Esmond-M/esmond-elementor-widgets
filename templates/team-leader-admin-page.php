

<?php 

/** 
 * If user has is a Website admin allow emulation
*/
if ( current_user_can( 'manage_options' ) ) {
  $teamLeaderArgs = array(  
    'role__in' => array( 'team_leader' ),  
);
$teamLeaderUsers = get_users( $teamLeaderArgs );
if( count($teamLeaderUsers) == 0){
  wp_die('<p>No Team leader user to emulate</p>');
}

?>
<div class="emulation-form">
<h2>Emulate User to View Subordinates</h2>
<form id="emulate-team-leader-form" method="POST" action="">
<select name="teamLeaderSelectOption" form="emulate-team-leader-form">

  <?php
foreach ( $teamLeaderUsers as $user ) {
  ?>
  <option value="<?php echo $user->ID; ?>"><?php echo $user->user_login; ?></option>
<?php  
}
?>
    </select>
    <input type="hidden" name="action" value="emulate_Team_Leader_Form_Submission" />
    <input type="submit" value="submit">    
</form>

<?php

} 

/** 
 * If user has Team Leader role
*/
if ( !current_user_can( 'manage_options' ) ) {
  $teamLeaderArgs = array(  
    'role__in' => array( 'team_subordinate' ),
    'meta_key'     => 'teamID',
    'meta_value'   => $user->ID,    
);
$teamLeaderUsers = get_users( $teamLeaderArgs );
// Array of WP_User objects.
?>
<h2>View Subordinates</h2>
<form id="team-leader-form" method="POST" action="">
    <table>
  <tr>
    <th>Number of Subordinates</th>
    <th>Action</th>
  </tr>
  <?php
    $number_of_users = count($teamLeaderUsers);
 ?>
  <tr>
    <td><?php echo '<span>' . esc_html( $number_of_users) . '</span>'; ?></td>
    <td>
      <select name="teamLeaderSelectOption" form="team-leader-form">
        <option value="delete">Delete</option>
        <option value="resend">Send Password Reset Link</option>
      </select>
    </td>  
  </tr>
    
    <?php
?>
</table> 
    <table>
  <tr>
    <th>Subordinate email</th>
    <th>Subordinate name</th>
    <th>Select Subordinate</th>
  </tr>
  <?php
foreach ( $teamLeaderUsers as $user ) {

    $number_of_users = count($teamLeaderUsers);
 ?>

  <tr>
    <td><?php echo '<span>' . esc_html( $user->user_email ) . '</span>'; ?></td>
    <td><?php echo '<span>' . esc_html( $user->display_name ) . '</span>'; ?></td>
    <td><input type="checkbox" name="userID[]" value="<?php echo $user->ID;  ?>"/></td>
  </tr>

  
    
    <?php
}
?>
</table>
<?php wp_nonce_field( 'team_Leader_Form_Submission', 'team_Leader_Form_Submission_nonce_field' ); ?>
<input type="hidden" name="action" value="team_Leader_Form_Submission" />
<input type="submit" value="submit">
</form> 

<?php
} 

