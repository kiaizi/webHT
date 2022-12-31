  <div id="mainnav">
    	<ul>
        <?php
				if(P_SID != SID  && SID != ''){
			?>
            <li><a href="index.php?sid=<?php echo P_SID; ?>"><?php echo P_SECTION_NAME; ?></a></li>
             <?php
				}
			?>
            <?php
				if(P_SID != SID  && SID != ''){
			?>
            <li class="last"><a href="index.php?sid=<?php echo SID; ?>"><?php echo SECTION_NAME; ?></a></li>
            <?php
				}
			?>
    	</ul>
    </div>