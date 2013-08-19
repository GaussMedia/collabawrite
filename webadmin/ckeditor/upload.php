<?php
$nae = $_FILES['upload']['name']; 
if(move_uploaded_file($_FILES['file']['tmp_name'] , 'http://localhost/ckeditor12/ckeditor/img/'.$nae)){
	
}

?>

<script type="text/javascript">
window.parent.CKEDITOR.tools.callFunction( <?php echo $_GET['CKEditorFuncNum']?>, 'http://localhost/ckeditor12/ckeditor/img/<?php echo $nae;?>' );
</script>