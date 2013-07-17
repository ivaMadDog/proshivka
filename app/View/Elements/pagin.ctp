<?php $countPages=(int)$this->Paginator->counter(array('format' => '%pages%')) ; ?>
<?php if($countPages>1) { ?>
    <div class="row">
        <div class="column grid_12">
            <div class="pagin">
                <?php 
                    echo $this->Paginator->prev('<<');
                    echo $this->Paginator->numbers(array('separator'=>' '));
                    echo $this->Paginator->next('>>');
                ?>
            </div>   
        </div>
    </div><!-- end .row-->
<?php } ?>