<?php /* Smarty version Smarty-3.1.15, created on 2014-10-22 14:04:15
         compiled from "view/user-detail.html" */ ?>
<?php /*%%SmartyHeaderCode:1131704492544744a1b35858-16418863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd49c5a1fa60b90e724138a2961d9e7b334771a90' => 
    array (
      0 => 'view/user-detail.html',
      1 => 1413957844,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1131704492544744a1b35858-16418863',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_544744a1b72828_02476799',
  'variables' => 
  array (
    'status' => 0,
    'basedomain' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544744a1b72828_02476799')) {function content_544744a1b72828_02476799($_smarty_tpl) {?><script>
$(function () {
	$('#postdate1').datepicker ();
	$('#expiredate1').datepicker ();
	
	$("#isi").jqte();
	

})
</script>

<div id="content-header">
	<h1>Tambah User</h1>
</div> <!-- #content-header -->	

<div id="content-container">

	<?php if ($_smarty_tpl->tpl_vars['status']->value) {?>
		<div class="alert alert-success" role="alert">Akun berhasil dibuat</div>
		<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
user"><button type="submit" class="btn btn-alert" id="btn-dis">Kembali</button></a>
	<?php } else { ?>
	<form id="validate-enhanced" class="form parsley-form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
user/add" enctype="multipart/form-data">
		
		<div class="row">
			<div class="col-md-6">
				<div class="portlet">
				
					<div class="portlet-header">

						<h3>
							<i class="fa fa-file"></i>
							Form User
						</h3>

					</div> <!-- /.portlet-header -->
				
					<div class="portlet-content">
				
						<div class="col-sm-12">
							<div class="form-group">
							<label for="text-input">Nama</label>
									<input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
" data-required="true" />
							</div>
						</div>	
						
						<div class="col-md-12">
							<div class="form-group">
							<label for="text-input">Email</label>
									<input type="text" name="email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" />
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
							<label for="text-input">Instansi</label>
									<input type="text" name="description" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
" />
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
							<select class="btn btn-default btn-sm" style="text-align:left" name="usertype">

								<option value="0">-- Pilih Level User --</option>
								
								<option value="1">Verificator 1</option>
								<option value="2">Verificator 2</option>
								<option value="3">Verificator 3</option>
							</select>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-info" id="btn-dis"><i class="fa fa-save"></i> Simpan Data</button>
			</div>
		
		
			
		</div>
	
	</form>
	<?php }?>
</div><?php }} ?>
