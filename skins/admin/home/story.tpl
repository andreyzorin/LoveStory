<div class="story">

	<!--Вывод об  добавлении или удалении истории-->
	<?php  if (isset($info))  { echo '<h2>'.$info.'</h2>'; } ?>

	<!--Панель управления историями-->
<form action="" method="post">
	<table>
		<tr>
			<td>
				<div id="story_add"><a href="/admin/home/story_add"><p>Добавить новую историю</p></a></div>
			</td>
		</tr>
	</table>
</form>	
	<!--Вывод всех историй из БД-->
	<?php if($story_show->num_rows) { while  ($row = $story_show->fetch_assoc()) { ?>
		<table>
			<tr>
				<td>
					<div id="story_delete">
						<a href="/admin/home/story?action=delete&id=<?php echo $row['id'];?>" onclick="return areYouSure()">Удалить историю</a>
					</div>	
					<div id="story_edit">
						<a href="/admin/home/story_edit?id=<?php echo $row['id'];?>">Редактировать историю</a>
					</div>	

					<div class="story_show"> 
						<div id="story_show_title">
							<h1><?php echo hsc($row['title']); ?></h1>
						</div>
						<div id ="story_show_text">
							<i>
								<b>Краткое описание</b></br>
								<p><?php echo hsc($row['description']); ?></p>
							</i>
						</div>
						<div id ="story_show_text">
							<?php echo hsc($row['text']); ?>
						</div>
					</div>			
				</td>
			</tr>
		</table>
	<?php  	}	} ?>
	<!--Paginator-->
	<div class="paginator">
		<?php
		$story_total = $story_get->num_rows;
		$page_num = 0;
		while ($story_total > 0) {
			$page_num++;
			echo '<a href="/admin/home/story?num='.$page_num.'">'.$page_num.'</a>'." ";
			$story_total = $story_total - CORE::$LIMIT; 
		}?>
	</div>
</div>
