<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'tekserve_redirect_genesis_404' );

 
/**
 * URL REDIRECT - dgiglio@tekserve.com
 *
 * urls must NOT begine with http://
 * urls must use * for wildcards in addition to setting wildcard and/or preserve_path key to true
 * this is not currently set up to with redirects based on query strings
 * the old url CANNOT contain a hash (#) as this is not available to the server
 * broadest urls must be at the end of the list! -> tekserve.com/cpus/mac/* before teksere.com/cpus/* before tekserve.com/* 
 */
 
 // redirect rules array
$redirect_rules = array(
	array('old_url'       => 'www.tekserve.com/blog/wp-content/uploads/2012/12/TekserveCreditCardApprovalForm.pdf', 
		  'new_url'       => 'rentals.teksserve.com/wp-content/uploads/2014/03/TekserveCreditCardApprovalForm.pdf', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	
	array('old_url'       => 'www.tekserve.com/business/deploy_cvapps', 
		  'new_url'       => 'www.tekserve.com/business-solutions/deploy_cvapps', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	
	
	array('old_url'       => 'www.tekserve.com/service/mac-repairs-and-upgrades', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/#mac-repair', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/service/iphone-service', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/#iphone', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/service/data-backup-and-recovery', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/#backup-recovery', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/status', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/#status', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/service/trade-in', 
		  'new_url'       => 'www.tekserve.com/trade-in', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/service/recycling', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/#tradein-recycling', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),
	array('old_url'       => 'www.tekserve.com/recycling', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/#tradein-recycling', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/service/*', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals', 
		  'new_url'       => 'rentals.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/rates', 
		  'new_url'       => 'rentals.tekserve.com/#request', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment', 
		  'new_url'       => 'rentals.tekserve.com/#request', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/request-rental', 
		  'new_url'       => 'rentals.tekserve.com/#request', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/rental-faq', 
		  'new_url'       => 'rentals.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/retina', 
		  'new_url'       => 'rentals.tekserve.com/#ios-devices', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/macbook-pro', 
		  'new_url'       => 'rentals.tekserve.com/#ios-devices', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/mac-pro', 
		  'new_url'       => 'rentals.tekserve.com/#mac-portables', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/ipad', 
		  'new_url'       => 'rentals.tekserve.com/#request', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/imac#mini', 
		  'new_url'       => 'rentals.tekserve.com/#mac-portables', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/displays', 
		  'new_url'       => 'rentals.tekserve.com/#accessories', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/projectors', 
		  'new_url'       => 'rentals.tekserve.com/#accessories', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/accessories', 
		  'new_url'       => 'rentals.tekserve.com/#accessories', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/vintage-electronics', 
		  'new_url'       => 'rentals.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/ipad#mini', 
		  'new_url'       => 'rentals.tekserve.com/#ios-devices', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/ipad#ipod', 
		  'new_url'       => 'rentals.tekserve.com/#request', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/imac#imac', 
		  'new_url'       => 'rentals.tekserve.com/#mac-portables', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/rentals/equipment/imac', 
		  'new_url'       => 'rentals.tekserve.com/#mac-portables', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	    
	array('old_url'       => 'www.tekserve.com/rentals/*', 
		  'new_url'       => 'rentals.tekserve.com/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/insiders/how-to-join/', 
		  'new_url'       => 'www.tekserve.com/insider/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/insiders/*', 
		  'new_url'       => 'www.tekserve.com/insider/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/insider_mac/', 
		  'new_url'       => 'www.tekserve.com/insider/#mac', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/insider_ipad/', 
		  'new_url'       => 'www.tekserve.com/insider/#ipad', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/insider-members/', 
		  'new_url'       => 'www.tekserve.com/insider/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/insider-terms-conditions/', 
		  'new_url'       => 'www.tekserve.com/insider/#insider-terms-and-conditions', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/tekserve-events/', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/tekserve-events/*', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/events/tekserve-academy/', 
		  'new_url'       => 'events.tekserve.com/tekserve-academy', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/events/creative-fridays/', 
		  'new_url'       => 'events.tekserve.com/creative-fridays', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/events/', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE ),		  
		  
	array('old_url'       => 'www.tekserve.com/events/*', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/knowledge/*', 
		  'new_url'       => 'faq.tekserve.com/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/faq-menu/', 
		  'new_url'       => 'faq.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	 
	array('old_url'       => 'www.tekserve.com/blog-menu/', 
		  'new_url'       => 'blog.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	 
	array('old_url'       => 'www.tekserve.com/blog/', 
		  'new_url'       => 'blog.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/blog/*', 
		  'new_url'       => 'blog.tekserve.com/*', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => TRUE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/blog/', 
		  'new_url'       => 'blog.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/blog/*', 
		  'new_url'       => 'blog.tekserve.com/*', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => TRUE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Blog/', 
		  'new_url'       => 'blog.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Blog/*', 
		  'new_url'       => 'blog.tekserve.com/*', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => TRUE ),
		  
		  
	array('old_url'       => 'www.tekserve.com/about/store-location-and-hours/', 
		  'new_url'       => 'www.tekserve.com/about-us/#hours-directions', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/about/contact-us', 
		  'new_url'       => 'www.tekserve.com/about-us/#contact', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/about/careers/', 
		  'new_url'       => 'www.tekserve.com/careers', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/about/social-responsibility/', 
		  'new_url'       => 'www.tekserve.com/social-responsibility/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/about/press/', 
		  'new_url'       => 'www.tekserve.com/press-mentions/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/about/media-resources/', 
		  'new_url'       => 'www.tekserve.com/about-us/#forpress', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/about/history/', 
		  'new_url'       => 'www.tekserve.com/about-us/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/about/*', 
		  'new_url'       => 'www.tekserve.com/about-us/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE ),		  
		  
	array('old_url'       => 'www.tekserve.com/business/products/', 
		  'new_url'       => 'www.tekserve.com/vendors/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/products/*', 
		  'new_url'       => 'www.tekserve.com/vendors/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business-case-studies/', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/case-studies/', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/case-studies/*', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business-knowledge/', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business-knowledge/*', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business-contact-us/', 
		  'new_url'       => 'www.tekserve.com/business/#contact', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Contact-Us/', 
		  'new_url'       => 'www.tekserve.com/business/#contact', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/iPad-and-iPhone-Integration/', 
		  'new_url'       => 'www.tekserve.com/business/#ios', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/iPad-and-iPhone-Integration/*', 
		  'new_url'       => 'www.tekserve.com/business/#ios', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/events/*', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE ),

	array('old_url'       => 'www.tekserve.com/business-events/', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business-events/*', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Managed-IT-Solutions/*', 
		  'new_url'       => 'www.tekserve.com/business/#services', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Managed-IT-Solutions/', 
		  'new_url'       => 'www.tekserve.com/business/#services', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE ),		  
		  
	array('old_url'       => 'www.tekserve.com/business/Professional-Audio/', 
		  'new_url'       => 'www.tekserve.com/business/#creative', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE ),

	array('old_url'       => 'www.tekserve.com/business/Professional-Audio/*', 
		  'new_url'       => 'www.tekserve.com/business/#creative', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE ),

	array('old_url'       => 'www.tekserve.com/business/Professional-Video/', 
		  'new_url'       => 'www.tekserve.com/business/#creative', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Professional-Video/*', 
		  'new_url'       => 'www.tekserve.com/business/#creative', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Digital-Publishing/*', 
		  'new_url'       => 'www.tekserve.com/business/#creative', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Digital-Publishing/', 
		  'new_url'       => 'www.tekserve.com/business/#creative', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Customized-Training/', 
		  'new_url'       => 'www.tekserve.com/business/#services', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Customized-Training/*', 
		  'new_url'       => 'www.tekserve.com/business/#services', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Data-Storage-and-Security/', 
		  'new_url'       => 'www.tekserve.com/business/#fulfillment', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Data-Storage-and-Security/*', 
		  'new_url'       => 'www.tekserve.com/business/#fulfillment', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Press/', 
		  'new_url'       => 'www.tekserve.com/press-mentions', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Press/*', 
		  'new_url'       => 'www.tekserve.com/press-mentions', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/hours-and-location/', 
		  'new_url'       => 'www.tekserve.com/business/#hours-directions', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/careers/', 
		  'new_url'       => 'www.tekserve.com/careers/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/about/management-team/', 
		  'new_url'       => 'www.tekserve.com/about-us/#executive-team', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/about/social-responsibility/', 
		  'new_url'       => 'www.tekserve.com/social-responsibility', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/press-resources/', 
		  'new_url'       => 'www.tekserve.com/about-us/#forpress', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/about/history/', 
		  'new_url'       => 'www.tekserve.com/about-us/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/Mac-Service/', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/#mac-repair', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/rentals-and-leasing', 
		  'new_url'       => 'rentals.tekserve.com/leasing', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/newsletter', 
		  'new_url'       => 'www.tekserve.com/#footer', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE ),

	array('old_url'       => 'www.tekserve.com/business/*', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/youtube', 
		  'new_url'       => 'www.youtube.com/tekserve', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/teknews/', 
		  'new_url'       => 'www.tekserve.com/#footer', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/twitter', 
		  'new_url'       => 'www.twitter.com/tekserve', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/training', 
		  'new_url'       => 'www.tekserve.com/business-solutions/#services', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/tradein', 
		  'new_url'       => 'www.tekserve.com/trade-in', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/tekserve-insiders/', 
		  'new_url'       => 'www.tekserve.com/insider/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/tekserve-business-site/', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/store/weborderfaq.php', 
		  'new_url'       => 'www.tekserve.com/ordering-shipping-returns', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/ordering-returns/', 
		  'new_url'       => 'www.tekserve.com/ordering-shipping-returns/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/store/trade-in.php', 
		  'new_url'       => 'www.tekserve.com/trade-in/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/status/index.php', 
		  'new_url'       => 'www.tekserve.com/service/#status', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),	  
	array('old_url'       => 'www.tekserve.com/business/', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => FALSE, 
		  'preserve_path' => FALSE 
	),
	array('old_url'       => 'www.tekserve.com/rentals/*', 
		  'new_url'       => 'rentals.tekserve.com', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),
	array('old_url'       => 'www.tekserve.com/service/*', 
		  'new_url'       => 'www.tekserve.com/repairs-and-services/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),
	array('old_url'       => 'www.tekserve.com/rentals/*', 
		  'new_url'       => 'www.tekserve.com/business-solutions/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),
	array('old_url'       => 'www.tekserve.com/events/*', 
		  'new_url'       => 'events.tekserve.com/', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => FALSE 
	),
	array('old_url'       => 'www.tekserve.com/faq/*', 
		  'new_url'       => 'faq.tekserve.com/?s=*', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => TRUE, 
	),
	array('old_url'       => 'www.tekserve.com/*', 
		  'new_url'       => 'store.tekserve.com/*', 
		  'wildcard'      => TRUE, 
		  'preserve_path' => TRUE 
	),	  		  
);


// SET CURRENT ASSUMED subdomain and URL to www.tekserve.com

$base_domain = 'tekserve.com';
$base_subdomain = 'www';

/**
 * get_redirect_url
 *
 * returned array from parse_url -> http://php.net/manual/en/function.parse-url.php
 * 	array(4) {
 * 		["scheme"]=>
 *			string(4) "http"
 *		["host"]=>
 *			string(16) "www.tekserve.com"
 * 		["path"]=>
 *			string(16) "/store/index.php"
 * 		["query"]=>
 * 			string(10) "w=whatever"
 * 	}
 *
 * get url
 * compare against rule
 * if url is wildcard
 * 		check that rule old_url matches beginging of url
 * else	
 * 		check for complete match
 * if rule equires peserving path, then append the rest of the path information
 */
 
function get_redirect_url( $url, $redirect_rules )
{
	global $redirect_rules;
	// get parts for current path
	$url_parts = parse_url($url);
	// clean url
	$input_url = $url_parts['host'].@$url_parts['path'];
	// add trailing slash if none exists
	if( substr($input_url, -1) !== '/' ) $input_url .= '/';
	
	$i = 1;
	// loop thru rules, on match, exit function with return
	foreach( $redirect_rules as $rule )
	{
		// if wildcard or preserve path, trim asterisk from url
		if( $rule['wildcard']      ){ $rule['old_url'] = trim( $rule['old_url'], '*' ); }
		if( $rule['preserve_path'] ){ $rule['new_url'] = trim( $rule['new_url'], '*' ); }
		
		// get parts for rule old url. we have to add a scheme or parse_url() to work properly
		$compare_url_parts = parse_url('http://'.$rule['old_url']);
		// clean compare url
		$compare_url = $compare_url_parts['host'].@$compare_url_parts['path'];
		// add trailing slash if none exists
		if( substr($compare_url, -1) !== '/' ) $compare_url .= '/';		
		
		$is_match = FALSE;
		if($rule['wildcard']){
			if( substr( $input_url, 0, strlen($compare_url)) === $compare_url ) $is_match = TRUE;
		}else{
			if( $input_url === $compare_url ) $is_match = TRUE;
		}
		
//		DEBUGGING			
// 		echo $i.' '.( $is_match ? '<b>TRUE</b>' : '' ).'<br />'; $i++;
// 		echo ( $rule['wildcard'] ? 'W: '.substr( $input_url, 0, strlen($compare_url)) : 'STATIC' ).' '.( $rule['preserve_path'] ? 'PRESERVE PATH' : '' ).'<br />';
// 		echo "\t<b>".$compare_url.'</b><br />'; 		
// 		echo "\t".$input_url.'<br />';
// 		echo "\t".$rule['new_url'].'<br />';
		
		if($is_match){
			$redirect_to = $rule['new_url'];
			// append path rest of path info if required
			if($rule['preserve_path']){
				$redirect_to = str_replace( $rule['old_url'], $rule['new_url'], $url);
			}
			// return the new path
			return $url_parts['scheme'].$redirect_to;
		}
	}
	// if we went through all rules with no match, return 404
	return '404';
}


/**
 * TESTS
 * static (no wildcard), without trailing slash -> www.tekserve.com/business/rentals-and-leasing
 * static (no wildcard), with trailing slash -> www.tekserve.com/business/rentals-and-leasing/
 * wildcard, no preserve path with no extra characters, without trailing slash -> http://www.tekserve.com/business/Digital-Publishing
 * wildcard, no preserve path with no extra characters, with trailing slash -> http://www.tekserve.com/business/Digital-Publishing/
 * wildcard, no preserve path with extra characters, without trailing slash -> http://www.tekserve.com/business/Digital-Publishing/blahblahblah
 * wildcard, no preserve path with extra characters, with trailing slash -> http://www.tekserve.com/business/Digital-Publishing/blahblahblah/ 
 * wildcard, preserve path, without trailing slash -> http://www.tekserve.com/testthisout
 * wildcard, preserve path, with trailing slash -> http://www.tekserve.com/testthisout/
 */ 
 
 // get the URL
 
function curPageURL() {
//bring in baseURL/sub
global $base_domain;
global $base_subdomain;
//build actual url
$pageURL = '';
// $pageURL .= 'http';
// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
// $pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
//change base URL/sub as necessary
$newbase = str_replace( 'maintekserve.staging.wpengine', 'www.tekserve', $pageURL );
if( $newbase != $pageURL ) {
	$base_domain = 'wpengine.com';
	$base_subdomain = 'maintekserve.staging';
	return $newbase;	
}
unset( $newbase );
$newbase = str_replace( 'maintekserve.wpengine', 'www.tekserve', $pageURL );
if( $newbase != $pageURL ) {
	$base_domain = 'wpengine.com';
	$base_subdomain = 'maintekserve';
	return $newbase;	
}
unset( $newbase );
return $pageURL;
}
 
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
 //modified to call dave's redir function, output 404 only if no found redir in that thar long array ^
 
function tekserve_redirect_genesis_404() {

	//establish globals
	
	global $redirect_rules;
	
	global $base_domain;
	
	global $base_subdomain;

// 	$url = urldecode(@$_REQUEST['url']);

	$url = curPageUrl();

	$redirect_to = get_redirect_url( $url, $redirect_rules );
	
	//handle the aliases 

	//process 404
	
	if ( $redirect_to == '404') {

		echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';
			
// 			printf( '<h1 class="entry-title">%s</h1>', __( 'Not found, error 404', 'genesis' ) );
// 			echo '<p>this URL : ';
// 			var_dump( $url );
// 			echo '</p><p>New Url: ';
// 			var_dump( $redirect_to );
// 			echo '</p>';
			echo '<div class="entry-content">';

				if ( genesis_html5() ) :

// 					echo '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'genesis' ), home_url() ) . '</p>';
					echo '<div id="main" class="col-main" style="background: #f36f37; height: 380px;">
								<div class="page-title" style="background: #004d72; padding: 10px; color: white; height: 220px; border: none;">
										<div id="errorpic" style="position: absolute; left: 0px; top:0px; z-index: 5;">
										<img src="http://www.tekserve.com/skin/frontend/tekserve/tekstore/images/503ayus.png" style="height: 240px; width: 240px;" />
										</div>
									<h1 style="text-align: right; font-weight: 900; font-size: 10em; color: #fff; position: relative; top: 40px;">404\'d!</h1>
									<p style="text-align: right; font-size: 3em; position: relative; top: 70px;">
									We\'ll be back soon...
									</p>
								</div>
								<div style="font-size: 1.5em; padding: 20px; line-height: 1.6em; text-align: left;">
								<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to our <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below. If you need help, we\'re available by phone (&nbsp;<a style="font-weight: bold; color: #004d72;" href="tel:212.929.3645">212.929.3645</a>&nbsp;) and email (&nbsp;<a style="font-weight: bold; color: #004d72;" href="mailto:info@tekserve.com">info@tekserve.com</a>&nbsp;). See you shortly!', 'genesis' ), home_url() ) . '</p>
								</div>
							</div>
						</div>';

					echo '<p>' . get_search_form() . '</p>';

				else :
		?>
				<div id="main" class="col-main" style="background: #f36f37; height: 320px; position: relative">
								<div class="page-title" style="background: #004d72; padding: 10px; color: white; height: 220px; border: none; position:relative; margin: 0;">
										<div id="errorpic" style="position: absolute; left: 0px; top:0px; z-index: 5;">
										<img src="http://www.tekserve.com/skin/frontend/tekserve/tekstore/images/503ayus.png" style="height: 240px; width: 240px;" />
										</div>
									<h1 style="text-align: right; font-weight: 900; font-size: 10em; color: #fff; position: relative; top: 32px; margin: 0;">404'd!</h1>
								</div>
								<div style="font-size: 1.5em; padding: 20px; line-height: 1.6em; text-align: left;">
				<p style="color: #fff !important;"><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to our <a href="%s" style="color: #004d72; font-weight: 900;">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below. If you need help, we\'re available by phone (&nbsp;<a style="font-weight: bold; color: #004d72;" href="tel:212.929.3645">212.929.3645</a>&nbsp;) and email (&nbsp;<a style="font-weight: bold; color: #004d72;" href="mailto:info@tekserve.com">info@tekserve.com</a>&nbsp;). See you shortly!', 'genesis' ), home_url() ); ?></p>
								</div>
							</div>
						</div>
				<h4><?php _e( 'Pages:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_pages( 'title_li=' ); ?>
				</ul>

				

	<?php
				endif;

				echo '</div>';

			echo genesis_html5() ? '</article>' : '</div>';
	}
	//redirect to calculated url if there is one
	else {
// 		var_dump($redirect_to);
// 		var_dump($base_domain);
// 		var_dump($base_subdomain);
		if ( $base_subdomain == 'maintekserve.staging' ) {
			$redirect_to = str_replace( 'www.tekserve', 'maintekserve.staging.wpengine', $redirect_to );
		}
		if ( $base_subdomain == 'maintekserve' ) {
			$redirect_to = str_replace( 'www.tekserve', 'maintekserve.wpengine', $redirect_to );
		}
		$protocol = 'http';
		if ($_SERVER["HTTPS"] == "on") {$protocol .= "s";}
		$protocol .= "://";
		$redirect_to = $protocol.$redirect_to;
// 		var_dump($redirect_to);
		wp_redirect( $redirect_to, 301 );
		exit;
	}

}

genesis();
