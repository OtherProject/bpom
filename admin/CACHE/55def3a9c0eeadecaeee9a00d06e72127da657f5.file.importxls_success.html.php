<?php /* Smarty version Smarty-3.1.15, created on 2014-10-22 11:01:47
         compiled from "view/importxls_success.html" */ ?>
<?php /*%%SmartyHeaderCode:1660285455544714db5af105-03433506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55def3a9c0eeadecaeee9a00d06e72127da657f5' => 
    array (
      0 => 'view/importxls_success.html',
      1 => 1413946904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1660285455544714db5af105-03433506',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_544714db7d79e0_04712731',
  'variables' => 
  array (
    'totalinsert' => 0,
    'error' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544714db7d79e0_04712731')) {function content_544714db7d79e0_04712731($_smarty_tpl) {?><script type="text/javascript">
	function AreAnyCheckboxesChecked () {
	  if ($("#Form2 input:checkbox:checked").length > 0)
		{
		    $("#btn-dis").removeAttr("disabled");
		}
		else
		{
		   $('#btn-dis').attr("disabled","disabled");
		}
	}
</script>
<div id="content-header">
	<h1>Import Data</h1>
</div> <!-- #content-header -->	

<div id="content-container">

	<div class="row">

		<div class="col-md-12">

			<div class="portlet">

				<div class="portlet-header">

					<h3>
						<i class="fa fa-table"></i>
						Import Data Status
					</h3>

				</div> <!-- /.portlet-header -->

				<div class="portlet-content">						

					<div class="table-responsive">
					
					<div class="alert alert-success" role="alert"><?php if ($_smarty_tpl->tpl_vars['totalinsert']->value) {?><?php echo $_smarty_tpl->tpl_vars['totalinsert']->value;?>
 Data berhasil disimpan<?php }?></div>
					<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
					<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>
					<?php }?>
					<br>
					<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
import/previewData"><button type="submit" class="btn btn-info btn-sm" id="btn-dis"><i class="fa fa-check"></i> Preview data lagi</button></a>
					</div> <!-- /.table-responsive -->
					

				</div> <!-- /.portlet-content -->

			</div> <!-- /.portlet -->

		

		</div> <!-- /.col -->

	</div> <!-- /.row -->

</div><?php }} ?>
