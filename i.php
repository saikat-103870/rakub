

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style>
.custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
</style>
<script>
$('#file-upload').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});
</script>
<form>
  <label for="file-upload" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Upload Image
  </label>
  <input id="file-upload" name='upload_cont_img' type="file" style="display:none;">
</form>