<!-- load the lightbox plugin -->
<script src="<?php echo URL . 'libs/lightbox/js/lightbox.min.js' ?>"></script>
<link href="<?php echo URL . 'libs/lightbox/css/lightbox.css' ?>" rel="stylesheet" />

<form class="gallery gallery_preview" method="post" action="">
	<div class="g_header">		
		<h3 class="g_title"><?php echo $data->title ?></h3>	
		<p class="g_info"><?php echo count($data->photos) ?> photos</p> |
		<a class="btn-small" href="<?php echo URL.'admin/view/albums' ?>">Back to Albums</a>	
		
		<div>
			<a class="btn btn-small btn-borderonly" href="<?php echo URL.'admin/upload/'.$data->id ?>">Add Photos</a>	
		
			<!-- show only edit button if not User Album -->
			<!-- User Album is protected -->
			<?php if ($data->title!='User Album'): ?>
				<a class="btn btn-small btn-borderonly" href="<?php echo URL.'admin/edit/albums/'.$data->id ?>">Edit Album</a>	
			<?php endif ?>
		</div>

	</div>
	<div class="g_options <?php echo count($data->photos) > 0 ? '' : 'hide'?>">
		<div class="thumbnail_size_buttons">
			<span class="btn btn-thumbnail btn-thumb-large">Large Thumbnail</span>
			<span class="btn btn-thumbnail btn-thumb-small">Small Thumbnail</span>
			<div class="cf"></div>
		</div>		
		<label for="check_all">			
			<span class="btn btn-textonly btn-small g_check_all">Check All</span>
			<input type="checkbox" id="check_all">
		</label>		
		<div class="checked_options">
			<select name="target_album" id="">
				<option value="" selected disabled>Select Album...</option>
				==========================
				<?php foreach ($data->albums_list as $key => $album): ?>
					<?php if ($album->id!=$data->id): ?>
						<option value="<?php echo $album->id ?>"><?php echo $album->title ?></option>
					<?php endif ?>					
				<?php endforeach ?>
			</select>
			<div class="checked_options_buttons">
				<input type="submit" name="move_selected" class="btn btn-small btn-textonly g_move" value="Move Selected" data-task="move"> | 
				<input type="submit" name="delete_selected" class="btn btn-small btn-textonly g_delete" value="Delete Selected" data-task="delete">
			</div>
		</div>		
		<div class="g_checked_count">0 items selected</div>
		<div class="cf"></div>		
	</div>
	<?php if ($data->info->content): ?>		
		<span class="info info-<?php echo $data->info->type ?>" id="info2">
			<span class="info-text">
				<?php echo $data->info->content ?>
			</span>
			<?php if (isset($data->info->button->title)): ?>
				<a href="<?php echo $data->info->button->link ?>" class="btn btn-small">
					<?php echo $data->info->button->title ?>
				</a>
			<?php endif ?>			
			<span class="info-close" data-info="#info2">&times;</span>			
		</span>
	<?php endif ?>
	<div class="g_thumbnail_grid">
		<?php foreach ($data->photos as $key => $photo): ?>
			<div class="g_thumbnail" id="<?php echo $photo->id ?>"
			data-uploaded="<?php echo $photo->date_created ?>"
			data-modified="<?php echo $photo->date_modified ?>"
			data-username="<?php echo $photo->username ?>">
				<label class="g_thumbnail_opts" for="img_<?php echo $photo->id ?>">		
					<input type="checkbox" align="right" id="img_<?php echo $photo->id ?>" name="checked_thumbnails[]" class="g_options_checkbox" value="<?php echo $photo->id ?>">										
					<?php echo $photo->img_title ?>
				</label>
				<a href="<?php echo $photo->img_url ?>" class="g_thumbnail_img" data-lightbox="image_gallery" data-title="<?php echo $photo->img_caption ?>">
					<img src="<?php echo $photo->img_thumbnail ?>" alt="A gallery image." >
				</a>
				<div class="g_thumbnail_caption ">
					<textarea name="img_caption" id="" cols="30" rows="10" placeholder="Caption"><?php echo $photo->img_caption ? $photo->img_caption : '' ?></textarea>					
				</div>				
			</div>
		<?php endforeach ?>
	</div>
</form>

