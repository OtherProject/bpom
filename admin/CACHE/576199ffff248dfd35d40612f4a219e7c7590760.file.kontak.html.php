<?php /* Smarty version Smarty-3.1.15, created on 2014-10-22 14:45:15
         compiled from "view/kontak.html" */ ?>
<?php /*%%SmartyHeaderCode:1797101261544751a1181890-56191861%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '576199ffff248dfd35d40612f4a219e7c7590760' => 
    array (
      0 => 'view/kontak.html',
      1 => 1413960279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1797101261544751a1181890-56191861',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_544751a11c4374_33835719',
  'variables' => 
  array (
    'basedomain' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544751a11c4374_33835719')) {function content_544751a11c4374_33835719($_smarty_tpl) {?><script>
$(function () {
	$('#postdate').datepicker ();
	$('#expiredate').datepicker ();
	
	$("#isi").jqte();
	
	$('input:checkbox, input:radio').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue',
		inheritClass: true
	})
})
</script>

<div id="content-header">
	<h1>Add New Article</h1>
</div> <!-- #content-header -->	

<div id="content-container">
	<form id="validate-enhanced" class="form parsley-form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
article/kontak" enctype="multipart/form-data">

		<div class="row">
			<div class="col-md-9">
				<div class="portlet">
				
					<div class="portlet-header">

						<h3>
							<i class="fa fa-tasks"></i>
							Form Article
						</h3>

					</div> <!-- /.portlet-header -->
				
					<div class="portlet-content">
				
						<div class="col-sm-12">
							<div class="form-group">
							<label for="text-input">Title</label>
									<input type="text" name="title" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" data-required="true"/>
							</div>
						</div>	
						
						<div class="col-md-6">
							<div class="form-group">
							<label for="text-input">Brief</label>
									<input type="text" name="brief" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['brief'];?>
" />
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
							<label for="textarea-input">Deskripsi</label>
									<textarea name="content" id="isi"  cols="10" rows="20" class="form-control"><?php echo $_smarty_tpl->tpl_vars['data']->value['content'];?>
</textarea>
							</div>
							
							
									<!-- hidden -->
									<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" />
									
							
						</div>
					</div>
				</div>
				
			</div>
		
		
			<div class="col-md-3">
				<div class="portlet">
					<div class="portlet-header">

						<h3>
							<i class="fa fa-calendar"></i>
							Publish Date
						</h3>

					</div> <!-- /.portlet-header -->
					<div class="portlet-content">
						<div class="form-group">
							<label for="select-input">Postdate</label>
							<div id="postdate" class="input-group date" data-auto-close="true" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
								<input class="form-control" type="text" name="postdate" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['posted_date'];?>
" data-required="true">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
							
						</div>
						
						<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="n_status" class="" <?php echo $_smarty_tpl->tpl_vars['data']->value['n_status'];?>
 >
										Publish
									</label>
								</div>
						</div>
						
						<input type="submit" class="btn btn-primary" value="Submit" id="submit" />
					</div>
				</div>
				
				<div class="portlet">
					<div class="portlet-header">

						<h3>
							<i class="fa fa-picture-o"></i>
							Cover Image
						</h3>

					</div> <!-- /.portlet-header -->
					<div class="portlet-content">
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['file'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
" /></div>
						  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						  <div>
							<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="file_image"/></span>
							<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
						  </div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	
	</form>
</div><?php }} ?>
