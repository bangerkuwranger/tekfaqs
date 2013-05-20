<?php
/*
Template Name: Contact
*/
?>
<?php 

/*--------------------------------------------------------------------------------*/
$nameError = __( 'Please enter your name.', 'guerilla' );
$emailError = __( 'Please enter your email address.', 'guerilla' );
$emailInvalidError = __( 'You entered an invalid email address.', 'guerilla' );
$commentError = __( 'Please enter a message.', 'guerilla' );
/*--------------------------------------------------------------------------------*/


$errorMessages = array();
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$errorMessages['nameError'] = $nameError;
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$errorMessages['emailError'] = $emailError;
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$errorMessages['emailInvalidError'] = $emailInvalidError;
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$errorMessages['commentError'] = $commentError;
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = gt_get_option('contact_email'); 
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			
			if (gt_get_option('contact_subject')) { 
				$subject = gt_get_option('contact_subject');
			} else {
				$subject = '[Contact Form] From '.$name;
			}
			
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>
<?php get_template_part('templates/page', 'title'); ?>
<div class="page-main">
	<?php get_template_part('templates/content', 'page'); ?>
	        <!--BEGIN CONTACT -->
	        <div style="padding-left:0px" class="contact-form">

	        <?php if(isset($emailSent) && $emailSent == true) { ?>
	                <div class="alert alert-success">
	                    <?php _e('Thank you, your email was sent successfully.', 'guerilla'); ?>
	                </div>
	        <?php } else { ?>

	        <?php if(isset($hasError) || isset($captchaError)) { ?>
	            <div class="alert alert-error">
	                <?php _e('Please fill in all the fields correctly.', 'guerilla'); ?>
	            </div>
	        <?php } ?>

	        <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
	                <label class="<?php if(isset($errorMessages['nameError'])) { echo ' contact-error'; } ?>" for="contactName"><?php if(isset($errorMessages['nameError'])) { echo $errorMessages['nameError']; } else { echo __( 'Name', 'guerilla' );} ?></label>
	                    <input type="text" name="contactName" id="contact-form" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
	    
	                <label class="<?php if(isset($errorMessages['emailError'])) { echo ' contact-error'; } ?><?php if(isset($errorMessages['emailInvalidError'])) { echo ' contact-error'; } ?>" for="email"><?php if(isset($errorMessages['emailError'])) { echo $errorMessages['emailError']; } elseif (isset($errorMessages['emailInvalidError'])) { echo $errorMessages['emailInvalidError']; } else { echo __( 'Email', 'guerilla' );} ?></label>
	                    <input type="text" name="email" id="contact-form" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
	    
	                <label class="textarea<?php if(isset($errorMessages['commentError'])) { echo ' contact-error'; } ?>" for="commentsText"><?php if(isset($errorMessages['commentError'])) { echo $errorMessages['commentError']; } else { echo __( 'Message', 'guerilla' );} ?></label>
	                    <textarea name="comments" id="contact-form" rows="7" cols="30" class="required requiredField<?php if(isset($errorMessages['commentError'])) { echo ' error'; } ?>" ><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
	    <div class="form-actions1">
	                    <input type="hidden" name="submitted" id="submitted" value="true" />
	                    <button type="submit" class="btn-large btn-custom"><?php _e('Send Email', 'guerilla') ?></button>
	    </div>
	        </form>
	    <?php } ?>
	    </div><!-- END CONTACT -->	
</div>