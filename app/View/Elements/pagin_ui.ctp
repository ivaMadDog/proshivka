<div class="pagination">
    <?= $this->Paginator->first('<<', array(), null, array('class' => 'prev disabled'))?>
    <?= $this->Paginator->numbers(array('modulus'=>2, 'separator'=>' ')) ?>
    <?= $this->Paginator->last('>>', array(), null, array('class' => 'next disabled'))?>
</div>   