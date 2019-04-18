<h3><?php echo __('Welcome', 'wpcargo' ).' '.$user_full_name; ?></h3>
<div id="wpcargo-account">	
	<h4><?php _e('Shipment List', 'wpcargo' ); ?></h4> 
	<?php if( !in_array( 'administrator', $user_info->roles ) ): ?>  
	<div id="wpcargo-sort-shipment" style="text-align: right;margin-bottom: 12px;">
		<label for="sort"><?php _e('Sort','wpcargo'); ?></label>
		<select id="sort" style="width: initial;">
			<option value="all" <?php echo ( $shipment_sort == 'all' ) ? 'selected' : '' ; ?>><?php _e('All', 'wpcargo' ); ?></option>
			<option value="owned" <?php echo ( $shipment_sort == 'owned' ) ? 'selected' : '' ; ?>><?php _e('Owned', 'wpcargo' ); ?></option>
			<option value="receivable" <?php echo ( $shipment_sort == 'receivable' ) ? 'selected' : '' ; ?>><?php _e('Receivable', 'wpcargo' ); ?></option>
		</select>
	</div>
	<?php endif; ?>
	<div id="shipment-list">    	
		<table class="table wpcargo-table-responsive-md wpcargo-table">            
			<thead>                
				<tr>                    
					<th><?php _e('Tracking #', 'wpcargo'); ?></th>                    
					<th><?php _e('Delivery Date', 'wpcargo'); ?></th>                    
					<th><?php _e('Product Qty.', 'wpcargo'); ?></th>                    
					<th><?php _e('Status', 'wpcargo'); ?></th>
					<?php if( !in_array( 'administrator', $user_info->roles ) ): ?>  
					<th><?php _e('Designation', 'wpcargo'); ?></th>   
					<?php endif; ?>                    
					<th><?php _e('View More', 'wpcargo'); ?></th>                
				</tr>            
			</thead>            
			<tbody>                
				<?php				
					if ( $shipment_query->have_posts() ) :					
						while ( $shipment_query->have_posts() ) : $shipment_query->the_post();
							$shipperID = wpcargo_get_postmeta( get_the_ID(), 'registered_shipper'  );						
							?>					  
							<tr>                        
								<td><?php echo get_the_title(); ?></td>		                        
								<td><?php echo wpcargo_get_postmeta( get_the_ID(), 'wpcargo_expected_delivery_date_picker', 'date' ); ?></td>		                        
								<td><?php echo wpcargo_get_postmeta( get_the_ID(), 'wpcargo_qty' ); ?></td>	                        
								<td><?php echo wpcargo_get_postmeta( get_the_ID(), 'wpcargo_status' ); ?></td>
								<?php if( !in_array( 'administrator', $user_info->roles ) ): ?>  
								<td><?php echo ( $current_user_id == $shipperID ) ? __('Owned', 'wpcargo' ) : __('Receivable', 'wpcargo' ) ; ?></td> 
								<?php endif; ?>                       
								<td><a class="view-shipment" href="#" data-id="<?php echo get_the_ID(); ?>"><?php _e('View Details', 'wpcargo'); ?></a></td>				                    
							</tr>					  
							<?php					
						endwhile;
						else :
						?>
						<tr> 
							<td colspan="<?php echo !in_array( 'administrator', $user_info->roles ) ? 6 : 5 ; ?>"><?php _e('No shipment found!', 'wpcargo' ); ?></td>
						</tr>
					<?php				
					endif;			
				?>            
			</tbody>        
		</table>        
		<?php echo wpcargo_pagination( array( 'custom_query' => $shipment_query ) ); ?>    
	</div><!-- list-container -->
</div><!-- wpcargo-account -->