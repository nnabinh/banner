<div>
  <?php foreach($viewmodel as $banner) :?>
    <div class="well">
      <h3><?php echo $banner['name'];?></h3>
      <hr />
      <img src=<?php echo $banner['url'];?> height=<?php echo $banner['height'];?> width=<?php echo $banner['width'];?>/>
      <br />
    </div>
  <?php endforeach; ?>
</div>
