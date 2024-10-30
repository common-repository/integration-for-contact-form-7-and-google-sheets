<?php
  if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }
 wp_enqueue_script('vx-sorter');  
?><style type="text/css">
.vx_red{
color: #E31230;
}
  .vx_green{
    color:rgb(0, 132, 0);  
  }
      .crm_fields_table input , .crm_fields_table select{
      margin: 0px;
  }
      .vx_accounts_table .vx_pointer{
      cursor: pointer;
  }
  .vx_accounts_table .fa-caret-up , .vx_accounts_table .fa-caret-down{
      display: none;
  }
  .vx_accounts_table th.headerSortUp .fa-caret-down{ 
display: inline; 
} 
  .vx_accounts_table th.headerSortDown .fa-caret-up{ 
display: inline; 
}
</style>
<table class="widefat fixed sort striped vx_accounts_table" style="margin: 20px 0 50px 0">
<thead>
<tr> <th class="manage-column column-cb vx_pointer" style="width: 30px" ><?php esc_html_e("#",'integration-for-contact-form-7-and-spreadsheets'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th>  
<th class="manage-column vx_pointer"> <?php esc_html_e("Account",'integration-for-contact-form-7-and-spreadsheets'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column"> <?php esc_html_e("Status",'integration-for-contact-form-7-and-spreadsheets'); ?> </th> 
<th class="manage-column vx_pointer"> <?php esc_html_e("Created",'integration-for-contact-form-7-and-spreadsheets'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column vx_pointer"> <?php esc_html_e("Last Connection",'integration-for-contact-form-7-and-spreadsheets'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column"> <?php esc_html_e("Action",'integration-for-contact-form-7-and-spreadsheets'); ?> </th> </tr>
</thead>
<tbody>
<?php

$nonce=wp_create_nonce("vx_nonce");
if(is_array($accounts) && count($accounts) > 0){
 $sno=0;   
foreach($accounts as $id=>$v){
    $sno++; $id=$v['id'];
    $icon= $v['status'] == "1" ? 'fa-check vx_green' : 'fa-times vx_red';
    $icon_title= $v['status'] == "1" ? esc_html__('Connected','integration-for-contact-form-7-and-spreadsheets') : esc_html__('Disconnected','integration-for-contact-form-7-and-spreadsheets');
 ?>
<tr> <td><?php echo esc_attr($id) ?></td>  <td> <?php echo esc_html($v['name']); ?></td> 
<td> <i class="fa <?php echo esc_attr($icon) ?>" title="<?php echo esc_attr($icon_title) ?>"></i> </td> <td> <?php echo date('M-d-Y H:i:s', strtotime($v['time'])+$offset); ?> </td>
 <td> <?php echo date('M-d-Y H:i:s', strtotime($v['updated'])+$offset); ?> </td> 
<td><span class="row-actions visible"> <a href="<?php echo esc_url($page_link."&id=".$id); ?>"><?php 
if($v['status'] == "1"){
_e('View','integration-for-contact-form-7-and-spreadsheets');
}else{ 
_e('Edit','integration-for-contact-form-7-and-spreadsheets');
} 
?></a> | <span class="delete"><a href="<?php echo esc_url($page_link.'&'.$this->id.'_tab_action=del_account&id='.$id.'&vx_nonce='.$nonce) ?>" class="vx_del_account" > <?php esc_html_e("Delete",'integration-for-contact-form-7-and-spreadsheets'); ?> </a></span></span> </td> </tr>
<?php
} }else{
?>
<tr><td colspan="6"><p><?php echo sprintf(esc_html__("No Google Sheets Account Found. %sAdd New Account%s",'integration-for-contact-form-7-and-spreadsheets'),'<a href="'.esc_url($new_account).'">','</a>'); ?></p></td></tr>
<?php
}
?>
</tbody>
<tfoot>
<tr> <th class="manage-column column-cb" style="width: 30px" ><?php esc_html_e("#",'integration-for-contact-form-7-and-spreadsheets'); ?></th>  
<th class="manage-column"> <?php esc_html_e("Account",'integration-for-contact-form-7-and-spreadsheets'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Status",'integration-for-contact-form-7-and-spreadsheets'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Created",'integration-for-contact-form-7-and-spreadsheets'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Last Connection",'integration-for-contact-form-7-and-spreadsheets'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Action",'integration-for-contact-form-7-and-spreadsheets'); ?> </th> </tr>
</tfoot>
</table>
<script>
jQuery(document).ready(function($){
    $('.vx_accounts_table').tablesorter( {headers: { 2:{sorter: false}, 5:{sorter: false}}} );
   $(".vx_del_account").click(function(e){
     if(!confirm('<?php esc_html_e('Are you sure to delete Account ?','integration-for-contact-form-7-and-spreadsheets') ?>')){
         e.preventDefault();
     }  
   }) 
})
</script>