<div id="upload-main" data-count="<?php echo $data->album->photos_count ?>" data-id="<?php echo $data->album->id ?>">
	<div class="upload_header">
		<h3 class="panel-title">Add Photos to <?php echo $data->album->title ?></h3>
		<p class="photos_count">(<?php echo $data->album->photos_count.' Photo'.($data->album->photos_count>1?'s':'') ?>)</p>
		<a href="<?php echo URL.'admin/view/albums/' ?>" class="btn btn-borderonly" >Back to Albums</a>
		<a href="<?php echo URL.'admin/gallery/'.$data->album->id ?>" class="btn btn-borderonly" >View Gallery</a>
	</div>	
	<div class="panel">
		<div class="upload-info">
		</div>
		<div class="upload-block">
			<form id="upload_form" action="<?php echo URL.'admin/upload_multiple/'.$data->album->id ?>" method="post" enctype="multipart/form-data" target="upload_iframe">			
				<div class="upload_form_options sticky">
					<div class="upload_status">Uploading...</div>
					<label for="upload_input" >						
						<input type="file" name="file[]" id="upload_input" multiple>
					</label>		
					<p class="text-small browse-info">Image file should only be JPEG/JPG or PNG.</p>						</div>
				
				<input type="submit" value="Upload Photos">			
			</form>		
		</div>
	</div>	
</div>
